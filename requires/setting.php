<?php
$setting = [];
$sql = "SELECT * FROM `hotel_setting`";
$result = $mysqli->query($sql);
$row_res = $result->num_rows;
if ($row_res > 0) {
    $setting = $result->fetch_assoc();

}