<?php
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');
$uid = validate_id($_GET['uid']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = array();
    if (empty($_POST['name'])) {
        $errors[] = 'Bạn hãy điền họ và tên của bạn';
    } else {
        $name = mysqli_real_escape_string($dbc, strip_tags($_POST['name']));
    }
    if (isset($_POST['role_id']) && filter_var($_POST['role_id'], FILTER_VALIDATE_INT, array('min_array' => 1))) {
        $role_id = $_POST['role_id'];
    }
    if (empty($_POST['account'])) {
        $errors[] = 'Bạn hãy điền tài khoản đăng nhập của bạn';
    } else {
        $account = mysqli_real_escape_string($dbc, strip_tags($_POST['account']));
    }

    if (empty($errors)){
        $q = "UPDATE users SET user_name = '{$name}' ,user_account = '{$account}' , role_id = '$role_id' WHERE user_id = '{$uid}' ";
        $r = mysqli_query($dbc,$q);
        confirm_query($r,$q);
        if (mysqli_affected_rows($dbc) == 1){
            $msg = "Sửa tài khoản thành công";
            $suc = 1;
        }else{
            $msg = "Lỗi!Tài khoản không thay đổi";
            $suc = 0;
        }
    } else {
        foreach ($errors as $error){
            $msg .= $error . "<br/>";
        }
    }
    header('Location: ../edit_user.php?uid='.$uid.'&&'.'msg=' . $msg.'&&'.'suc='.$suc);
}
?>