<?php
session_start();
require "../requires/common.php";
require "../requires/connect.php";
require "../requires/check_authencation.php";
require "../requires/include_function.php";

if (isset($_POST['form-sub']) && $_POST['form-sub'] == '1') {

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
                        <form action="<?php echo $cp_base_url; ?>view_create.php" method="POST" id="createForm">

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="">Room
                                    Name<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" name="name" placeholder="ex. Lake View" autofocus />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="">Occupation<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="number" class="form-control" name="name" placeholder="ex. 1" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="">Bed<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select name="" id="" class="form-control">
                                        <option value="">Choose Bed Type</option>
                                        <option value="">Single Bed </option>
                                        <option value="">Double Bed </option>
                                        <option value="">Family Bed </option>
                                    </select>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="">Room
                                    Size<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="number" class="form-control" name="name" placeholder="ex. 32''" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="">Room View<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select name="" id="" class="form-control">
                                        <option value="">Choose View</option>
                                        <option value="">Single Bed </option>
                                        <option value="">Double Bed </option>
                                        <option value="">Family Bed </option>
                                    </select>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="">Occupation<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="number" class="form-control" name="name" placeholder="ex. 1" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="">Occupation<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="number" class="form-control" name="name" placeholder="ex. 1" />
                                </div>
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

</html>