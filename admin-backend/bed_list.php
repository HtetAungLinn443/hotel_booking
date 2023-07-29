<?php
session_start();
require "../requires/common.php";
require "../requires/connect.php";
require "../requires/check_authencation.php";
require "../requires/include_function.php";
$table = 'bed_type';
$success = false;
$success_message = '';
$error = false;
$error_message = '';
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == 'success') {
        $success = true;
        $success_message = 'Created Hotel Room Bed Type Success!';
    } else if ($_GET['msg'] == 'edit') {
        $success = true;
        $success_message = 'Updated Hotel Room Bed Type Success!';
    } else if ($_GET['msg'] == 'delete') {
        $success = true;
        $success_message = 'Deleted Hotel Room Bed Type Success!';
    } else {
        $error = true;
        $error_message = 'Something Wrong.';
    }
}
$select_column = ['id', 'name'];
$order_by = ['id' => 'DESC'];
$result_all = listQuery($select_column, $table, $mysqli, $order_by);
$res_row = $result_all->num_rows;

$title = "Hotel Booking::Room Bed List Page";
require "../templates/cp_template_header.php";
require "../templates/cp_template_sidebar_menu.php";
require "../templates/cp_template_top_nav.php";

?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Hotel Room Bed List</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <a href="<?php echo $cp_base_url ?>bed_create.php" class="btn btn-info ">Create Bed Type</a>
                    <div class="x_content">
                        <br />

                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="col-4">ID</th>
                                    <th class="col-5">Name</th>
                                    <th class="col-3 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($res_row >= 1) {
                                    while ($row = $result_all->fetch_assoc()) {
                                        $db_id = htmlspecialchars($row['id']);
                                        $db_name = htmlspecialchars($row['name']);
                                ?>
                                        <tr>

                                            <td>
                                                <?php echo $db_id; ?>
                                            </td>
                                            <td>
                                                <?php echo $db_name; ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <a href="<?php echo $cp_base_url . "bed_edit.php?id=" . $db_id ?>" class="btn btn-sm btn-info">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                                <a href="<?php echo $cp_base_url . "bed_delete.php?id=" . $db_id ?>" class="btn btn-sm btn-danger">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
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

if ($error) {
    echo "<script>
          new PNotify({
                title: 'Error!',
                text: '$error_message',
                type: 'error',
                styling: 'bootstrap3'
            })
            </script>";
}

if ($success) {
    echo "<script>
          new PNotify({
                title: 'Success!',
                text: '$success_message',
                type: 'success',
                styling: 'bootstrap3'
            })
            </script>";
}
?>

</html>