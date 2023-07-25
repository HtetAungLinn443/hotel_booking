<?php
session_start();
require "../requires/common.php";
require "../requires/connect.php";
require "../requires/check_authencation.php";
require "../requires/include_function.php";
$name = '';
$process_error = false;
$error = false;
$err_msg = "";

if (isset($_POST['form-sub']) && $_POST['form-sub'] == '1') {
    $name = $mysqli->real_escape_string($_POST['name']);

    if ($name == null) {
        $process_error = true;
        $error = true;
        $err_msg = "Please Fill Room View Name";
    }
    $nameCheck = "SELECT name,deleted_at FROM `view` WHERE name = '$name' AND deleted_at IS NULL";
    $check_result = $mysqli->query($nameCheck);
    if ($check_result->num_rows >= 1) {
        $process_error = true;
        $error = true;
        $err_msg .= "This " . $name . "is Alreadey Exit";
    }

    if (!$process_error) {
        $today_date = date('Y-m-d H:i:s');
        $user_id = (isset($_SESSION['id'])) ? $_SESSION['id'] : $_COOKIE['id'];
        $table = 'view';
        $insert_data = array(
            'name' => "'$name'",
            'created_at' => "'$today_date'",
            'created_by' => "'$user_id'",
            'updated_at' => "'$today_date'",
            'updated_by' => "'$user_id'",
        );
        $result = insertQuery($insert_data, $table, $mysqli);
        if ($result) {
            $msg = " View Create Successfully ";
            $url = $cp_base_url . "view_list.php?success=" . urlencode($msg);
            header("Refresh: 0; url=$url");
            exit();
        }

    }
}
$title = "Hotel Booking";
require "../templates/cp_template_header.php";
require "../templates/cp_template_sidebar_menu.php";
require "../templates/cp_template_top_nav.php";

?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Hotel Room View</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <h3>View Create</h3>
                    <div class="x_content">
                        <br />
                        <form action="<?php echo $cp_base_url; ?>view_create.php" method="POST" novalidate>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Name<span
                                        class="required">*</span></label>

                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" name="name" value="<?php echo $name; ?>"
                                        placeholder="ex. Lake View" required="required" min="3" />
                                </div>
                            </div>

                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3">
                                        <button type='submit' class="btn btn-primary">Submit</button>
                                        <button type='reset' class="btn btn-success">Reset</button>
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
<!-- PNotify -->
    <script src="<?php echo $base_url ?>assets/backend/js/pnotify/pnotify.js"></script>
    <script src="<?php echo $base_url ?>assets/backend/js/pnotify/pnotify.buttons.js"></script>
    <script src="<?php echo $base_url ?>assets/backend/js/pnotify/pnotify.nonblock.js"></script>
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
<!-- <script>

    var validator = new FormValidator({
        "events": ['blur', 'input', 'change']
    }, document.forms[0]);

    document.forms[0].onsubmit = function (e) {
        var submit = true,
            validatorResult = validator.checkAll(this);
        console.log(validatorResult);
        return !!validatorResult.valid;
    };

    document.forms[0].onreset = function (e) {
        validator.reset();
    };

</script> -->