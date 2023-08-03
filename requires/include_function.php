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
function cropAndResizeImage($sourceFile, $destinationFile, $cropX, $cropY, $cropWidth, $cropHeight, $resizeWidth, $resizeHeight)
{
    $imageInfo = getimagesize($sourceFile);
    $sourceWidth = $imageInfo[0];
    $sourceHeight = $imageInfo[1];
    $sourceType = $imageInfo['mime'];

    // $sourceWidth =
    // Get the image information

    // Create a new image resource based on the source image type
    switch ($sourceType) {
        case 'image/jpeg':

            $sourceImage = imagecreatefromjpeg($sourceFile);
            break;
        case 'image/png':
            $sourceImage = imagecreatefrompng($sourceFile);
            break;
        case 'image/gif':
            $sourceImage = imagecreatefromgif($sourceFile);
            break;
        default:
            // Unsupported image type
            return false;
    }

    // Create a new image resource for the cropped and resized image
    $newImage = imagecreatetruecolor($resizeWidth, $resizeHeight);

    // Crop the image
    imagecopyresampled($newImage, $sourceImage, 0, 0, $cropX, $cropY, $resizeWidth, $resizeHeight, $cropWidth, $cropHeight);

    // Save the cropped and resized image to the destination file
    switch ($sourceType) {
        case 'image/jpeg':
            imagejpeg($newImage, $destinationFile, 90); // Adjust the quality (0-100) as needed
            break;
        case 'image/png':
            imagepng($newImage, $destinationFile);
            break;
        case 'image/gif':
            imagegif($newImage, $destinationFile);
            break;
        default:
            // Unsupported image type
            return false;
    }

    // Free up memory by destroying the image resources
    imagedestroy($sourceImage);
    imagedestroy($newImage);

    return true;
}
