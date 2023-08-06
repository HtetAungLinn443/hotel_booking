<?php
session_start();
require "../requires/common.php";
require "../requires/connect.php";
require "../requires/check_authencation.php";
require "../requires/include_function.php";
$table = 'room_gallery';
$err_msg = '';
$error = false;


if (isset($_POST['form-sub']) && $_POST['form-sub'] == '1') {
    $room_id = (int) ($_POST['room_id']);
    $process_error = false;
    $file = $_FILES['file'];
    if ($file['name'] == '') {
        $error = true;
        $err_msg = "Please fill room image!";
        $process_error = true;
    } else {
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileType = $file['type'];
        $fileTempPath = $file['tmp_name'];
        $check_extension = checkImageExtension($fileName, $fileTempPath);
        if ($check_extension['error'] == false) {
            $uniqueName = date('Y-m-d_h-i-s') . '_' . uniqid() . '.' . $check_extension['extension'];
            $filePath = '../assets/upload/' . $room_id . '/';
            $upload_process = true;
            if (!file_exists($filePath)) {
                mkdir($filePath, 0777, true);
            }
            if (file_exists($fileTempPath)) {
                if (move_uploaded_file($fileTempPath, $filePath . $uniqueName)) {
                    $inputFile = $filePath . $uniqueName;
                    $outputFile = $filePath . $uniqueName;
                    cropAndResizeImage($inputFile, $outputFile, $upload_width, $upload_height);
                    addWatermarkToImage($inputFile, $outputFile);
                    $today_date = date('Y-m-d H:i:s');
                    $user_id = (isset($_SESSION['id'])) ? $_SESSION['id'] : $_COOKIE['id'];
                    $insert_data = [
                        'room_id' => "'$room_id'",
                        'image' => "'$uniqueName'",
                        'created_at' => "'$today_date'",
                        'created_by' => "'$user_id'",
                        'updated_at' => "'$today_date'",
                        'updated_by' => "'$user_id'",
                    ];
                    $insert =  insertQuery($insert_data, $table, $mysqli);
                }
            }
        } else {
            $upload_process = false;
            $error = true;
            $err_msg .= "Please Update Valid Image! <br/>";
        }
    }
} else {
    $room_id = (int) ($_GET['id']);
}

$title = "Hotel Booking:: Room Gallery Upload";
require "../templates/cp_template_header.php";
require "../templates/cp_template_sidebar_menu.php";
require "../templates/cp_template_top_nav.php";

?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Hotel Room</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <h3>Room Create</h3>
                    <div class="x_content">
                        <br />
                        <form action="<?php echo $cp_base_url; ?>room_gallery.php" method="POST" id="createForm" enctype="multipart/form-data">
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="room_name">Room
                                    Thumbnail<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 d-flex justify-content-center">
                                    <div class="preview-wrapper rounded  d-flex justify-content-center align-items-center">
                                        <label class="thumb-upload btn btn-info">Upload
                                            Image</label>
                                        <div class="preview-container" style="display:none;">
                                            <a class="thumb-update btn btn-info text-white">Update Image</a>
                                            <img src="" class="preview-img" />
                                        </div>
                                    </div>
                                    <input type="file" name="file" id="thumb_file" value="" style="display: none;" accept="image/*">
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide" id="thumb_error"></label>
                            </div>

                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3">
                                        <button type='submit' class="btn btn-primary" id="submit-btn">Upload</button>
                                        <button type='reset' class="btn btn-success" id="reset-btn">Reset</button>
                                        <input type="hidden" name="form-sub" value="1">
                                        <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /page content -->
<?php
require "../templates/cp_template_footer.php";
?>
<script src="<?php echo $base_url ?>assets/backend/js/pages/room_create_update.js?v=202382"></script>
<?php
if ($error) {
    echo "<script>
          new PNotify({
                title: 'Error',
                text: '$err_msg',
                type: 'error',
                styling: 'bootstrap3'
            })
          </script>";
}

?>

</html>