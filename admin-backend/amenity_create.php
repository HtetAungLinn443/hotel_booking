<?php
session_start();
require "../requires/common.php";
require "../requires/connect.php";
require "../requires/check_authencation.php";
require "../requires/include_function.php";
$name = '';
$type = '';
$process_error = false;
$error = false;
$err_msg = "";
$table = 'amenity';
if (isset($_POST['form-sub']) && $_POST['form-sub'] == '1') {
    $name = $mysqli->real_escape_string($_POST['name']);
    $type = $_POST['type'];

    if ($name == null) {
        $process_error = true;
        $error = true;
        $err_msg = "Please Fill Room Aminity Name";
    }
    if ($type == null) {
        $process_error = true;
        $error = true;
        $err_msg .= "Please Select Room Aminity Type";
    }
    $check_colume = array(
        'name' => $name,
        'type' => $type,
    );
    $name_unique = checkUniqueValue($check_colume, $table, $mysqli);

    if ($name_unique >= 1) {
        $process_error = true;
        $error = true;
        $err_msg .= "This Name is Alreadey Exit";
    }

    if (!$process_error) {
        $today_date = date('Y-m-d H:i:s');
        $user_id = (isset($_SESSION['id'])) ? $_SESSION['id'] : $_COOKIE['id'];
        $today_date = date('Y-m-d H:i:s');
        $user_id = (isset($_SESSION['id'])) ? $_SESSION['id'] : $_COOKIE['id'];

        $insert_data = array(
            'name' => "'$name'",
            'type' => "'$type'",
            'created_at' => "'$today_date'",
            'created_by' => "'$user_id'",
            'updated_at' => "'$today_date'",
            'updated_by' => "'$user_id'",
        );
        $result = insertQuery($insert_data, $table, $mysqli);
        if ($result) {
            $msg = " View Create Successfully ";
            $url = $cp_base_url . "amenity_list.php?success=" . $msg;
            header("Refresh: 0; url=$url");
            exit();
        }
    }
}
$title = "Hotel Booking::Anemity Create Page";
require "../templates/cp_template_header.php";
require "../templates/cp_template_sidebar_menu.php";
require "../templates/cp_template_top_nav.php";

?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Hotel Room Amenity</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <h3>Amenity Create</h3>
                    <div class="x_content">
                        <br />
                        <form action="<?php echo $cp_base_url; ?>amenity_create.php" method="POST" id="createForm">

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Name<span class="required">*</span></label>

                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" name="name" value="<?php echo $name; ?>" placeholder="ex. 43” LED TV" required="required" autofocus id="viewName" />
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide" id="viewName_error"></label>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Type<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control" name="type" id="selectForm">
                                        <option value="">Choose option</option>
                                        <option <?php if ($type == "0") {
                                                    echo "selected";
                                                } ?> value="0"> <?php echo $aminity_type[0] ?></option>
                                        <option <?php if ($type == "1") {
                                                    echo "selected";
                                                } ?> value="1"><?php echo $aminity_type[1] ?>
                                        </option>
                                        <option <?php if ($type == "2") {
                                                    echo "selected";
                                                } ?> value="2"><?php echo $aminity_type[2] ?>
                                        </option>
                                    </select>
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide" id="selectForm_error"></label>
                            </div>
                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3">
                                        <button type='button' class="btn btn-primary" id="submit-btn">Submit</button>
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

</div>
<!-- /page content -->
<?php
require "../templates/cp_template_footer.php";
?>
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
<script>
    $(document).ready(function() {
        $("#submit-btn").click(function() {
            let error = false;
            const view_name = $("#viewName").val();
            const view_name_length = view_name.length;
            const select_form = $("#selectForm").val();
            if (view_name == '') {
                $("#viewName_error").text('Please fill hotel room amenity name');
                $("#viewName_error").show();
                error = true;
            } else {
                $("#viewName_error").hide();
            }
            if (view_name_length < 2 && view_name != '') {
                $("#viewName_error").text('Hotel room amenity name must be greater then two.');
                $("#viewName_error").show();
                error = true;
            } else {
                $("#viewName_error").hide();
            }
            if (view_name_length > 150 && view_name != '') {
                $("#viewName_error").text('Hotel room view name must be less then eighty.');
                $("#viewName_error").show();
                error = true;
            } else {
                $("#viewName_error").hide();
            }
            if (select_form == '') {
                $("#selectForm_error").text('Please choose anemity type');
                $("#selectForm_error").show();
                error = true;
            } else {
                $("#selectForm_error").hide();
            }
            if (!error) {
                $("#viewName_error").hide();
                $("#createForm").submit();
            }
        });
        $("#reset-btn").click(function() {
            $("#viewName_error").hide();
            $('#viewName').val('');
        })

    })
</script>

</html>