<?php
session_start();
require "../requires/common.php";
require "../requires/connect.php";
require "../requires/check_authencation.php";
require "../requires/include_function.php";
$table = 'room';
$success = false;
$success_message = '';
$error = false;
$error_message = '';
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == 'success') {
        $success = true;
        $success_message = 'Created Hotel Room Special Feature Success!';
    } else if ($_GET['msg'] == 'edit') {
        $success = true;
        $success_message = 'Updated Hotel Room Special Feature Success!';
    } else if ($_GET['msg'] == 'delete') {
        $success = true;
        $success_message = 'Deleted Hotel Room Special Feature Success!';
    } else {
        $error = true;
        $error_message = 'Something Wrong.';
    }
}
$select_column = ['id', 'name'];
$order_by = ['id' => 'DESC'];
$result_all = listQuery($select_column, $table, $mysqli, $order_by);
$res_row = $result_all->num_rows;

$title = "Hotel Booking::Room Special Feature List Page";
require "../templates/cp_template_header.php";
require "../templates/cp_template_sidebar_menu.php";
require "../templates/cp_template_top_nav.php";

?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Hotel Room Special Feature List</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="row">
                        <?php
                        if ($res_row >= 1) {
                            while ($row = $result_all->fetch_assoc()) {
                                $db_id = htmlspecialchars($row['id']);
                                $db_name = htmlspecialchars($row['name']);
                        ?>
                                <div class="col-md-55">
                                    <div class="thumbnail">
                                        <div class="image view view-first">
                                            <img style="width: 100%; display: block;" src="images/media.jpg" alt="image" />
                                            <div class="mask">
                                                <p></p>
                                                <div class="tools tools-bottom">
                                                    <a href="#"><i class="fa fa-link"></i></a>
                                                    <a href="#"><i class="fa fa-pencil"></i></a>
                                                    <a href="#"><i class="fa fa-times"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="caption">
                                            <p><?php echo $db_name; ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        } else {
                            ?>
                            <h2 class="text-white bg-warning p-4 rounded w-100 text-center m-5 h2">There is No Room.</h2>
                        <?php
                        }
                        ?>
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