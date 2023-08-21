<footer class="ftco-footer ftco-section img"
    style="background-image: url(<?php echo $base_url?>assets/frontend/images/bg_4.jpg);">
    <div class="overlay"></div>
    <div class="container">
        <div class="row mb-5">
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2"><?php echo (isset($setting['name'])) ? $setting['name'] : ''; ?></h2>

                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                        <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4 ml-md-5">
                    <h2 class="ftco-heading-2">Useful Links</h2>
                    <ul class="list-unstyled">

                        <li><a href="<?php echo $base_url . 'rooms.php' ?>" class="py-2 d-block">Rooms</a></li>
                        <li><a href="#" class="py-2 d-block">Amenities</a></li>

                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Privacy</h2>
                    <ul class="list-unstyled">
                        <li><a href="#" class="py-2 d-block">Career</a></li>
                        <li><a href="<?php echo $base_url . 'about.php' ?>" class="py-2 d-block">About Us</a></li>
                        <li><a href="<?php echo $base_url . 'contact.php' ?>" class="py-2 d-block">Contact Us</a></li>
                        <li><a href="#" class="py-2 d-block">Services</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Have a Questions?</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li><span class="icon icon-map-marker"></span> <span
                                    class="text"><?php echo (isset($setting['address'])) ? $setting['address'] : ''; ?></span>
                            </li>
                            <li><a href="#"><span class="icon icon-phone"></span><span
                                        class="text"><?php echo (isset($setting['online_phone'])) ? $setting['online_phone'].' / <br/>' : ''; ?>
                                        <?php echo (isset($setting['outline_phone'])) ? $setting['outline_phone']  : ''; ?>
                                    </span></a></li>
                            <li><a href="#"><span class="icon icon-envelope"></span><span
                                        class="text"><?php echo (isset($setting['email'])) ? $setting['email'] : ''; ?></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;
                    <script>
                    document.write(new Date().getFullYear());
                    </script> All rights reserved | This
                    template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by
                    <?php echo (isset($setting['name'])) ? $setting['name'] : ''; ?>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>
        </div>
    </div>
</footer>



<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
            stroke="#F96D00" />
    </svg></div>


<script src="<?php echo $base_url ?>assets/frontend/js/jquery.min.js"></script>
<script src="<?php echo $base_url ?>assets/frontend/js/jquery-migrate-3.0.1.min.js"></script>
<script src="<?php echo $base_url ?>assets/frontend/js/popper.min.js"></script>
<script src="<?php echo $base_url ?>assets/frontend/js/bootstrap.min.js"></script>
<script src="<?php echo $base_url ?>assets/frontend/js/jquery.easing.1.3.js"></script>
<script src="<?php echo $base_url ?>assets/frontend/js/jquery.waypoints.min.js"></script>
<script src="<?php echo $base_url ?>assets/frontend/js/jquery.stellar.min.js"></script>
<script src="<?php echo $base_url ?>assets/frontend/js/owl.carousel.min.js"></script>
<script src="<?php echo $base_url ?>assets/frontend/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo $base_url ?>assets/frontend/js/aos.js"></script>
<script src="<?php echo $base_url ?>assets/frontend/js/jquery.animateNumber.min.js"></script>
<script src="<?php echo $base_url ?>assets/frontend/js/bootstrap-datepicker.js"></script>
<script src="<?php echo $base_url ?>assets/frontend/js/jquery.ui.js"></script>
<script src="<?php echo $base_url ?>assets/frontend/js/scrollax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false">
</script>
<script src="<?php echo $base_url ?>assets/frontend/js/google-map.js"></script>
<script src="<?php echo $base_url ?>assets/frontend/js/main.js"></script>