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
                <div id="map" class="bg-white"></div>
            </div>
        </div>
    </div>
</section>


<?php require 'templates/template_footer.php'; ?>
<script>
$(document).ready(function() {
    $("#checkIn").datepicker({

    });

    $("#checkOut").datepicker({

    });
})
</script>
</body>

</html>