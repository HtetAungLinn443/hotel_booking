<?php
session_start();
require "../requires/common.php";
require "../requires/connect.php";
require "../requires/check_authencation.php";
require "../requires/include_function.php";
$table = 'room_gallery';

if (!isset($_GET['id']) && !isset($_GET['r_id'])) {
    $url = $cp_base_url . "room_list.php?msg=error";
    header("Refresh: 0; url=$url");
    exit();
}
$today_date = date('Y-m-d H:i:s');
$user_id = (isset($_SESSION['id'])) ? $_SESSION['id'] : $_COOKIE['id'];
$id = $mysqli->real_escape_string($_GET['id']);
$room_id = $mysqli->real_escape_string($_GET['r_id']);

$select_column = ['image'];
$result = selectQueryById($id, $select_column, $table, $mysqli);

while ($row = $result->fetch_assoc()) {
    $old_image_name = htmlspecialchars($row['image']);
    $old_image_path = '../assets/upload/' . $room_id . '/' . $old_image_name;
}


$update_data = [
    'deleted_at' => "'$today_date'",
    'deleted_by' => "'$user_id'",
];
$update = updateQuery($update_data, $id, $table, $mysqli);
if ($update) {
    unlink($old_image_path);
    $url = $cp_base_url . "room_gallery.php?id=" . $room_id;
    header("Refresh: 0; url=$url");
    exit();
}