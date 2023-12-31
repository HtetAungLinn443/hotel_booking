<?php
session_start();
require "../requires/common.php";
require "../requires/connect.php";
require "../requires/check_authencation.php";
require "../requires/include_function.php";
$table = 'room_gallery';
$err_msg = '';
$error = false;
$gallery_table = 'room_gallery';

if (isset($_POST['form-sub']) && $_POST['form-sub'] == '1') {
    $id = (int) ($_POST['id']);
    $room_id = (int) ($_POST['room_id']);
    $file = $_FILES['file'];
    $select_column = ['image'];
    $result = selectQueryById($id, $select_column, $table,  $mysqli);
    $res_rows = $result->num_rows;
    if ($res_rows <= 0) {
        $process_error = true;
        $form = false;
        $error = true;
        $err_msg = 'The image you search does not find!';
    } else {
        while ($row = $result->fetch_assoc()) {
            $old_image_name = htmlspecialchars($row['image']);
            $old_image_path = '../assets/upload/' . $room_id . '/' . $old_image_name;
        }
    }

    if ($file['name'] == '') {
        $error = true;
        $err_msg = "Please fill room image!";
        $process_error = true;
    } else {

        $fileName = $file['name'];
        $fileType = $file['type'];
        $fileTempPath = $file['tmp_name'];
        $check_extension = checkImageExtension($fileName, $fileTempPath);
        if ($check_extension['error'] == false) {
            $uniqueName = date('Y-m-d_h-i-s') . '-' . uniqid() . '.' . $check_extension['extension'];
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
                    $update_data = [
                        'image' => "'$uniqueName'",
                        'updated_at' => "'$today_date'",
                        'updated_by' => "'$user_id'",
                    ];

                    $update = updateQuery($update_data, $id, $table, $mysqli);

                    if ($update) {
                        unlink($old_image_path);
                        $url = $cp_base_url . "room_gallery.php?id=" . $room_id;
                        header("Refresh: 0; url=$url");
                        exit();
                    }
                }
            }
        } else {
            $upload_process = false;
            $error = true;
            $err_msg .= "Please Update Valid Image! <br/>";
        }
    }
} else {
    $id = (int) ($_GET['id']);
    $room_id = (int) ($_GET['r_id']);
    $select_column = ['image'];
    $result_img = selectQueryById($id, $select_column, $table, $mysqli);
    $row_res = $result_img->num_rows;
    while ($row = $result_img->fetch_assoc()) {
        $image_path = $row['image'];
        $full_image_path = $base_url . 'assets/upload/' . $room_id . '/' . $image_path;
    }
}

$title = "Hotel Booking:: Room Gallery Update";
require "../templates/cp_template_header.php";
require "../templates/cp_template_sidebar_menu.php";
require "../templates/cp_template_top_nav.php";

?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Hotel Room Gallery Update</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <h3>Gallery Update</h3>
                    <div class="x_content">
                        <br />
                        <form action="<?php echo $cp_base_url; ?>room_gallery_edit.php" method="POST" id="createForm" enctype="multipart/form-data">
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="room_name">Room
                                    Image<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 d-flex justify-content-center">
                                    <div class="preview-wrapper rounded d-flex justify-content-center align-items-center">
                                        <div class="preview-container">
                                            <a class="thumb-update btn btn-info text-white">Update Image</a>
                                            <img src="<?php echo $full_image_path; ?>" class="preview-img" />
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
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
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