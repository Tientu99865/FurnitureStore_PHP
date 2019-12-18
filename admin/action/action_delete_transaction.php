<?php
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');
$msg= '';
$suc= '';

$code = validate_id($_GET['code']);

if ($_SERVER['REQUEST_METHOD'] = 'POST') {
    if (isset($_POST['delete']) && ($_POST['delete'] == 'Xóa')) {
        $q = "DELETE FROM transactions WHERE transaction_code = $code ";
        $r = mysqli_query($dbc, $q);
        confirm_query($r, $q);

        if (mysqli_affected_rows($dbc) == 1) {
            $msg = "Xóa giao dịch thành công";
            $suc = 1;
        } else {
            $msg = "Không tồn tại giao dịch này!";
            $suc = 0;
        }
    } elseif (isset($_POST['delete']) && ($_POST['delete'] == 'Hủy')){
        $msg = "Bạn đã hủy xóa giao dịch.";
        $suc = 0;
    }
    header('Location: ../view_transactions.php?msg=' . $msg.'&&'.'suc='.$suc);
}

?>