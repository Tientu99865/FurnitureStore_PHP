<?php
include "check_login.php";
include ('../includes/mysqli_connect.php');
include ('../includes/functions.php');
include "admin_header.php";
include "admin_navbar.php";
include "admin_partial.php";
include "admin_sidebar.php"
?>
<?php
$code = validate_id($_GET['code']);
//lay du lieu cua danh muc da chon

$q = "SELECT customer_name FROM transactions WHERE transaction_code ={$code}";
$r = mysqli_query($dbc, $q);
confirm_query($r, $q);

if (mysqli_num_rows($r) == 1) {
    $transaction = mysqli_fetch_array($r,MYSQLI_ASSOC);
} else {
    $msg = "Lỗi!Danh mục không tồn tại";
    $suc = 0;
}
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row grid-margin">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style="text-align: center;font-size: 30px;">Xóa giao dịch của : <?php if (isset($transaction['customer_name'])) echo $transaction['customer_name'];?></h4>
                        <!-- Dummy Modal Starts -->
                        <form action="action/action_delete_transaction.php?code=<?php echo $code;?>" method="post">
                            <div class="modal demo-modal">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Thông báo</h5>
                                        </div>
                                        <div class="modal-body">
                                            <p>Bạn có muốn xóa giao dịch của <b><?php if (isset($transaction['customer_name'])) echo $transaction['customer_name'];?></b> không?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-danger" name="delete" value="Xóa">
                                            <input type="submit" class="btn btn-light" name="delete" value="Hủy">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- Dummy Modal Ends -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
<?php include "admin_end.php" ?>;
