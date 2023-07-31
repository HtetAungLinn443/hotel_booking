<?php
session_start();
require "../requires/common.php";
require "../requires/connect.php";
require "../requires/check_authencation.php";
require "../requires/include_function.php";
$table = 'room';

$amenity_table = 'amenity';
$select_column = ['id', 'name', 'type'];
$order_by = [
    'type' => 'ASC',
    'id' => 'ASC',
];
$amenity_res = listQuery($select_column, $amenity_table, $mysqli, $order_by);
$amenity_row = $amenity_res->num_rows;

//
$amenity_groups = array();

if ($amenity_row >= 1) {
    while ($row = $amenity_res->fetch_assoc()) {
        $amenity_id = (int)($row['id']);
        $amenity_name = htmlspecialchars($row['name']);
        $amenity_type = htmlspecialchars($row['type']);

        // Check if the amenity type already exists in the $amenity_groups array
        if (!isset($amenity_groups[$amenity_type])) {
            $amenity_groups[$amenity_type] = array();
        }

        // Add the amenity to its respective type group
        $amenity_groups[$amenity_type][] = array('id' => $amenity_id, 'name' => $amenity_name);
    }
}


//
$feature_table = 'special_feature';
$select_column = ['id', 'name'];
$order_by = [
    'id' => 'ASC',
];
$feature_res = listQuery($select_column, $feature_table, $mysqli, $order_by);
$feature_row = $feature_res->num_rows;

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
                        <form action="<?php echo $cp_base_url; ?>view_create.php" method="POST" id="createForm" enctype="multipart/form-data">
                            <div class="field item form-group">
                                <div class=" col-6 offset-3 d-flex justify-content-center">
                                    <div class="preview-wrapper rounded p-3 d-flex justify-content-center align-items-center">
                                        <label class="thumb-upload btn btn-info">Upload Image</label>
                                    </div>
                                    <input type="file" name="thumb-file" id="thumb_file" style="display: none;">
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="">Room
                                    Name<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" name="name" placeholder="ex. Lake View" autofocus />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="">Occupation<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="number" class="form-control" name="name" placeholder="ex. 1" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="">Bed<span class="required">*</span></label>
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
                                    <input type="number" class="form-control" name="name" placeholder="Enter room size" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="">Room View<span class="required">*</span></label>
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
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="">Room Price Per
                                    Day<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="number" class="form-control" name="name" placeholder="ex. 100$" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="">Extra Bed Price Per
                                    Day<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="number" class="form-control" name="name" placeholder="ex. 30$" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="description">Description<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea name="description" id="description" class="form-control" placeholder="Description" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="details">Details<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea name="room_details" id="details" class="form-control" placeholder="Details" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="field item form-group my-3">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="">Room Amenity<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <?php
                                    foreach ($amenity_groups as $type => $amenities) {
                                    ?>
                                        <div class="amenity-group">
                                            <h5><?php if ($type == 0) {
                                                    echo 'General';
                                                } elseif ($type == 1) {
                                                    echo 'Bathroom';
                                                } else {
                                                    echo 'Other';
                                                } ?></h5>
                                            <?php
                                            foreach ($amenities as $amenity) {
                                            ?>
                                                <div class="col-md-6">
                                                    <label>
                                                        <input type="checkbox" class="mr-2" value="<?php echo $amenity['id']; ?>" name="room_amenity[]">
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

                            </div>

                            <div class="field item form-group">

                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="">Room Special Feature<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <?php if ($feature_row >= 1) {
                                        while ($row = $feature_res->fetch_assoc()) {
                                            $feature_id = (int) ($row['id']);
                                            $feature_name = htmlspecialchars($row['name']);
                                    ?>
                                            <div class="col-md-12">
                                                <label>
                                                    <input type="checkbox" class="mr-2" value="<?php echo $feature_id; ?>" name="room_feature[]"><?php echo $feature_name; ?>
                                                </label>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="">Thumbnail Image<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="file" class="form-control" name="name" accept="image/*" />
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="">Room Images<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="file" class="form-control" name="name" multiple accept="image/*" />
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

<!-- /page content -->
<?php
require "../templates/cp_template_footer.php";
?>
<script>
    $(document).ready(function() {
        $('.thumb-upload').click(function() {
            $("#thumb_file").click();
        })

        $("#thumb_file").change(function(){
            
        })
    })
</script>

</html>