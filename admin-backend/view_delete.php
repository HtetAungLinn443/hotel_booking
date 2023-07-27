<?php
session_start();
require "../requires/common.php";
require "../requires/connect.php";
require "../requires/check_authencation.php";
require "../requires/include_function.php";
$table = "view";
$id = $_GET['id'];
$result = deleteList($id, $table, $mysqli);
echo $result;
exit();
if ($result) {
}