<?php
session_start();
require "../requires/common.php";
require "../requires/connect.php";
require "../requires/check_authencation.php";
require "../requires/include_function.php";

$process_error = false;
$error = false;
$err_msg = "";
$table = 'hotel_setting';
$setting_logo = '';

if (isset($_POST['form-sub']) && $_POST['form-sub'] == '1') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $check_in = htmlspecialchars($_POST['check_in']);
    $check_out = htmlspecialchars($_POST['check_out']);
    $outline_phone = htmlspecialchars($_POST['outline_phone']);
    $online_phone = htmlspecialchars($_POST['online_phone']);
    $size_unit = htmlspecialchars($_POST['size_unit']);
    $occupancy = htmlspecialchars($_POST['occupancy']);
    $price_unit = htmlspecialchars($_POST['price_unit']);
    $file = $_FILES['file'];
    $sql = "SELECT count(id) as total FROM `hotel_setting`";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $total = $row['total'];
    if ($total > 0) {
        $id = (int) ($_POST['id']);
        $upload_process = false;
        if ($file['name'] != '') {
            $file_name = $file['name'];
            $temp_name = $file['tmp_name'];
            $check_extension = checkImageExtension($file_name, $temp_name);
            if ($check_extension['error'] == false) {
                $uniqueName = date('Y-m-d_H-i-s') . uniqid() . '.' . $check_extension['extension'];
                $upload_process = true;
            } else {
                $process_error = true;
                $error = true;
                $err_msg .= 'Please Upload valid image! <br/>';
            }
        }
        if ($process_error == false) {
            if ($upload_process == false) {
                $update_data = [
                    'name' => "'$name'",
                    'email' => "'$email'",
                    'address' => "'$address'",
                    'check_in_time' => "'$check_in'",
                    'check_out_time' => "'$check_out'",
                    'outline_phone' => "'$outline_phone'",
                    'online_phone' => "'$online_phone'",
                    'size_unit' => "'$size_unit'",
                    'occupancy' => "'$occupancy'",
                    'room_price' => "'$price_unit'",
                ];
            } else {
                $update_data = [
                    'name' => "'$name'",
                    'email' => "'$email'",
                    'address' => "'$address'",
                    'check_in_time' => "'$check_in'",
                    'check_out_time' => "'$check_out'",
                    'outline_phone' => "'$outline_phone'",
                    'online_phone' => "'$online_phone'",
                    'size_unit' => "'$size_unit'",
                    'occupancy' => "'$occupancy'",
                    'room_price' => "'$price_unit'",
                    'logo' => "'$uniqueName'",
                ];
            }

            $update = updateQuery($update_data, $id, $table, $mysqli);

            if ($update) {
                if ($upload_process == true) {
                    $filePath = '../assets/images/';
                    if (!file_exists($filePath)) {
                        mkdir($filePath, 0777, true);
                    }
                    if (move_uploaded_file($temp_name, $filePath . $uniqueName)) {
                        $inputFile = $filePath . $uniqueName;
                        $outputFile = $filePath . $uniqueName;
                        cropAndResizeImage($inputFile, $outputFile, $logo_width, $logo_height);
                    }
                }
                $url = $cp_base_url . "hotel_setting_create.php";
                header("Refresh: 0; url=$url");
                exit();
            }
        }
    } else {
        if ($file['name'] != '') {
            $file_name = $file['name'];
            $temp_name = $file['tmp_name'];
            $check_extension = checkImageExtension($file_name, $temp_name);
            if ($check_extension['error'] == false) {
                $uniqueName = date('Y-m-d_H-i-s') . uniqid() . '.' . $check_extension['extension'];
            } else {
                $process_error = true;
                $error = true;
                $err_msg .= 'Please Upload valid image! <br/>';
            }
        } else {
            $process_error = true;
            $error = true;
            $err_msg .= 'Please Upload Logo Image!<br/>';
        }
        if ($process_error == false) {
            $insert_data = [
                'name' => "'$name'",
                'email' => "'$email'",
                'address' => "'$address'",
                'check_in_time' => "'$check_in'",
                'check_out_time' => "'$check_out'",
                'outline_phone' => "'$outline_phone'",
                'online_phone' => "'$online_phone'",
                'size_unit' => "'$size_unit'",
                'occupancy' => "'$occupancy'",
                'room_price' => "'$price_unit'",
                'logo' => "'$uniqueName'",
            ];
            $insert = insertQuery($insert_data, $table, $mysqli);
            if ($insert) {
                $filePath = '../assets/images/';
                if (!file_exists($filePath)) {
                    mkdir($filePath, 0777, true);
                }
                if (move_uploaded_file($temp_name, $filePath . $uniqueName)) {
                    $inputFile = $filePath . $uniqueName;
                    $outputFile = $filePath . $uniqueName;
                    cropAndResizeImage($inputFile, $outputFile, $logo_width, $logo_height);
                }
                $url = $cp_base_url . "hotel_setting_create.php";
                header("Refresh: 0; url=$url");
                exit();
            }
        }
    }
} else {
    $name = '';
    $email = '';
    $address = '';
    $check_in = '';
    $check_out = '';
    $outline_phone = '';
    $online_phone = '';
    $size_unit = '';
    $occupancy = '';
    $price_unit = '';
    $uniqueName = '';
    $select_column = [
        'id',
        'name',
        'email',
        'address',
        'check_in_time',
        'check_out_time',
        'outline_phone',
        'online_phone',
        'size_unit',
        'occupancy',
        'room_price',
        'logo',
    ];
    $result = listQuery($select_column, $table, $mysqli);

    $res_row = $result->num_rows;
    if ($res_row > 0) {
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $name = $row['name'];
        $email = $row['email'];
        $address = $row['address'];
        $check_in = $row['check_in_time'];
        $check_out = $row['check_out_time'];
        $outline_phone = $row['outline_phone'];
        $online_phone = $row['online_phone'];
        $size_unit = $row['size_unit'];
        $occupancy = $row['occupancy'];
        $price_unit = $row['room_price'];
        $uniqueName = $row['logo'];
        $setting_logo = $base_url . '/assets/images/' . $uniqueName;
    }
}
$title = "Hotel Booking:: Hotel Setting Create";
require "../templates/cp_template_header.php";
require "../templates/cp_template_sidebar_menu.php";
require "../templates/cp_template_top_nav.php";

?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Hotel Setting</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <button onclick="history.back()" class="btn btn-dark">Back</button>
                    <div class="x_content">
                        <br />
                        <form action="<?php echo $cp_base_url; ?>hotel_setting_create.php" method="POST" id="createForm"
                            enctype="multipart/form-data">

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="name">Hotel
                                    Name<span class="required">*</span></label>

                                <div class="col-md-6 col-sm-6">
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="<?php echo $name; ?>" placeholder="ex. Softguide Hotel" autofocus />
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide" id=""></label>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="email">Hotel
                                    Email<span class="required">*</span>
                                </label>

                                <div class="col-md-6 col-sm-6">
                                    <input type="email" class="form-control" name="email" id="email"
                                        value="<?php echo $email; ?>" placeholder="ex. softguide@gmail.com" />
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide" id=""></label>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="address">Hotel
                                    Address<span class="required">*</span></label>

                                <div class="col-md-6 col-sm-6">
                                    <textarea name="address" class="form-control" id="address" cols="30" rows="4"
                                        placeholder="Enter Hotel Address"><?php echo $address; ?></textarea>
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide" id=""></label>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="check_in">
                                    Check In Time<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <div class='input-group date' id='check_in'>
                                        <input type='text' class="form-control" name="check_in"
                                            value="<?php echo $check_in; ?>" placeholder="Choose Check In " />
                                        <span class="input-group-addon">
                                            <span class="">
                                                <i class="fa-solid fa-clock" style="padding:5px;"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide" id=""></label>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="check_out">
                                    Check Out Time<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <div class='input-group date' id='check_out'>
                                        <input type='text' class="form-control" name="check_out"
                                            value="<?php echo $check_out; ?>" placeholder="Choose Check Out " />
                                        <span class="input-group-addon">
                                            <span class="">
                                                <i class="fa-solid fa-clock" style="padding:5px;"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide" id=""></label>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="outline_phone">
                                    Outlin Phone<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" name="outline_phone" id="outline_phone"
                                        value="<?php echo $outline_phone; ?>" placeholder="ex. 0123222" type="number" />
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide" id=""></label>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="online_phone">
                                    Onlin Phone<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" name="online_phone" id="online_phone"
                                        value="<?php echo $online_phone; ?>" placeholder="ex. 0911223344"
                                        type="number" />
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide" id=""></label>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="size_unit">
                                    Room Size Unit<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" name="size_unit" id="size_unit"
                                        value="<?php echo $size_unit; ?>" placeholder="ex. mm²" type="text" />
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide" id=""></label>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="occupancy">
                                    Occupancy<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" name="occupancy" id="occupancy"
                                        value="<?php echo $occupancy; ?>" placeholder="ex. People" type="text" />
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide" id=""></label>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="price_unit">
                                    Price Unit<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" name="price_unit" id="price_unit"
                                        value="<?php echo $price_unit; ?>" placeholder="ex. Kyats" type="text" />
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide" id=""></label>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="">
                                    Hotel Logo<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 d-flex justify-content-center">
                                    <div
                                        class="preview-wrapper rounded  d-flex justify-content-center align-items-center">
                                        <label class="thumb-upload btn btn-info" style="<?php if ($setting_logo == '') {
                                                                                        echo 'display:block';
                                                                                    } else {
                                                                                        echo 'display:none';
                                                                                    } ?>">Upload
                                            Image</label>
                                        <div class="preview-container">
                                            <a class="thumb-update btn btn-info text-white" style="<?php if ($setting_logo == '') {
                                                                                                        echo 'display:none';
                                                                                                    } else {
                                                                                                        echo 'display:block';
                                                                                                    } ?>">Update
                                                Image</a>
                                            <img src="<?php echo $setting_logo; ?>" class="preview-img" />
                                        </div>
                                    </div>
                                    <input type="file" name="file" id="thumb_file" style="display: none;"
                                        accept="image/*">
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide" id=""></label>
                            </div>
                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3">
                                        <button type='submit' class="btn btn-primary" id="submit-btn">Submit</button>
                                        <button type='reset' class="btn btn-success" id="reset-btn">Reset</button>
                                        <input type="hidden" name="form-sub" value="1">
                                        <?php
                                        if (isset($id)) {
                                        ?>
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <?php
                                        }
                                        ?>
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
<script>
$(document).ready(function() {
    $('#check_in').datetimepicker({
        format: 'hh:mm A'
    });
    $('#check_out').datetimepicker({
        format: 'hh:mm A'
    });
    // $("#submit-btn").click(function () {
    //     let error = false;
    //     const view_name = $("#viewName").val();
    //     const view_name_length = view_name.length;

    //     if (view_name == '') {
    //         $("#viewName_error").text('Please fill hotel room view name');
    //         $("#viewName_error").show();
    //         error = true;
    //     }
    //     if (view_name_length < 2 && view_name != '') {
    //         $("#viewName_error").text('Hotel room view name must be greater then two.');
    //         $("#viewName_error").show();
    //         error = true;
    //     }
    //     if (view_name_length > 20 && view_name != '') {
    //         $("#viewName_error").text('Hotel room view name must be less then twenty.');
    //         $("#viewName_error").show();
    //         error = true;
    //     }
    //     if (!error) {
    //         $("#viewName_error").hide();
    //         $("#createForm").submit();
    //     }
    // });
    // when click reset btn
    // $("#reset-btn").click(function() {
    //     $("#viewName_error").hide();
    //     $('#viewName').val('');
    // })

})
</script>



</html>