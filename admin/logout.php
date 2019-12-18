<?php
session_start();
include ('../includes/functions.php');
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}else{
    $_SESSION = array();
    //neu nguoi dung da dang nhap va co thong tin thi se logout nguoi dung
    session_destroy();//destroy session da tao
    setcookie(session_name(),'',time()-36000);//xoa cookie cua trinh duyet
}
header("Location: login.php");
?>
