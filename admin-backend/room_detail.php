<?php
session_start();
require "../requires/common.php";
require "../requires/connect.php";
require "../requires/check_authencation.php";
require "../requires/include_function.php";
$table = 'room';
if (!isset($_GET['id'])) {
    $url = $cp_base_url . "room_list.php?msg=error";
    header("Refresh: 0; url=$url");
    exit();
}
$id = (int) ($_GET['id']);
$id = $mysqli->real_escape_string($id);


$sql = "SELECT 
            T01.name AS room_name,
            T01.size AS room_size,
            T01.occupancy,
            T01.description,
            T01.details,
            T01.price_per_day AS room_price,
            T01.extra_bed_price_per_day AS extra_bed_price,
            T01.thumbnail_img,
            T02.name AS bed_type,
            T03.name AS view_name 
        FROM 
            `room` AS T01 
        LEFT JOIN 
            `bed_type` AS T02 ON T01.bad_type_id = T02.id 
        LEFT JOIN 
            `view` AS T03 ON T01.view_id = T03.id
        WHERE T01.id = '$id'";

$result = $mysqli->query($sql);

$row_res = $result->num_rows;
if ($row_res <= 0) {
    $url = $cp_base_url . "room_list.php?msg=error";
    header("Refresh: 0; url=$url");
    exit();
}
$row_res = $result->num_rows;

if ($row_res >= 1) {
    $row = $result->fetch_assoc();

    $room_name = htmlspecialchars($row['room_name']);
    $room_occupation = htmlspecialchars($row['occupancy']);
    $room_bed = htmlspecialchars($row['bed_type']);
    $room_size = htmlspecialchars($row['room_size']);
    $room_view = htmlspecialchars($row['view_name']);
    $room_price = htmlspecialchars($row['room_price']);
    $extra_bed_price = htmlspecialchars($row['extra_bed_price']);
    $description = htmlspecialchars($row['description']);
    $room_details = htmlspecialchars($row['details']);
    $thumb = htmlspecialchars($row['thumbnail_img']);
    $thumb_path = $base_url . 'assets/upload/' . $id . '/thumb/' . $thumb;

    // room gallery
    $sql = "SELECT * FROM `room_gallery` WHERE room_id = '$id'";
    $img_res = $mysqli->query($sql);
    $img_row = $img_res->num_rows;
}


?>
<?php
$title = "Hotel Booking:: Room Details Page";
require "../templates/cp_template_header.php";
require "../templates/cp_template_sidebar_menu.php";
require "../templates/cp_template_top_nav.php";

?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Hotel Room Details</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row">
                            <h1 class="col-12 text-center text-dark"> <?php echo $room_name; ?></h1>
                            <?php
                            if ($img_row >= 0) {
                                while ($row = $img_res->fetch_assoc()) {
                                    $img_path = $base_url . 'assets/upload/' . $id . '/' . $row['image'];
                            ?>
                            <div class="col-md-3 p-1">
                                <div class="">
                                    <img src="<?php echo $img_path; ?>" class="img-thumbnail w-100">
                                </div>
                            </div>
                            <?php
                                }
                            }
                            ?>
                            <div class="col-md-4 mt-4 offset-2 text-dark">
                                <p class="" style="font-size: 18px;">
                                    Occupancy :
                                    <span>
                                        <?php echo $room_occupation; ?>
                                        <?php echo (isset($setting['occupancy'])) ? $setting['occupancy'] : ""; ?>
                                    </span>
                                </p>
                                <p class="" style="font-size: 18px;">
                                    Room Size :
                                    <span>
                                        <?php echo $room_size; ?>
                                        <?php echo (isset($setting['size_unit'])) ? $setting['size_unit'] : ""; ?>
                                    </span>
                                </p>
                                <p class="" style="font-size: 18px;">
                                    Price Per Day :
                                    <span>
                                        <?php echo $room_price; ?>
                                        <?php echo (isset($setting['price_unit'])) ? $setting['price_unit'] : ""; ?>
                                    </span>
                                </p>
                                <ul>
                                    <li style="font-size:18px;">
                                        dfsajkh
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-4 mt-4 offset-2 text-dark">
                                <p class="" style="font-size: 18px;">
                                    View :
                                    <span>
                                        <?php echo $room_view; ?>
                                    </span>
                                </p>
                                <p class="" style="font-size: 18px;">
                                    Bed Type :
                                    <span>
                                        <?php echo $room_bed; ?>
                                    </span>
                                </p>
                                <p class="" style="font-size: 18px;">
                                    Price Per Day :
                                    <span>
                                        <?php echo $extra_bed_price; ?>
                                        <?php echo (isset($setting['price_unit'])) ? $setting['price_unit'] : ""; ?>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require "../templates/cp_template_footer.php";
?>