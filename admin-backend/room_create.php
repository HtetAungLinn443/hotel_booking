<?php
session_start();
require "../requires/common.php";
require "../requires/connect.php";
require "../requires/check_authencation.php";
require "../requires/include_function.php";
$table = 'room';
$err_msg = '';
$error = false;
$room_name = '';
$room_occupation = '';
$room_bed = '';
$room_size = '';
$room_view = '';
$room_price = '';
$extra_bed_price = '';
$description = '';
$room_details = '';
$room_amenity = [];
$room_feature = [];
// Bed list
$bed_table = 'bed_type';
$select_column = ['id', 'name'];
$order_by = [
    'id' => 'ASC',
];
$bed_res = listQuery($select_column, $bed_table, $mysqli, $order_by);
$bed_row = $bed_res->num_rows;

// view list
$view_table = 'view';
$select_column = ['id', 'name'];
$order_by = [
    'id' => 'ASC',
];
$view_res = listQuery($select_column, $view_table, $mysqli, $order_by);
$view_row = $view_res->num_rows;

// amenity list
$amenity_table = 'amenity';
$select_column = ['id', 'name', 'type'];
$order_by = [
    'type' => 'ASC',
    'id' => 'ASC',
];
$amenity_res = listQuery($select_column, $amenity_table, $mysqli, $order_by);
$amenity_row = $amenity_res->num_rows;
$amenity_groups = array();

if ($amenity_row >= 1) {
    while ($row = $amenity_res->fetch_assoc()) {
        $amenity_id = (int) ($row['id']);
        $amenity_name = htmlspecialchars($row['name']);
        $amenity_type = htmlspecialchars($row['type']);
        if (!isset($amenity_groups[$amenity_type])) {
            $amenity_groups[$amenity_type] = array();
        }
        $amenity_groups[$amenity_type][] = array('id' => $amenity_id, 'name' => $amenity_name);
    }
}

// Feature List
$feature_table = 'special_feature';
$select_column = ['id', 'name'];
$order_by = [
    'id' => 'ASC',
];
$feature_res = listQuery($select_column, $feature_table, $mysqli, $order_by);
$feature_row = $feature_res->num_rows;

if (isset($_POST['form-sub']) && $_POST['form-sub'] == '1') {

    $room_name = $mysqli->real_escape_string($_POST['room_name']);
    $room_occupation = $mysqli->real_escape_string($_POST['room_occupation']);
    $room_bed = $mysqli->real_escape_string($_POST['room_bed']);
    $room_size = $mysqli->real_escape_string($_POST['room_size']);
    $room_view = $mysqli->real_escape_string($_POST['room_view']);
    $room_price = $mysqli->real_escape_string($_POST['room_price']);
    $extra_bed_price = $mysqli->real_escape_string($_POST['extra_bed_price']);
    $description = $mysqli->real_escape_string($_POST['description']);
    $room_details = $mysqli->real_escape_string($_POST['room_details']);
    $process_error = false;
    if ($_FILES['thumb_file']['name'] != '') {
        $image_upload = false;
        $file = $_FILES['thumb_file'];
        $fileName = $file['name'];
        $fileType = $file['type'];
        $fileTempPath = $file['tmp_name'];
        $fileError = $file['error'];
        $allowFileType = ['png', 'jpg', 'jpeg', 'gif'];
        $explode = explode('.', $fileName);
        $extension = end($explode);
        if (in_array($extension, $allowFileType)) {
            if (getimagesize($fileTempPath)) {
                $image_upload = true;
                $uniqueName = date('Y-m-d_H-i-s') . uniqid() . '.' . $extension;
            } else {
                $error = true;
                $err_msg .= "<li class='text-danger'>Invalid Image file! </li>";
            }

        } else {
            $error = true;
            $err_msg .= "<li class='text-danger'>File allow png, jpg, jpeg and gif Files Only! </li>";
        }
    }
    if ($room_name == '') {
        $process_error = true;
        $error = true;
        $err_msg .= 'Please Fill Room Name <br/>';
    }

    $check_colume = array(
        'name' => $room_name,
    );
    $name_unique = checkUniqueValue($check_colume, $table, $mysqli);
    if ($name_unique >= 1) {
        $process_error = true;
        $error = true;
        $err_msg .= "This " . $room_name . " Name is Alreadey Exit";
    }

    if ($room_occupation == '') {
        $process_error = true;
        $error = true;
        $err_msg .= 'Please Fill Room Occupation <br/>';
    }
    if ($room_bed == '') {
        $process_error = true;
        $error = true;
        $err_msg .= 'Please Choose Room Bed Type <br/>';
    }
    if ($room_size == '') {
        $process_error = true;
        $error = true;
        $err_msg .= 'Please Fill Room Size <br/>';
    }
    if ($room_view == '') {
        $process_error = true;
        $error = true;
        $err_msg .= 'Please Choose Room View <br/>';
    }
    if ($room_price == '') {
        $process_error = true;
        $error = true;
        $err_msg .= 'Please Fill Room Price Per Day <br/>';
    }
    if ($extra_bed_price == '') {
        $process_error = true;
        $error = true;
        $err_msg .= 'Please Fill Room Extra Bed Price Per Day <br/>';
    }
    if ($description == '') {
        $process_error = true;
        $error = true;
        $err_msg .= 'Please Fill Room Description <br/>';
    }
    if ($room_details == '') {
        $process_error = true;
        $error = true;
        $err_msg .= 'Please Fill Room Details <br/>';
    }
    if (!isset($_POST['room_amenity'])) {
        $process_error = true;
        $error = true;
        $err_msg .= 'Please Choose Room Amenities <br/>';
    } else {
        $room_amenity = $_POST['room_amenity'];
    }
    if (!isset($_POST['room_feature'])) {
        $process_error = true;
        $error = true;
        $err_msg .= 'Please Choose Room Special Features <br/>';
    } else {
        $room_feature = $_POST['room_feature'];
    }

    if (!$process_error) {
        $today_date = date('Y-m-d H:i:s');
        $user_id = (isset($_SESSION['id'])) ? $_SESSION['id'] : $_COOKIE['id'];
        // var_dump($image_upload);
        // exit();
        if ($image_upload == false) {
            $insert_room_data = array(
                'name' => "'$room_name'",
                'size' => "'$room_size'",
                'occupancy' => "'$room_occupation'",
                'bad_type_id' => "'$room_bed'",
                'view_id' => "'$room_view'",
                'description' => "'$description'",
                'details' => "'$room_details'",
                'price_per_day' => "'$room_price'",
                'extra_bed_price_per_day' => "'$extra_bed_price'",
                'created_at' => "'$today_date'",
                'created_by' => "'$user_id'",
                'updated_at' => "'$today_date'",
                'updated_by' => "'$user_id'",
            );
            $room_result = insertQuery($insert_room_data, $table, $mysqli);
            echo $room_result;
            exit();
            if ($room_result) {
                $room_id = $mysqli->insert_id;
                //  insert amenity data
                foreach ($room_amenity as $amenity) {
                    $insert_amenity_data = array(
                        'room_id' => "'$room_id'",
                        'amenity_id' => "'$amenity'",
                        'created_at' => "'$today_date'",
                        'created_by' => "'$user_id'",
                        'updated_at' => "'$today_date'",
                        'updated_by' => "'$user_id'",
                    );
                    insertQuery($insert_amenity_data, 'room_amenity', $mysqli);
                }

                // insert special feature
                foreach ($room_feature as $feature) {
                    $insert_feature_data = array(
                        'room_id' => "'$room_id'",
                        'special_feature_id' => "'$feature'",
                        'created_at' => "'$today_date'",
                        'created_by' => "'$user_id'",
                        'updated_at' => "'$today_date'",
                        'updated_by' => "'$user_id'",
                    );
                    insertQuery($insert_feature_data, 'room_special_feature', $mysqli);
                }

            }
            // $url = $cp_base_url . "room_list.php?msg=success";
            // header("Refresh: 0; url=$url");
            // exit(); 
        } else {
            $insert_room_data = array(
                'name' => "'$room_name'",
                'size' => "'$room_size'",
                'occupancy' => "'$room_occupation'",
                'bad_type_id' => "'$room_bed'",
                'view_id' => "'$room_view'",
                'description' => "'$description'",
                'details' => "'$room_details'",
                'price_per_day' => "'$room_price'",
                'extra_bed_price_per_day' => "'$extra_bed_price'",
                'thumbnail_img' => "'$uniqueName'",
                'created_at' => "'$today_date'",
                'created_by' => "'$user_id'",
                'updated_at' => "'$today_date'",
                'updated_by' => "'$user_id'",
            );
            $room_result = insertQuery($insert_room_data, $table, $mysqli);
            var_dump($room_result);
            exit();
            if ($room_result) {
                $room_id = $mysqli->insert_id;
                //  insert amenity data
                foreach ($room_amenity as $amenity) {
                    $insert_amenity_data = array(
                        'room_id' => "'$room_id'",
                        'amenity_id' => "'$amenity'",
                        'created_at' => "'$today_date'",
                        'created_by' => "'$user_id'",
                        'updated_at' => "'$today_date'",
                        'updated_by' => "'$user_id'",
                    );
                    insertQuery($insert_amenity_data, 'room_amenity', $mysqli);
                }

                // insert special feature
                foreach ($room_feature as $feature) {
                    $insert_feature_data = array(
                        'room_id' => "'$room_id'",
                        'special_feature_id' => "'$feature'",
                        'created_at' => "'$today_date'",
                        'created_by' => "'$user_id'",
                        'updated_at' => "'$today_date'",
                        'updated_by' => "'$user_id'",
                    );
                    insertQuery($insert_feature_data, 'room_special_feature', $mysqli);
                }
                $filePath = '../assets/upload/' . $room_id . '/';
                if (!file_exists($filePath)) {
                    if (!mkdir($filePath, 0777, true)) {
                        die('Failed to create directory.');
                    }
                }
                if (file_exists($fileTempPath)) {
                    if (move_uploaded_file($fileTempPath, $filePath . $uniqueName)) {

                    } else {
                        $error = true;
                        $error_msg .= "Failed to upload file!";
                    }
                } else {
                    $error = true;
                    $error_msg .= "File does not exist!";
                }
            }


            // $url = $cp_base_url . "room_list.php?msg=success";
            // header("Refresh: 0; url=$url");
            // exit();
        }


    }
}

$title = "Hotel Booking:: Room Create Page";
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
                        <form action="<?php echo $cp_base_url; ?>room_create.php" method="POST" id="createForm"
                            enctype="multipart/form-data">
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="room_name">Room
                                    Thumbnail<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 d-flex justify-content-center">
                                    <div
                                        class="preview-wrapper rounded  d-flex justify-content-center align-items-center">
                                        <label class="thumb-upload btn btn-info">Upload
                                            Image</label>
                                        <div class="preview-container" style="display:none;">
                                            <a class="thumb-update btn btn-info text-white">Update Image</a>
                                            <img src="" class="preview-img" />
                                        </div>
                                    </div>
                                    <input type="file" name="thumb_file" id="thumb_file" value="" style="display: none;"
                                        accept="image/*">
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide"
                                    id="thumb_error"></label>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="room_name">Room
                                    Name<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" name="room_name" id="room_name"
                                        placeholder="ex. Lake View" autofocus value="<?php echo $room_name; ?>" />
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error "
                                    id="room_name_error"></label>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align"
                                    for="room_occupation">Occupation<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="number" class="form-control" name="room_occupation"
                                        id="room_occupation" placeholder="ex. 1" min="1" max="12"
                                        value="<?php echo $room_occupation; ?>" />
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide"
                                    id="room_occupation_error"></label>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="room_bed">Bed<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select name="room_bed" id="room_bed" class="form-control">
                                        <option value="">Choose Bed Type</option>
                                        <?php if ($bed_row >= 1) {
                                            while ($row = $bed_res->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo htmlspecialchars($row['id']) ?>" <?php if ($room_bed == $row['id']) {
                                                       echo "selected";
                                                   }
                                                   ?>>
                                                    <?php echo htmlspecialchars($row['name']) ?> </option>
                                                <?php
                                            }
                                        } ?>
                                    </select>
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide"
                                    id="room_bed_error"></label>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="room_size">Room
                                    Size<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="number" class="form-control" name="room_size" id="room_size"
                                        placeholder="Enter room size" value="<?php echo $room_size; ?>" />
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide"
                                    id="room_size_error"></label>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="room_view">Room
                                    View<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select name="room_view" id="room_view" class="form-control">
                                        <option value="">Choose View</option>
                                        <?php if ($view_row >= 1) {
                                            while ($row = $view_res->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo htmlspecialchars($row['id']) ?>" <?php if ($room_view == $row['id']) {
                                                       echo "selected";
                                                   }
                                                   ?>>
                                                    <?php echo htmlspecialchars($row['name']) ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide"
                                    id="room_view_error"></label>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="room_price">Room Price
                                    Per Day<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="number" class="form-control" name="room_price" id="room_price"
                                        placeholder="ex. 100$" value="<?php echo $room_price ?>" />
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide"
                                    id="room_price_error"></label>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="extra_bed_price">Extra
                                    Bed Price Per
                                    Day<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="number" class="form-control" name="extra_bed_price"
                                        id="extra_bed_price" placeholder="ex. 30$"
                                        value="<?php echo $extra_bed_price ?>" />
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide"
                                    id="extra_bed_price_error"></label>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align"
                                    for="description">Description<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea name="description" id="description" class="form-control"
                                        placeholder="Description" rows="4"><?php echo $description ?></textarea>
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide"
                                    id="description_error"></label>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align"
                                    for="room_details">Details<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea name="room_details" id="room_details" class="form-control"
                                        placeholder="Details" rows="4"><?php echo $room_details ?></textarea>
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide"
                                    id="room_details_error"></label>
                            </div>

                            <div class="field item form-group my-3">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Room Amenity<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <?php
                                    foreach ($amenity_groups as $type => $amenities) {
                                        ?>
                                        <div class="amenity-group">

                                            <h5 class="col-md-12">
                                                <?php if ($type == 0) {
                                                    echo 'General';
                                                } elseif ($type == 1) {
                                                    echo 'Bathroom';
                                                } else {
                                                    echo 'Other';
                                                } ?>
                                            </h5>
                                            <?php
                                            foreach ($amenities as $amenity) {
                                                ?>
                                                <div class="col-md-6">
                                                    <label>
                                                        <input type="checkbox" class="mr-2"
                                                            value="<?php echo $amenity['id']; ?>" name="room_amenity[]" <?php if (in_array($amenity['id'], $room_amenity)) {
                                                                   echo "checked";
                                                               } ?>>
                                                        <?php echo $amenity['name']; ?>
                                                    </label>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide"
                                    id="room_amenity_error"></label>

                            </div>

                            <div class="field item form-group">

                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="">Room Special
                                    Feature<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <?php if ($feature_row >= 1) {
                                        while ($row = $feature_res->fetch_assoc()) {
                                            $feature_id = (int) ($row['id']);
                                            $feature_name = htmlspecialchars($row['name']);
                                            ?>
                                            <div class="col-md-12">
                                                <label>
                                                    <input type="checkbox" class="mr-2" value="<?php echo $feature_id; ?>"
                                                        name="room_feature[]" <?php if (in_array($feature_id, $room_feature)) {
                                                            echo "checked";
                                                        } ?>><?php echo $feature_name; ?>
                                                </label>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide"
                                    id="room_feature_error"></label>
                            </div>

                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3">
                                        <button type='submit' class="btn btn-primary" id="submit-btn">Submit</button>
                                        <button type='reset' class="btn btn-success" id="reset-btn">Reset</button>
                                        <input type="hidden" name="form-sub" value="1">
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