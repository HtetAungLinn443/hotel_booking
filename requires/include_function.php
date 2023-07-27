<?php
function insertQuery($insert_data, $table, $mysqli)
{
    $column_name = implode(", ", array_keys($insert_data));
    $cloumn_value = implode(", ", $insert_data);

    $sql = "INSERT INTO `$table` ($column_name) VALUES ($cloumn_value)";
    $result = $mysqli->query($sql);
    return $result;
}

function checkUniqueValue($check_colume, $table, $mysqli)
{
    $sql = "";
    $sql .= "SELECT count(id) as total FROM ";
    $sql .= $table;
    $sql .= " WHERE ";
    $count = 0;
    foreach ($check_colume as $key => $value) {
        $count++;
        if ($count == 1) {
            $sql .= $key . '=' . "'" . $value . "'";
        } else {
            $sql .= " AND " . $key . '=' . "'" . $value . "'";
        }
    }
    $sql .= " AND deleted_at IS NULL";
    $result = $mysqli->query($sql);
    while ($row = $result->fetch_assoc()) {
        $total = $row['total'];
    }
    return $total;
}

function listQuery($select_column, $table, $mysqli)
{
    $cloumn_value = implode(", ", $select_column);

    $sql = "SELECT " . $cloumn_value . " FROM " . "`$table`" . " WHERE deleted_at IS NULL";
    $result_all = $mysqli->query($sql);
    return $result_all;
}

function deleteList($id, $table, $mysqli)
{
    $user_id = '';
    $date = date('Y-m-d H:i:s');
    if (isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];
    } else {
        $user_id = $_COOKIE['id'];
    }
    $sql = "UPDATE `$table` SET deleted_at='$date', deleted_by='$user_id' WHERE id='100'";
    $result = $mysqli->query($sql);
    return $result;
}