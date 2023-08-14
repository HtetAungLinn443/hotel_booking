<?php
session_start();
require "../requires/common.php";
require "../requires/connect.php";
require "../requires/check_authencation.php";
require "../requires/include_function.php";

$table = "room";
if (!isset($_GET['id'])) {
    $url = $cp_base_url . "room_list.php?msg=error";
    header("Refresh: 0; url=$url");
    exit();
}
$id = (int)($_GET['id']);
$id = $mysqli->real_escape_string($id);
$select_column = ['id'];
$result = selectQueryById($id, $select_column, $table, $mysqli);
$row_res = $result->num_rows;
if ($row_res <= 0) {
    $url = $cp_base_url . "room_list.php?msg=error";
    header("Refresh: 0; url=$url");
    exit();
}
$row = $result->fetch_assoc();
$room_id = $row['id'];
$today_date = date('Y-m-d H:i:s');
$user_id = (isset($_SESSION['id'])) ? $_SESSION['id'] : $_COOKIE['id'];

// amenity update for soft delete
$amenity_table = 'room_amenity';
$select_column = ['id'];
$amenity_lists = listQuery($select_column, $amenity_table, $mysqli);
while ($row = $amenity_lists->fetch_assoc()) {
    $id = $row['id'];
    $sql = "UPDATE `$amenity_table` SET deleted_at = '$today_date', deleted_by = '$user_id' WHERE room_id = '$room_id' AND id = '$id'";
    $mysqli->query($sql);
}

// special feature update for soft delete
$feature_table = 'room_special_feature';
$select_column = ['id'];
$feature_lists = listQuery($select_column, $feature_table, $mysqli);
while ($row = $feature_lists->fetch_assoc()) {
    $id = $row['id'];
    $sql = "UPDATE `$feature_table` SET deleted_at = '$today_date', deleted_by = '$user_id' WHERE id = '$id' AND room_id = '$room_id'";
    $mysqli->query($sql);
}

// room gallery update for soft delete
$gallery_table = 'room_gallery';
$select_column = ['id'];
$gallery_lists = listQuery($select_column, $gallery_table, $mysqli);
while ($row = $gallery_lists->fetch_assoc()) {
    $id = $row['id'];
    $sql = "UPDATE `$gallery_table` SET deleted_at = '$today_date', deleted_by = '$user_id' WHERE id = '$id' AND room_id = '$room_id'";
    $mysqli->query($sql);
}

// room update for soft delete

$update_data = [
    'deleted_at' => "'$today_date'",
    'deleted_by' => "'$user_id'",
];
$update = updateQuery($update_data, $id, $table, $mysqli);

if ($update) {
    $url = $cp_base_url . "room_list.php?msg=delete";
    header("Refresh: 0; url=$url");
    exit();
}