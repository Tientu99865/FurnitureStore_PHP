<?php
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');
$rid = validate_id($_GET['rid']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = array();
    if (empty($_POST['role'])) {
        $errors[] = 'Bạn hãy điền tên chức vụ';
    } else {
        $role = mysqli_real_escape_string($dbc, strip_tags($_POST['role']));
    }
    if (empty($_POST['permission'])) {
        $errors[] = 'Bạn hãy điền phần quyền cho chức vụ';
    } else {
        $permission = mysqli_real_escape_string($dbc, strip_tags($_POST['permission']));
    }

    if (empty($errors)){
        $q = "UPDATE roles SET role = '{$role}' ,permission = '{$permission}' WHERE role_id = '{$rid}' ";
        $r = mysqli_query($dbc,$q);
        confirm_query($r,$q);
        if (mysqli_affected_rows($dbc) == 1){
            $msg = "Sửa chức vụ thành công";
            $suc = 1;
        }else{
            $msg = "Lỗi!chức vụ không thay đổi";
            $suc = 0;
        }
    } else {
        foreach ($errors as $error){
            $msg .= $error . "<br/>";
        }
    }
    header('Location: ../edit_role.php?rid='.$rid.'&&'.'msg=' . $msg.'&&'.'suc='.$suc);
}
?>