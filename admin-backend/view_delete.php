<?php
session_start();
require "../requires/common.php";
require "../requires/connect.php";
require "../requires/check_authencation.php";
require "../requires/include_function.php";
$table = "view";
$id = $_GET['id'];
$result = deleteList($id, $table, $mysqli);

if ($result >= 1) {
    $url = $cp_base_url . "view_list.php?msg=delete";
    header("Refresh: 0; url=$url");
    exit();
}
