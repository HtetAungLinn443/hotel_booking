<?php
require "../requires/common.php";
require "../requires/connect.php";

$title = "Hotel Booking::Admin Login";

$user_name = "";
if (isset($_POST['form-sub']) && $_POST['form-sub'] == '1') {

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title; ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo $base_url ?>assets/backend/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo $base_url ?>assets/backend/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Animate.css -->
    <link href="<?php echo $base_url ?>assets/backend/css/animate/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo $base_url ?>assets/backend/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form>
                        <h1>Login Form</h1>
                        <div>
                            <input type="text" class="form-control" name="username" placeholder="Username"
                                required="" />
                        </div>
                        <div>
                            <input type="password" class="form-control" name="password" placeholder="Password"
                                required="" />

                        </div>
                        <div style="text-align: start;">
                            <label for="remember">
                                <input type="checkbox" name="remember" id="remember"> Remember Me.
                            </label>
                        </div>
                        <div>
                            <button class="btn btn-secondary w-100 submit" type="submit">Log in</button>
                            <input type="hidden" name="form-sub" value="1">
                        </div>

                        <div class="separator">
                            <div>
                                <h1><i class="fa fa-paw"></i> <?php echo $common_config['name']; ?>!</h1>
                                <p>©2023 All Rights Reserved. <?php echo $common_config['name']; ?>! is a Bootstrap 4
                                    template. Privacy and
                                    Terms</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>

</html>