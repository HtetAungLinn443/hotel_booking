<?php
session_start();
require "../requires/common.php";
session_unset();
session_destroy();
setcookie("username", "", time() - 3600, "/");
setcookie("id", "", time() - 3600, "/");
setcookie("email", "", time() - 3600, "/");

$url = $cp_base_url . "login.php";
header("Refresh: 0; url=$url");
exit();
