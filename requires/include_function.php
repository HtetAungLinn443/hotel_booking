<?php
function insertQuery($insert_data, $table, $mysqli)
{
    $column_name = implode(", ", array_keys($insert_data));
    $cloumn_value = implode(", ", $insert_data);

    $sql = "INSERT INTO `$table` ($column_name) VALUES ($cloumn_value)";
    $result = $mysqli->query($sql);
    return $result;
}
function updateQuery($update_data, $id, $table, $mysqli)
{
    $sql = "";
    $sql .= "UPDATE `$table` SET ";
    $count = 0;
    foreach ($update_data as $key => $value) {
        $count++;
        if ($count == 1) {
            $sql .= $key . "=" . $value;
        } else {
            $sql .= ", " . $key . "=" . $value;
        }
    }
    $sql .= " WHERE id = '$id' ";

    $resule = $mysqli->query($sql);
    return $resule;
}
function checkUniqueValue($check_colume, $table, $mysqli)
{

    $sql = "";
    $sql .= "SELECT count(id) as total FROM ";
    $sql .= "`$table`";
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
function checkUniqueValueUpdate($id, $check_colume, $table, $mysqli)
{
    $sql = "";
    $sql .= "SELECT count(id) as total FROM ";
    $sql .= "`$table`";
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
    $sql .= " AND id != '$id' ";
    $sql .= " AND deleted_at IS NULL";
    $result = $mysqli->query($sql);
    while ($row = $result->fetch_assoc()) {
        $total = $row['total'];
    }
    return $total;
}
function listQuery($select_column, $table, $mysqli, $order = null)
{
    $cloumn_value = implode(", ", $select_column);
    $sql = "";
    $sql .= "SELECT " . $cloumn_value . " FROM " . "`$table`" . " WHERE deleted_at IS NULL ";
    if ($order != null) {
        $sql .= " ORDER BY ";
        $count = 0;
        foreach ($order as $key => $value) {
            $count++;
            if ($count == 1) {
                $sql .= $key . " " . $value;
            } else {
                $sql .= ", " . $key . " " . $value;
            }
        }
    }
    $result_all = $mysqli->query($sql);
    return $result_all;
}

function selectQueryById($id, $select_column, $table, $mysqli)
{
    $cloumn_value = implode(", ", $select_column);
    $sql = "";
    $sql .= "SELECT " . $cloumn_value . " FROM " . "`$table`" . " WHERE id='$id' AND deleted_at IS NULL ";
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
    $sql = "UPDATE `$table` SET deleted_at='$date', deleted_by='$user_id' WHERE id='$id'";
    $result = $mysqli->query($sql);
    return $result;
}
