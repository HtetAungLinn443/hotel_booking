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
$sql = "SELECT count(id) AS total ,name, price_per_day, extra_bed_price_per_day FROM `room` WHERE id = '$room_id' AND deleted_at IS NULL ";
$room_res = $mysqli->query($sql);
$room_res_row = $room_res->fetch_assoc();
$total_room = $room_res_row['total'];
$price_per_day = $room_res_row['price_per_day'];
$extra_bed_price = $room_res_row['extra_bed_price_per_day'];

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
$current_page = "our_room";
$header_title1 = '<h1 class="mb-4 bread">Room Reservetion</h1>';
$header_title2 = '<h1 class="mb-4 bread">Room Reservetion</h1>';
require 'templates/template_header.php';
?>


<section class="ftco-section contact-section bg-light">
    <?php if ($form) { ?>
        <div class="container">
            <h1><?php echo $room_res_row['name'] ?></h1>
            <div class="row block-9">
                <div class="col-md-6 order-md-last d-flex">
                    <form action="#" class="bg-white p-5 contact-form">
                        <div class="form-group">
                            <p id="price_per_day">
                                Room Price - <?php echo $price_per_day; ?>
                            </p>
                            <p style="display:none" id="extra_bed_price">
                                Extra Bed Price - <?php echo $extra_bed_price; ?>
                            </p>
                            <p id="total_price">
                                Total Price - <?php echo $price_per_day; ?>
                            </p>
                        </div>
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
                        <div class="form-group ml-4" style="user-select:none;">
                            <input type="checkbox" class="form-check-input" id="is_extra_bed">
                            <label for="is_extra_bed">Is extra bed</label>
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
    <?php } else { ?>
        <h1 class='text-center text-danger'>
            <b>
                <?php echo $error_message; ?>
            </b>
        </h1>
    <?php } ?>
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
        let checkbox = $("#is_extra_bed");
        checkbox.change(function() {
            if (checkbox.is(':checked')) {
                $("#extra_bed_price").show();
            } else {
                $("#extra_bed_price").hide();
            }
        })
    })
</script>
</body>

</html>