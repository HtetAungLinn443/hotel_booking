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
$table = 'view';

if (isset($_POST['form-sub']) && $_POST['form-sub'] == '1') {
    $name = $mysqli->real_escape_string($_POST['name']);

    if ($name == null) {
        $process_error = true;
        $error = true;
        $err_msg = "Please Fill Room View Name";
    }

    $check_colume = array(
        'name' => $name,
    );

    $name_check_sql = "SELECT id FROM `view` WHERE name='$name' AND deleted_at IS NULL";
    $name_unique = $mysqli->query($name_check_sql);

    if ($name_unique >= 1) {
        $process_error = true;
        $error = true;
        $err_msg .= "This " . $name . " Name is Alreadey Exit";
    }

    if (!$process_error) {
        $today_date = date('Y-m-d H:i:s');
        $user_id = (isset($_SESSION['id'])) ? $_SESSION['id'] : $_COOKIE['id'];
        $id = $_POST['view_id'];
        $id = $mysqli->real_escape_string($id);

        $sql = "UPDATE `$table` SET name='$name', updated_at='$today_date', updated_by='$user_id' WHERE id='$id'";
        $result = $mysqli->query($sql);

        if ($result >= '1') {

            $msg = " Hotel Room View Name Edit Successfully... ";
            $url = $cp_base_url . "view_list.php?edit=" . urlencode($msg);
            header("Refresh: 0; url=$url");
            exit();
        }
    }
} else {
    if (isset($_GET['id'])) {
        $url = $cp_base_url . "view_list.php?msg=error";

    }
    $current_id = (int) ($_GET['id']);
    $current_id = $mysqli->real_escape_string($current_id);
    $sql = "SELECT id, name FROM `view` WHERE id='$current_id' AND deleted_at IS NULL";
    $result = $mysqli->query($sql);
    while ($row = $result->fetch_assoc()) {
        $name = htmlspecialchars($row['name']);
    }
}
$title = "Hotel Booking:: Edit View Name";
require "../templates/cp_template_header.php";
require "../templates/cp_template_sidebar_menu.php";
require "../templates/cp_template_top_nav.php";

?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Hotel Room View Update</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <h3>View Update</h3>
                    <div class="x_content">
                        <br />
                        <form action="<?php echo $cp_base_url; ?>view_edit.php" method="POST" novalidate
                            id="signupForm">

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="viewName">Name<span
                                        class="required">*</span></label>

                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" name="name" id="viewName" value="<?php echo $name; ?>"
                                        placeholder="ex. Lake View" required="required" />
                                </div>
                            </div>

                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3">
                                        <button type='submit' class="btn btn-primary">Submit</button>
                                        <button type='reset' class="btn btn-success">Reset</button>
                                        <input type="hidden" name="form-sub" value="1">
                                        <input type="hidden" name="view_id" value="<?php echo $current_id; ?>">
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
    $("#signupForm").validate({
        rules: {
            viewName: "required",
            view: "required",
            name: "required",
        },
        messages: {
            viewName: "Please enter your View Name",
            view: "Please enter your View Name",
            name: "Please enter your View Name",
        }
    });

    document.forms[0].onreset = function(e) {
        location.reload();
    };
})
</script>

</html>