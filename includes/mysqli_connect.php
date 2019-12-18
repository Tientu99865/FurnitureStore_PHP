<?php
$dbc = mysqli_connect('localhost','root','','cnpm');
if (!$dbc){
    trigger_error('Không thể kết nối dữ liệu do : '.mysqli_connect_error());
}else{
    mysqli_set_charset($dbc,'utf8');
}
?>