<?php
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');
$msg= '';
$suc= '';

$cid = validate_id($_GET['cid']);

if ($_SERVER['REQUEST_METHOD'] = 'POST') {
    if (isset($_POST['delete']) && ($_POST['delete'] == 'Xóa')) {
        $q = "DELETE FROM categories WHERE cat_id = $cid ";
        $r = mysqli_query($dbc, $q);
        confirm_query($r, $q);

        if (mysqli_affected_rows($dbc) == 1) {
            $msg = "Xóa danh mục thành công";
            $suc = 1;
        } else {
            $msg = "Không tồn tại danh mục này!";
            $suc = 0;
        }
    } elseif (isset($_POST['delete']) && ($_POST['delete'] == 'Hủy')){
        $msg = "Bạn đã hủy xóa danh mục.";
        $suc = 0;
    }
    header('Location: ../view_categories.php?msg=' . $msg.'&&'.'suc='.$suc);
}

?>