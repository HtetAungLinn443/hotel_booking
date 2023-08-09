<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col menu_fixed">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"><i class="fa fa-hotel"></i>
                            <span>Hotel Booking</span>
                        </a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="images/img.jpg" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>
                                <?php
                                if (isset($_SESSION['username'])) {
                                    echo $_SESSION['username'];
                                } else {
                                    echo $_COOKIE['username'];
                                }
                                ?>
                            </h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li>
                                    <a href="<?php echo $cp_base_url; ?>index.php">
                                        <i class="fa fa-home"></i> Home
                                    </a>
                                </li>

                                <li>
                                    <a><i class="fa fa-binoculars"></i> Room View <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo $cp_base_url; ?>view_create.php">Create</a></li>
                                        <li><a href="<?php echo $cp_base_url; ?>view_list.php">Listing</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a><i class="fa fa-bed"></i> Room Bed <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo $cp_base_url; ?>bed_create.php">Create</a></li>
                                        <li><a href="<?php echo $cp_base_url; ?>bed_list.php">Listing</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a><i class="fa fa-list"></i> Room Amenities<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo $cp_base_url; ?>amenity_create.php">Create</a></li>
                                        <li><a href="<?php echo $cp_base_url; ?>amenity_list.php">Listing</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a><i class="fa-solid fa-hotel"></i> Room Special Feature<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo $cp_base_url; ?>feature_create.php">Create</a></li>
                                        <li><a href="<?php echo $cp_base_url; ?>feature_list.php">Listing</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a><i class="fa-solid fa-hotel"></i> Room<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo $cp_base_url; ?>room_create.php">Create</a></li>
                                        <li><a href="<?php echo $cp_base_url; ?>room_list.php">Listing</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a><i class="fa-solid fa-circle-plus"></i> Reservation<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo $cp_base_url; ?>reservation_create.php">Create</a></li>
                                        <li><a href="<?php echo $cp_base_url; ?>reservation_list.php">Listing</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="<?php echo $cp_base_url; ?>hotel_setting_create.php">
                                        <i class="fa fa-gear"></i> Site Setting
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->
                </div>
            </div>