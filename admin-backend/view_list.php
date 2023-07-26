<?php
session_start();
require "../requires/common.php";
require "../requires/connect.php";
require "../requires/check_authencation.php";
require "../requires/include_function.php";
$table = 'view';
$select_column = ['id', 'name'];
$result_all = listQuery($select_column, $table, $mysqli);
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
                <h3>Hotel Room View List</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <a href="<?php echo $cp_base_url ?>view_create.php" class="btn btn-info ">Create View</a>
                    <div class="x_content">
                        <br />

                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                            cellspacing="0" width="100%">
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
                                        <a href="<?php echo $cp_base_url . "edit.php?id=" . $db_id ?>"
                                            class="btn btn-sm btn-info">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <a href="<?php echo $cp_base_url . "delete.php?id=" . $db_id ?>"
                                            class="btn btn-sm btn-danger">
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
if (isset($_GET['success'])) {
    $error_msg = $_GET['success'] . " Room View Name Create Successfully!";

    echo "<script>
          new PNotify({
                title: 'Create Success!',
                text: '$error_msg',
                type: 'success',
                styling: 'bootstrap3'
            })
            </script>";
}
?>

</html>