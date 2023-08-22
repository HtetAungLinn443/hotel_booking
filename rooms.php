<?php

require "requires/common.php";
require "requires/connect.php";
require "requires/include_function.php";
require "requires/setting.php";

$table = 'room';
$sql = "SELECT * FROM `$table` WHERE deleted_at IS NULL ORDER BY id DESC ";
$result = $mysqli->query($sql);
$result_row = $result->num_rows;
$title = 'Our Room List Page';
$current_page = 'our_room';
$header_title1 = '<h2>More than a hotel... an experience</h2>
                <h1 class="mb-3">Hotel for the whole family, all year round.</h1>';

$header_title2 = '<h2>Harbor Lights Hotel &amp; Resort</h2>
                <h1 class="mb-3">It feels like staying in your own home.</h1>';
require 'templates/template_header.php';
?>

<section class="ftco-section ftco-no-pb ftco-room">
    <div class="container-fluid px-0">
        <div class="row no-gutters justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">Harbor Lights Rooms</span>
                <h2 class="mb-4">Hotel Master's Rooms</h2>
            </div>
        </div>
        <div class="row no-gutters">
            <?php
            if ($result_row >= 1) {
                $counter = 0;
                $line = 1;
                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $thumb = $row['thumbnail_img'];
                    $thumb_full_path = $base_url . 'assets/upload/' . $id . '/thumb/' . $thumb;
                    $price = $row['price_per_day'];
                    $name = $row['name'];
                    $room_detail = $base_url . 'room/details/' . $id;
                    $counter++;
                    if ($line % 2 == 0) {

                        $class1 = "order-md-last";
                        $class2 = "right-arrow";
                    } else {
                        $class1 = "";
                        $class2 = "left-arrow";
                    }

                    if ($counter == 2) {
                        $counter = 0;
                        $line++;
                    }
            ?>
                    <div class="col-lg-6">
                        <div class="room-wrap d-md-flex ftco-animate">
                            <a href="<?php echo $room_detail; ?>" title="<?php echo $name; ?>" class="img <?php echo $class1; ?>" style="background-image: url(<?php echo $thumb_full_path; ?>);"></a>
                            <div class="half <?php echo $class2; ?> d-flex align-items-center">
                                <div class="text p-4 text-center">
                                    <p class="star mb-0"><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span></p>
                                    <p class="mb-0"><span class="price mr-1"><?php echo $price ?>
                                            (<?php echo (isset($setting['price_unit'])) ? $setting['price_unit'] : ''; ?>)</span>
                                        <span class="per">per
                                            night</span>
                                    </p>
                                    <h3 class="mb-3"><a href="<?php echo $room_detail; ?>"><?php echo $name; ?></a></h3>
                                    <p class="pt-1"><a href="<?php echo $room_detail; ?>" class="btn-custom px-3 py-2 rounded">View
                                            Details <span class="icon-long-arrow-right"></span></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</section>



<?php require 'templates/template_footer.php'; ?>
</body>

</html>