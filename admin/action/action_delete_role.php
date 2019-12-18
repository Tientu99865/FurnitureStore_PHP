<?php
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');
$msg= '';
$suc= '';

$rid = validate_id($_GET['rid']);

if ($_SERVER['REQUEST_METHOD'] = 'POST') {
    if (isset($_POST['delete']) && ($_POST['delete'] == 'Xóa')) {
        $q = "DELETE FROM roles WHERE role_id = $rid ";
        $r = mysqli_query($dbc, $q);
        confirm_query($r, $q);

        if (mysqli_affected_rows($dbc) == 1) {
            $msg = "Xóa chức vụ thành công";
            $suc = 1;
        } else {
            $msg = "Không tồn tại chức vụ này!";
            $suc = 0;
        }
    } elseif (isset($_POST['delete']) && ($_POST['delete'] == 'Hủy')){
        $msg = "Bạn đã hủy xóa chức vụ.";
        $suc = 0;
    }
    header('Location: ../view_roles.php?msg=' . $msg.'&&'.'suc='.$suc);
}

?>