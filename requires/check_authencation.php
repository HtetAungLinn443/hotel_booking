<?php
$authentication = false;
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['email'])) {
    $check_sql = "SELECT count(id) AS total FROM `user` WHERE id = '" . $_SESSION['id'] . "'";
    $check_res = $mysqli->query($check_sql);

    while ($row = $check_res->fetch_assoc()) {
        $user_total = $row['total'];
        if ($user_total >= 1) {
            $authentication = true;
        }
    }
}

if (isset($_COOKIE['id']) && isset($_COOKIE['username']) && isset($_COOKIE['email'])) {
    $check_sql = "SELECT count(id) AS total FROM `user` WHERE id = '" . $_COOKIE['id'] . "' ";
    $check_res = $mysqli->query($check_sql);
    while ($row = $check_res->fetch_assoc()) {

        $user_total = $row['total'];
        if ($user_total >= 1) {
            $authentication = true;
        }
    }
}

if ($authentication == false) {
    $url = $cp_base_url . "logout.php";
    header("Refresh: 0; url=$url");
    exit();
}
