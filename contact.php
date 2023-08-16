<?php

require "requires/common.php";
require "requires/connect.php";
require "requires/include_function.php";
require "requires/setting.php";
$title = "Contact Page";
$header_title1 = '<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home</a></span> <span>Contact Us</span></p>
	            <h1 class="mb-4 bread">Contact Us</h1>';

$header_title2 = '<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home</a></span> <span>Contact Us</span></p>
	            <h1 class="mb-4 bread">Contact Us</h1>';

require 'templates/template_header.php';

?>

<section class="ftco-section contact-section bg-light">
    <div class="container">
        <div class="row d-flex mb-5 contact-info">
            <div class="col-md-12 mb-4">
                <h2 class="h3">Contact Information</h2>
            </div>
            <div class="w-100"></div>
            <div class="col-md-3 d-flex">
                <div class="info rounded bg-white p-4">
                    <p><span>Address:</span> <?php echo (isset($setting['address'])) ? $setting['address'] : ""; ?></p>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="info rounded bg-white p-4">
                    <p><span>Phone:</span> <a href="tel://1234567920"><?php echo (isset($setting['online_phone'])) ? $setting['online_phone'] : ""; ?></a>
                    </p>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="info rounded bg-white p-4">
                    <p><span>Email:</span> <a href="mailto:info@yoursite.com"><?php echo (isset($setting['email'])) ? $setting['email'] : ""; ?></a>
                    </p>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="info rounded bg-white p-4">
                    <p><span>Website</span> <a href="<?php echo $base_url; ?>"><?php echo $base_url; ?></a></p>
                </div>
            </div>
        </div>
        <div class="row block-9">
            <div class="col-md-6 order-md-last d-flex">
                <form action="#" class="bg-white p-5 contact-form">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your Email">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Subject">
                    </div>
                    <div class="form-group">
                        <textarea name="" id="" cols="30" rows="7" class="form-control"
                            placeholder="Message"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
                    </div>
                </form>
            </div>

            <div class="col-md-6 d-flex">
                <div id="map" class="bg-white"></div>
            </div>
        </div>
    </div>
</section>


<?php require 'templates/template_footer.php'; ?>
</body>

</html>