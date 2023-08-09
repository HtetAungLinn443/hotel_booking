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
                <h3>Hotel Room View</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <h3>View Create</h3>
                    <button onclick="history.back()" class="btn btn-dark">Back</button>
                    <div class="x_content">
                        <br />
                        <form action="<?php echo $cp_base_url; ?>view_create.php" method="POST" id="createForm">

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="viewName">Hotel
                                    Name<span class="required">*</span></label>

                                <div class="col-md-6 col-sm-6">
                                    <input type="text" class="form-control" name="name" id="viewName" value="<?php echo $name; ?>" placeholder="ex. Softguide Hotel" autofocus />
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide" id=""></label>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="viewName">Hotel
                                    Email<span class="required">*</span>
                                </label>

                                <div class="col-md-6 col-sm-6">
                                    <input type="email" class="form-control" name="name" id="viewName" value="" placeholder="ex. softguide@gmail.com" />
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide" id=""></label>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="viewName">Hotel
                                    Address<span class="required">*</span></label>

                                <div class="col-md-6 col-sm-6">
                                    <textarea name="address" class="form-control" cols="30" rows="4" placeholder="Enter Hotel Address"></textarea>
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide" id=""></label>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="viewName">
                                    Check In Time<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <div class='input-group date' id='check_in'>
                                        <input type='text' class="form-control" placeholder="Choose Check In " />
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
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="viewName">
                                    Check In Time<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <div class='input-group date' id='check_out'>
                                        <input type='text' class="form-control" placeholder="Choose Check Out " />
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
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="viewName">
                                    Outlin Phone<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" name="name" id="viewName" value="" placeholder="ex. 0123222" type="number" />
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide" id=""></label>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="viewName">
                                    Onlin Phone<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" name="name" id="viewName" value="" placeholder="ex. 0911223344" type="number" />
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide" id=""></label>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="viewName">
                                    Room Size Unit<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" name="name" id="viewName" value="" placeholder="ex. 0911223344" type="text" />
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide" id=""></label>
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


<!-- /page content -->
<?php
require "../templates/cp_template_footer.php";
?>

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