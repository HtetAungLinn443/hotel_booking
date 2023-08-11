<?php

require "requires/common.php";
require "requires/connect.php";
require "requires/include_function.php";
require "requires/setting.php";
$title = 'test';
require 'templates/template_header.php';
?>

<section class="ftco-booking ftco-section ftco-no-pt ftco-no-pb">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-12">
                <form action="#" class="booking-form aside-stretch">
                    <div class="row">
                        <div class="col-md d-flex py-md-4">
                            <div class="form-group align-self-stretch d-flex align-items-end">
                                <div class="wrap align-self-stretch py-3 px-4">
                                    <label for="#">Check-in Date</label>
                                    <input type="text" class="form-control checkin_date" placeholder="Check-in date">
                                </div>
                            </div>
                        </div>
                        <div class="col-md d-flex py-md-4">
                            <div class="form-group align-self-stretch d-flex align-items-end">
                                <div class="wrap align-self-stretch py-3 px-4">
                                    <label for="#">Check-out Date</label>
                                    <input type="text" class="form-control checkout_date" placeholder="Check-out date">
                                </div>
                            </div>
                        </div>
                        <div class="col-md d-flex py-md-4">
                            <div class="form-group align-self-stretch d-flex align-items-end">
                                <div class="wrap align-self-stretch py-3 px-4">
                                    <label for="#">Room</label>
                                    <div class="form-field">
                                        <div class="select-wrap">
                                            <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                            <select name="" id="" class="form-control">
                                                <option value="">Suite</option>
                                                <option value="">Family Room</option>
                                                <option value="">Deluxe Room</option>
                                                <option value="">Classic Room</option>
                                                <option value="">Superior Room</option>
                                                <option value="">Luxury Room</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md d-flex py-md-4">
                            <div class="form-group align-self-stretch d-flex align-items-end">
                                <div class="wrap align-self-stretch py-3 px-4">
                                    <label for="#">Guests</label>
                                    <div class="form-field">
                                        <div class="select-wrap">
                                            <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                            <select name="" id="" class="form-control">
                                                <option value="">1 Adult</option>
                                                <option value="">2 Adult</option>
                                                <option value="">3 Adult</option>
                                                <option value="">4 Adult</option>
                                                <option value="">5 Adult</option>
                                                <option value="">6 Adult</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md d-flex">
                            <div class="form-group d-flex align-self-stretch">
                                <a href="#"
                                    class="btn btn-primary py-5 py-md-3 px-4 align-self-stretch d-block"><span>Check
                                        Availability <small>Best Price Guaranteed!</small></span></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">Welcome to Harbor Lights Hotel</span>
                <h2 class="mb-4">You'll Never Want To Leave</h2>
            </div>
        </div>
        <div class="row d-flex">
            <div class="col-md pr-md-1 d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services py-4 d-block text-center">
                    <div class="d-flex justify-content-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="flaticon-reception-bell"></span>
                        </div>
                    </div>
                    <div class="media-body">
                        <h3 class="heading mb-3">Friendly Service</h3>
                    </div>
                </div>
            </div>
            <div class="col-md px-md-1 d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services active py-4 d-block text-center">
                    <div class="d-flex justify-content-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="flaticon-serving-dish"></span>
                        </div>
                    </div>
                    <div class="media-body">
                        <h3 class="heading mb-3">Get Breakfast</h3>
                    </div>
                </div>
            </div>
            <div class="col-md px-md-1 d-flex align-sel Searchf-stretch ftco-animate">
                <div class="media block-6 services py-4 d-block text-center">
                    <div class="d-flex justify-content-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="flaticon-car"></span>
                        </div>
                    </div>
                    <div class="media-body">
                        <h3 class="heading mb-3">Transfer Services</h3>
                    </div>
                </div>
            </div>
            <div class="col-md px-md-1 d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services py-4 d-block text-center">
                    <div class="d-flex justify-content-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="flaticon-spa"></span>
                        </div>
                    </div>
                    <div class="media-body">
                        <h3 class="heading mb-3">Suits &amp; SPA</h3>
                    </div>
                </div>
            </div>
            <div class="col-md pl-md-1 d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services py-4 d-block text-center">
                    <div class="d-flex justify-content-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="ion-ios-bed"></span>
                        </div>
                    </div>
                    <div class="media-body">
                        <h3 class="heading mb-3">Cozy Rooms</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-wrap-about ftco-no-pt ftco-no-pb">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-md-7 order-md-last d-flex">
                <div class="img img-1 mr-md-2 ftco-animate"
                    style="background-image: url(assets/frontend/images/about-1.jpg);">
                </div>
                <div class="img img-2 ml-md-2 ftco-animate"
                    style="background-image: url(assets/frontend/images/about-2.jpg);">
                </div>
            </div>
            <div class="col-md-5 wrap-about pb-md-3 ftco-animate pr-md-5 pb-md-5 pt-md-4">
                <div class="heading-section mb-4 my-5 my-md-0">
                    <span class="subheading">About Harbor Lights Hotel</span>
                    <h2 class="mb-4">Harbor Lights Hotel the Most Recommended Hotel All Over the World</h2>
                </div>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                    there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the
                    Semantics, a large language ocean.</p>
                <p><a href="#" class="btn btn-secondary rounded">Reserve Your Room Now</a></p>
            </div>
        </div>
    </div>
</section>

<?php require 'rooms.php'; ?>

<section class="instagram">
    <div class="container-fluid">
        <div class="row no-gutters justify-content-center pb-5">
            <div class="col-md-7 text-center heading-section ftco-animate">
                <span class="subheading">Photos</span>
                <h2><span>Instagram</span></h2>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-sm-12 col-md ftco-animate">
                <a href="images/insta-1.jpg" class="insta-img image-popup"
                    style="background-image: url(assets/frontend/images/insta-1.jpg);">
                    <div class="icon d-flex justify-content-center">
                        <span class="icon-instagram align-self-center"></span>
                    </div>
                </a>
            </div>
            <div class="col-sm-12 col-md ftco-animate">
                <a href="images/insta-2.jpg" class="insta-img image-popup"
                    style="background-image: url(assets/frontend/images/insta-2.jpg);">
                    <div class="icon d-flex justify-content-center">
                        <span class="icon-instagram align-self-center"></span>
                    </div>
                </a>
            </div>
            <div class="col-sm-12 col-md ftco-animate">
                <a href="images/insta-3.jpg" class="insta-img image-popup"
                    style="background-image: url(assets/frontend/images/insta-3.jpg);">
                    <div class="icon d-flex justify-content-center">
                        <span class="icon-instagram align-self-center"></span>
                    </div>
                </a>
            </div>
            <div class="col-sm-12 col-md ftco-animate">
                <a href="images/insta-4.jpg" class="insta-img image-popup"
                    style="background-image: url(assets/frontend/images/insta-4.jpg);">
                    <div class="icon d-flex justify-content-center">
                        <span class="icon-instagram align-self-center"></span>
                    </div>
                </a>
            </div>
            <div class="col-sm-12 col-md ftco-animate">
                <a href="images/insta-5.jpg" class="insta-img image-popup"
                    style="background-image: url(assets/frontend/images/insta-5.jpg);">
                    <div class="icon d-flex justify-content-center">
                        <span class="icon-instagram align-self-center"></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<?php require 'templates/template_footer.php'; ?>
</body>

</html>