<?php
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');
$msg= '';
$suc= '';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors = array();

    if (empty($_POST['role'])){
        $errors[] = 'Bạn hãy điền tên chức vụ';
    }else {
        $role = mysqli_real_escape_string($dbc,strip_tags($_POST['role']));
    }

    //check permission(permission co the co hoac ko)
    $permission = mysqli_real_escape_string($dbc,$_POST['permission']);


    if (empty($errors)){
        $q = "SELECT role FROM roles WHERE role = '{$role}'";
        $r = mysqli_query($dbc,$q);

        if (mysqli_num_rows($r) >= 1){
            $msg = "Chức vụ này đã tồn tại!";
            $suc = 0;
        }else{
            //Neu ko co loi nao xay ra thi bat dau insert du lieu
            $q = "INSERT INTO roles (role,permission) VALUE ('{$role}','{$permission}')";
            $r = mysqli_query($dbc,$q);
            confirm_query($r,$q);
            if (mysqli_affected_rows($dbc) == 1){
                $msg = "Thêm chức vụ thành công";
                $suc = 1;
            }else{
                $msg = "Lỗi hệ thống";
                $suc = 1;
            }
        }

    } else {
        foreach ($errors as $error){
            $msg .= $error . "<br/>";
        }
    }

    header('Location: ../add_role.php?msg=' . $msg.'&&'.'suc='.$suc);
}
?>