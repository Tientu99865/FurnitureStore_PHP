<?php
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');
$msg= '';
$suc= '';

$uid = validate_id($_GET['uid']);

if ($_SERVER['REQUEST_METHOD'] = 'POST') {
    if (isset($_POST['delete']) && ($_POST['delete'] == 'Xóa')) {
        $q = "DELETE FROM users WHERE user_id = $uid ";
        $r = mysqli_query($dbc, $q);
        confirm_query($r, $q);

        if (mysqli_affected_rows($dbc) == 1) {
            $msg = "Xóa tài khoản thành công";
            $suc = 1;
        } else {
            $msg = "Không tồn tại tài khoản này!";
            $suc = 0;
        }
    } elseif (isset($_POST['delete']) && ($_POST['delete'] == 'Hủy')){
        $msg = "Bạn đã hủy xóa tài khoản.";
        $suc = 0;
    }
    header('Location: ../view_users.php?msg=' . $msg.'&&'.'suc='.$suc);
}

?>