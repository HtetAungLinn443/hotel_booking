<?php
session_start();
require "../requires/common.php";
require "../requires/connect.php";

$title = "Hotel Booking Admin Login";
$user_name = "";
$remember = 0;
$error = false;
$err_msg = "";
$remember = "0";
if (isset($_POST['form-sub']) && $_POST['form-sub'] == '1') {
    $user_name = $mysqli->real_escape_string($_POST['username']);
    $password = $_POST['password'];
    $encrypt_pass = md5(md5($password) . $site_config['key']);
    $remember = (isset($_POST['remember'])) ? $_POST['remember'] : 0;
    if ($remember == 0) {
        $sql = "SELECT * FROM `user` WHERE name = '$user_name' OR email = '$user_name'";
        $result = $mysqli->query($sql);
        $num_rows = $result->num_rows;

        if ($num_rows >= 1) {
            while ($row = $result->fetch_assoc()) {
                $user_id = (int) ($row['id']);
                $db_username = htmlspecialchars($row['name']);
                $db_email = htmlspecialchars($row['email']);
                $db_password = $row['password'];

                if ($db_password == $encrypt_pass) {
                    $_SESSION['id'] = $user_id;
                    $_SESSION['username'] = $db_username;
                    $_SESSION['email'] = $db_email;
                    $url = $cp_base_url . "index.php";
                    header("Refresh: 0; url=$url");
                    exit();
                } else {
                    $error = true;
                    $err_msg = "Wrong Password!";
                }
            }
        } else {
            $error = true;
            $err_msg = "Wrong Username!";
        }
    } else {
        $sql = "SELECT * FROM `user` WHERE name = '$user_name' OR email = '$user_name'";
        $result = $mysqli->query($sql);
        $num_rows = $result->num_rows;

        if ($num_rows >= 1) {
            while ($row = $result->fetch_assoc()) {
                $user_id = (int) ($row['id']);
                $db_username = htmlspecialchars($row['name']);
                $db_email = htmlspecialchars($row['email']);
                $db_password = $row['password'];

                $cookie_name = "username";
                $cookie_value = $db_username;
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

                $cookie_name = "id";
                $cookie_value = $user_id;
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

                $cookie_name = "email";
                $cookie_value = $db_email;
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

                $url = $cp_base_url . "index.php";
                header("Refresh: 0; url=$url");
                exit();
            }
        }
    }
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

    <title>
        <?php echo $title; ?>
    </title>

    <!-- Bootstrap -->
    <link href="<?php echo $base_url ?>assets/backend/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo $base_url ?>assets/backend/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Animate.css -->
    <link href="<?php echo $base_url ?>assets/backend/css/animate/animate.min.css" rel="stylesheet">
    <!-- PNotify -->
    <link href="<?php echo $base_url ?>assets/backend/css/pnotify/pnotify.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>assets/backend/css/pnotify/pnotify.buttons.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>assets/backend/css/pnotify/pnotify.nonblock.css" rel="stylesheet">
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
                    <form action="<?php $cp_base_url ?>login.php" method="POST">
                        <h1>Login Form </h1>

                        <div>
                            <input type="text" class="form-control" value="<?php echo $user_name; ?>" name="username" placeholder="Email or Username" required="" />
                        </div>
                        <div>
                            <input type="password" class="form-control" name="password" placeholder="Password" required="" />
                        </div>
                        <div style="text-align: start;">
                            <label for="remember">
                                <input type="checkbox" name="remember" value="1" id="remember" <?php if ($remember == 1) {
                                                                                                    echo "checked";
                                                                                                } ?>> Remember Me.
                            </label>
                        </div>
                        <div>
                            <button class="btn btn-secondary w-100 submit" type="submit">Log in</button>
                            <input type="hidden" name="form-sub" value="1">

                        </div>

                        <div class="separator">
                            <div>
                                <h1><i class="fa fa-hotel"></i>
                                    <?php echo $site_config['name']; ?> !
                                </h1>
                                <p>©2023 All Rights Reserved.
                                    <?php echo $site_config['name']; ?>! is a Bootstrap 4
                                    template. Privacy and
                                    Terms
                                </p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="<?php echo $base_url ?>assets/backend/js/jquery/jquery.min.js"></script>
    <!-- PNotify -->
    <script src="<?php echo $base_url ?>assets/backend/js/pnotify/pnotify.js"></script>
    <script src="<?php echo $base_url ?>assets/backend/js/pnotify/pnotify.buttons.js"></script>
    <script src="<?php echo $base_url ?>assets/backend/js/pnotify/pnotify.nonblock.js"></script>
    <?php
    if ($error) {
        echo "<script>
          new PNotify({
                title: 'Error',
                text: '$err_msg',
                type: 'error',
                styling: 'bootstrap3'
            })
            </script>";
    }
    ?>
</body>

</html>