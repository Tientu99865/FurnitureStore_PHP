<?php
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');
$msg= '';
$suc= '';

$pid = validate_id($_GET['pid']);

if ($_SERVER['REQUEST_METHOD'] = 'POST') {
    if (isset($_POST['delete']) && ($_POST['delete'] == 'Xóa')) {
        $q = "DELETE FROM products WHERE product_id = $pid ";
        $r = mysqli_query($dbc, $q);
        confirm_query($r, $q);

        if (mysqli_affected_rows($dbc) == 1) {
            $msg = "Xóa sản phẩm thành công";
            $suc = 1;
        } else {
            $msg = "Không tồn tại sản phẩm này!";
            $suc = 0;
        }
    } elseif (isset($_POST['delete']) && ($_POST['delete'] == 'Hủy')){
        $msg = "Bạn đã hủy xóa sản phẩm này.";
        $suc = 0;
    }
    header('Location: ../view_products.php?msg=' . $msg.'&&'.'suc='.$suc);
}

?>