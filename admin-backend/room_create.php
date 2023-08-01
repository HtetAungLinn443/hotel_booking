<?php
session_start();
require "../requires/common.php";
require "../requires/connect.php";
require "../requires/check_authencation.php";
require "../requires/include_function.php";
$table = 'room';

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
    var_dump($_POST);
    exit();
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
                                        class="preview-wrapper rounded p-3 d-flex justify-content-center align-items-center">
                                        <label class="thumb-upload btn btn-info">Upload
                                            Image</label>
                                        <div class="preview-container" style="display:none;">
                                            <a class="thumb-update btn btn-info text-white">Update Image</a>
                                            <img src="" class="preview-img" />
                                        </div>
                                    </div>
                                    <input type="file" name="thumb-file" id="thumb_file" style="display: none;"
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
                                        placeholder="ex. Lake View" autofocus />
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error "
                                    id="room_name_error"></label>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align"
                                    for="room_occupation">Occupation<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="number" class="form-control" name="room_occupation"
                                        id="room_occupation" placeholder="ex. 1" min="1" max="12" />
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
                                        <option value="<?php echo htmlspecialchars($row['id']) ?>">
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
                                        placeholder="Enter room size" />
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
                                        <option value="<?php echo htmlspecialchars($row['id']) ?>">
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
                                        placeholder="ex. 100$" />
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
                                        id="extra_bed_price" placeholder="ex. 30$" />
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide"
                                    id="extra_bed_price_error"></label>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align"
                                    for="description">Description<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea name="description" id="description" class="form-control"
                                        placeholder="Description" rows="4"></textarea>
                                </div>
                                <label class="col-form-label col-md-3 col-sm-3 label-error hide"
                                    id="description_error"></label>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align"
                                    for="room_details">Details<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea name="room_details" id="room_details" class="form-control"
                                        placeholder="Details" rows="4"></textarea>
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
                                                    value="<?php echo $amenity['id']; ?>" name="room_amenity[]">
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
                                                name="room_feature[]"><?php echo $feature_name; ?>
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
    $('.thumb-upload').click(function() {
        $("#thumb_file").click();
    })

    $(".thumb-update").click(function() {
        $("#thumb_file").click();
    })

    $("#thumb_file").change(function(event) {
        var fileInput = event.target.files[0];
        if (fileInput) {
            var fileName = fileInput.name;
            var fileExtension = fileName.split('.').pop().toLowerCase();
            if (fileExtension == 'jpg' || fileExtension == 'jpeg' ||
                fileExtension == 'png' || fileExtension == 'gif') {
                $('.thumb-upload').hide();
                $('.preview-container').show();
                const objectURL = URL.createObjectURL(fileInput);
                const $imageElement = $('.preview-container img').attr('src', objectURL);
                $('.preview-container').append($imageElement);
            } else {
                $("#thumb_error").text('Image extension must be jpg, jpeg, png, gif!');
                $("#thumb_error").show();
            }
        }
    })
    $("#submit-btn").click(function() {
        let error = false;
        const thumb_image = $('#thumb_file').val();
        const room_name = $("#room_name").val();
        const room_occupation = $("#room_occupation").val();
        const room_bed = $("#room_bed").val();
        const room_size = $("#room_size").val();
        const room_view = $("#room_view").val();
        const room_price = $("#room_price").val();
        const extra_bed_price = $("#extra_bed_price").val();
        const description = $("#description").val();
        const room_details = $("#room_details").val();
        const room_amenity = $("input[name='room_amenity[]']:checked").length;
        const room_feature = $("input[name='room_feature[]']:checked").length;

        // test function
        function validateNull($id, $err_id, $msg) {
            if ($id == '') {
                $($err_id).text($msg);
                $($err_id).show();
                error = true;
            }
        }

        function validateCheckbox($id, $err_id, $msg) {
            if ($id == 0) {
                $($err_id).text($msg);
                $($err_id).show();
                error = true;
            }
        }
        validateNull(thumb_image, "#thumb_error", "Please fill hotel room thumbnail image!");
        validateNull(room_name, "#room_name_error", "Please fill hotel room name!");
        validateNull(room_occupation, "#room_occupation_error", "Please fill hotel room occupation!");
        validateNull(room_bed, "#room_bed_error", "Please choose hotel room bed type!");
        validateNull(room_size, "#room_size_error", "Please fill hotel room size!");
        validateNull(room_view, "#room_view_error", "Please choose hotel room view!");
        validateNull(room_price, "#room_price_error", "Please fill hotel room price per day!");
        validateNull(extra_bed_price, "#extra_bed_price_error",
            "Please fill hotel room extra bed price per day!");
        validateNull(description, "#description_error", "Please fill hotel room description!");
        validateNull(room_details, "#room_details_error", "Please fill hotel room details!");

        validateCheckbox(room_amenity, "#room_amenity_error", "Please check hotel room amenity!")
        validateCheckbox(room_feature, "#room_feature_error",
            "Please check hotel room special feature!")
        // if (room_name.length <= 2 && room_name != '') {
        //     $("#room_name_error").text('Hotel room name must be greater then two!');
        //     $("#room_name_error").show();
        //     error = true;
        // }

        // if (room_occupation > 13 && room_occupation != '') {
        //     $("#room_occupation_error").text('Please fill hotel room occupation!');
        //     $("#room_occupation_error").show();
        //     error = true;
        // }

        if (!error) {
            // alert('submit');
            $('#createForm').submit();
        }

    })

    $("#reset-btn").click(function() {
        $(".label-error").hide();
    })
})
</script>

</html>