<?php
session_start();
require "../requires/common.php";
require "../requires/connect.php";
require "../requires/check_authencation.php";
$name = '';
if (isset($_POST['form-sub']) && $_POST['form-sub'] == '1') {
    $name           = $_POST['name'];
    $today_date     = date('Y-m-d H:i:s');
    $user_id        = (isset($_SESSION['id'])) ? $_SESSION['id'] : $_COOKIE['id'];
    $sql = "INSERT INTO `special_feature` (name, created_at, created_by, updated_at, updated_by) 
            VALUES ('" . $name . "', '" . $today_date . "', '" . $user_id . "', '" . $today_date . "', '" . $user_id . "')";

    $result = $mysqli->query($sql);
    if ($result) {
        $msg = " View Create Successfully ";
        $url = $cp_base_url . "feature_list.php?success=" . urlencode($msg);
        header("Refresh: 0; url=$url");
        exit();
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
                <h3>Hotel Room Special Feature</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <h3>Special Feature Create</h3>
                    <div class="x_content">
                        <br />
                        <form action="<?php echo $cp_base_url; ?>feature_create.php" method="POST" novalidate>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Name<span
                                        class="required">*</span></label>

                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" name="name" value="<?php echo $name; ?>"
                                        placeholder="ex. Separate shower and bathtub." required="required" min="3" />
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
<script>
// var validator = new FormValidator({
//     "events": ['blur', 'input', 'change']
// }, document.forms[0]);
// on form "submit" event
// document.forms[0].onsubmit = function(e) {
//     var submit = true,
//         validatorResult = validator.checkAll(this);
//     console.log(validatorResult);
//     return !!validatorResult.valid;
// };
// on form "reset" event
document.forms[0].onreset = function(e) {
    validator.reset();
};
</script>