<?php
session_start();
require "../requires/common.php";
require "../requires/connect.php";
require "../requires/check_authencation.php";
$sql = "SELECT * FROM `amenity`";
$result_all = $mysqli->query($sql);
$res_row = $result_all->num_rows;

$title = "Hotel Booking";
require "../templates/cp_template_header.php";
require "../templates/cp_template_sidebar_menu.php";
require "../templates/cp_template_top_nav.php";

?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Hotel Room Amenity List</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <a href="<?php echo $cp_base_url ?>amenity_create.php" class="btn btn-info ">Create Amenity</a>
                    <div class="x_content">
                        <br />
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Type
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
if ($res_row >= 1) {
    while ($row = $result_all->fetch_assoc()) {
        $db_id = htmlspecialchars($row['id']);
        $db_name = htmlspecialchars($row['name']);
        $db_type = htmlspecialchars($row['type']);
        ?>
                                <tr>
                                    <td></td>
                                    <td>
                                        <?php echo $db_id; ?>
                                    </td>
                                    <td>
                                        <?php echo $db_name; ?>
                                    </td>
                                    <td>
                                        <?php
if ($db_type == "0") {
            echo "General";
        } else if ($db_type == "1") {
            echo "Bathroom";
        } else if ($db_type == "2") {
            echo "Others";
        }
        ?>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <?php
}
}
?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- /page content -->
<?php
require "../templates/cp_template_footer.php";
?>

<?php
if (isset($_GET['success'])) {
    $error_msg = $_GET['success'];
    echo "<script>
          new PNotify({
                title: 'Create Success ',
                text: '$error_msg',
                type: 'success',
                styling: 'bootstrap3'
            })
            </script>";
}
?>

</html>