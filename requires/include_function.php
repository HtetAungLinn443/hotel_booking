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
