<?php

require "requires/common.php";
require "requires/connect.php";
require "requires/include_function.php";
require "requires/setting.php";
$error = false;
$error_message = "";
$form = true;
$room_id = (int) ($_GET['id']);
$room_id = $mysqli->real_escape_string($room_id);
$sql = "SELECT count(id) AS total FROM `room` WHERE id = '$room_id' AND deleted_at IS NULL ";
$room_res = $mysqli->query($sql);
$room_res_row = $room_res->fetch_assoc();
$total_room = $room_res_row['total'];
if ($total_room <= 0) {
    $form = false;
    $error = true;
    $error_message = "The room you looking for does not find.";

} else {
    $gallery_tbl = "room_gallery";
    $gallery_column = ["image"];
    $order_by = ["id" => "ASC"];
    $where = ["room_id" => $room_id];
    $gallery_res = listQuery($gallery_column, $gallery_tbl, $mysqli, $order_by, $where);
    $gallery_res_row = $gallery_res->num_rows;
}

$title = "Contact Page";
$header_title1 = '<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home</a></span> <span>Contact Us</span></p>
	            <h1 class="mb-4 bread">Contact Us</h1>';
$header_title2 = '<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home</a></span> <span>Contact Us</span></p>
	            <h1 class="mb-4 bread">Contact Us</h1>';
require 'templates/template_header.php';
?>

<section class="ftco-section contact-section bg-light">
    <div class="container">
        <div class="row block-9">
            <div class="col-md-6 order-md-last d-flex">
                <form action="#" class="bg-white p-5 contact-form">


                    <div class="form-group">
                        <input type="text" id="checkIn" class="form-control" placeholder="Check In Date">
                    </div>
                    <div class="form-group">
                        <input type="text" id="checkOut" class="form-control" placeholder="Check Out Date">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your Email">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your Phone">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Booking" class="btn btn-primary py-3 px-5">
                    </div>
                </form>
            </div>

            <div class="col-md-6 d-flex">

                <div class="col-md-12 ftco-animate">
                    <div class="single-slider owl-carousel">
                        <?php
                        if ($gallery_res_row >= 0) {
                            while ($row = $gallery_res->fetch_assoc()) {

                                $img_path = $base_url . 'assets/upload/' . $room_id . '/' . $row['image'];
                                ?>
                        <div class="item">
                            <div class="room-img" style="background-image: url(<?php echo $img_path; ?>);"></div>
                        </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require 'templates/template_footer.php'; ?>
<script>
$(document).ready(function() {
    $("#checkIn").datepicker({
        minDate: 0,
        onSelect: function(selectedDate) {
            var minDate = new Date(selectedDate);
            minDate.setDate(minDate.getDate() + 1);
            $("#checkOut").datepicker("option", "minDate", minDate);
            $("#checkOut").prop("distable", false);
        }
    });

    $("#checkOut").datepicker({
        minDate: 0
    });
})
</script>
</body>

</html>