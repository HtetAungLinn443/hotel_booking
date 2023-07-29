<?php
session_start();
require "../requires/common.php";
require "../requires/connect.php";
require "../requires/check_authencation.php";
require "../requires/include_function.php";
$table = "bed_type";
if (!isset($_GET['id'])) {
    $url = $cp_base_url . "bed_list.php?msg=error";
    header("Refresh: 0; url=$url");
    exit();
}
$today_date = date('Y-m-d H:i:s');
$user_id = (isset($_SESSION['id'])) ? $_SESSION['id'] : $_COOKIE['id'];
$id = $_GET['id'];
$id = $mysqli->real_escape_string($id);
$update_data = [
    'deleted_at' => "'$today_date'",
    'deleted_by' => "'$user_id'",
];
$update = updateQuery($update_data, $id, $table, $mysqli);

if ($update) {
    $url = $cp_base_url . "bed_list.php?msg=delete";
    header("Refresh: 0; url=$url");
    exit();
}
