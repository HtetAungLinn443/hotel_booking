<?php
// insert query
function insertQuery($insert_data, $table, $mysqli)
{
    $column_name = implode(", ", array_keys($insert_data));
    $cloumn_value = implode(", ", $insert_data);

    $sql = "INSERT INTO `$table` ($column_name) VALUES ($cloumn_value)";
    $result = $mysqli->query($sql);
    return $result;
}
// update query
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
    $result = $mysqli->query($sql);
    return $result;
}

// check Unique Value
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

// Update Check Unique Value
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

// List Query
function listQuery($select_column, $table, $mysqli, $order = null, $where = null)
{
    $cloumn_value = implode(", ", $select_column);
    $sql = "";
    $sql .= "SELECT " . $cloumn_value . " FROM " . "`$table`" . " WHERE deleted_at IS NULL ";
    if ($where != null) {
        foreach ($where as $key => $value) {
            $sql .= " AND " . $key . " = " . "'$value'";
        }
    }
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

// select query by id
function selectQueryById($id, $select_column, $table, $mysqli)
{
    $cloumn_value = implode(", ", $select_column);
    $sql = "";
    $sql .= "SELECT " . $cloumn_value . " FROM " . "`$table`" . " WHERE id='$id' AND deleted_at IS NULL ";
    $result_all = $mysqli->query($sql);
    return $result_all;
}

// image extyension check
function checkImageExtension($fileName, $fileTempPath)
{
    $return = [];

    $allowFileType = ['png', 'jpg', 'jpeg', 'gif'];
    $explode = explode('.', $fileName);
    $extension = end($explode);
    if (in_array($extension, $allowFileType)) {
        if (getimagesize($fileTempPath)) {
            $return['error'] = false;
            $return['extension'] = $extension;
            return $return;
        } else {
            $return['error'] = true;
            return $return;
        }
    } else {
        $return['error'] = true;
        return $return;
    }
}

// Image crop and resize
function cropAndResizeImage($sourcePath, $destinationPath, $width, $height)
{
    $imageInfo = getimagesize($sourcePath);
    $originalWidth = $imageInfo[0];
    $originalHeight = $imageInfo[1];
    $sourceType = $imageInfo['mime'];

    $canvas = imagecreatetruecolor($width, $height);
    $sourceImage = imagecreatefromjpeg($sourcePath);
    imagecopyresampled($canvas, $sourceImage, 0, 0, 0, 0, $width, $height, $originalWidth, $originalHeight);

    imagejpeg($canvas, $destinationPath);
    imagedestroy($canvas);
    imagedestroy($sourceImage);

    return true;
}

// add wartermark photo
function addWatermarkToImage($originalImagePath, $outputImagePath)
{
    $watermarkImagePath = '../assets/images/wartermark.png';
    $originalImage = imagecreatefromstring(file_get_contents($originalImagePath));
    $watermarkImage = imagecreatefromstring(file_get_contents($watermarkImagePath));

    $originalWidth = imagesx($originalImage);
    $originalHeight = imagesy($originalImage);
    $watermarkWidth = imagesx($watermarkImage);
    $watermarkHeight = imagesy($watermarkImage);

    $margin = 1;
    $watermarkX = $originalWidth - $watermarkWidth - $margin;
    $watermarkY = $originalHeight - $watermarkHeight - $margin;

    imagecopy($originalImage, $watermarkImage, $watermarkX, $watermarkY, 0, 0, $watermarkWidth, $watermarkHeight);

    imagejpeg($originalImage, $outputImagePath);

    imagedestroy($originalImage);
    imagedestroy($watermarkImage);
}
