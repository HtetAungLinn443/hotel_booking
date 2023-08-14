<?php

require "requires/common.php";
require "requires/connect.php";
require "requires/include_function.php";
require "requires/setting.php";
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
// if ($row_res <= 0) {
//     $url = $base_url . "index.php?msg=error";
//     header("Refresh: 0; url=$url");
//     exit();
// }
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
    $sql = "SELECT image FROM `room_gallery` WHERE room_id = '$id' ORDER BY id ASC";
    $img_res = $mysqli->query($sql);
    $img_row = $img_res->num_rows;
}


require 'templates/template_header.php';

?>
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-12 ftco-animate">
                        <div class="single-slider owl-carousel">
                            <?php
                            if ($img_row >= 0) {
                                while ($row = $img_res->fetch_assoc()) {
                                    $img_path = $base_url . 'assets/upload/' . $id . '/' . $row['image'];
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
                    <div class="col-md-12 room-single mt-4 mb-5 ftco-animate">
                        <h2 class="mb-4"><?php echo $room_name ?> <span>- (<?php echo $room_occupation ?>
                                <?php echo (isset($setting['occupancy'])) ? $setting['occupancy'] : ""; ?>)</span>
                        </h2>
                        <p>
                            <?php echo $room_details ?>
                        </p>
                        <div class="d-md-flex mt-5 mb-5">
                            <ul class="list">
                                <li><span>Max:</span> <?php echo $room_occupation ?>
                                    <?php echo (isset($setting['occupancy'])) ? $setting['occupancy'] : ""; ?></li>
                                <li><span>Size:</span> <?php echo $room_size ?>
                                    <?php echo (isset($setting['size_unit'])) ? $setting['size_unit'] : ""; ?></li>
                                <li><span>Price Per Day:</span> <?php echo $room_price ?>
                                    <?php echo (isset($setting['price_unit'])) ? $setting['price_unit'] : ""; ?></li>
                            </ul>
                            <ul class="list ml-md-5">
                                <li><span>View:</span> <?php echo $room_view ?></li>
                                <li><span>Bed:</span> <?php echo $room_bed ?></li>
                                <li><span>Extra Bed Price Per Day:</span> <?php echo $extra_bed_price ?>
                                    <?php echo (isset($setting['price_unit'])) ? $setting['price_unit'] : ""; ?></li>
                            </ul>
                        </div>
                        <p>
                            <?php echo $description ?>
                        </p>
                    </div>
                </div>
            </div> <!-- .col-md-8 -->
            <div class="col-lg-4 sidebar ftco-animate pl-md-5">

                <div class="sidebar-box ftco-animate">
                    <div class="categories">
                        <h3>Categories</h3>
                        <li><a href="#">Properties <span>(12)</span></a></li>
                        <li><a href="#">Home <span>(22)</span></a></li>
                        <li><a href="#">House <span>(37)</span></a></li>
                        <li><a href="#">Villa <span>(42)</span></a></li>
                        <li><a href="#">Apartment <span>(14)</span></a></li>
                        <li><a href="#">Condominium <span>(140)</span></a></li>
                    </div>
                </div>

                <div class="sidebar-box ftco-animate">
                    <h3>Recent Blog</h3>
                    <div class="block-21 mb-4 d-flex">
                        <a class="blog-img mr-4" style="background-image: url(images/image_1.jpg);"></a>
                        <div class="text">
                            <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the
                                    blind texts</a></h3>
                            <div class="meta">
                                <div><a href="#"><span class="icon-calendar"></span> Oct 30, 2019</a></div>
                                <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                                <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="block-21 mb-4 d-flex">
                        <a class="blog-img mr-4" style="background-image: url(images/image_2.jpg);"></a>
                        <div class="text">
                            <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the
                                    blind texts</a></h3>
                            <div class="meta">
                                <div><a href="#"><span class="icon-calendar"></span> Oct 30, 2019</a></div>
                                <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                                <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="block-21 mb-4 d-flex">
                        <a class="blog-img mr-4" style="background-image: url(images/image_3.jpg);"></a>
                        <div class="text">
                            <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the
                                    blind texts</a></h3>
                            <div class="meta">
                                <div><a href="#"><span class="icon-calendar"></span> Oct 30, 2019</a></div>
                                <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                                <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require 'templates/template_footer.php'; ?>
</body>

</html>