<?php
require '../dompdf-master/vendor/autoload.php';

include('../../includes/mysqli_connect.php');
include('../../includes/functions.php');
use Dompdf\Dompdf;

$code = validate_id($_GET['code']);

$q = "SELECT * FROM transactions WHERE transaction_code = {$code}";
$r = mysqli_query($dbc,$q);

$detail = mysqli_fetch_array($r,MYSQLI_ASSOC);
// instantiate and use the dompdf class
$dompdf = new Dompdf();

$html = '
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
  body { font-family: DejaVu Sans, sans-serif; }
</style>
</head>
<body>
  <div class="card">
       <div class="card-body">';
$html .= '
            <h4 class="card-title">Chi Tiết Hóa Đơn</h4>
            <p class="card-description">
                Họ & Tên khách hàng : <b>'.$detail['customer_name'].'</b>
            </p>
            <p class="card-description">
                Số điện thoại : <b>'.$detail['customer_phone'].'</b>
            </p>
            <p class="card-description">
                Địa chỉ Email : <b>'.$detail['customer_email'].'</b>
            </p>
            <p class="card-description">
                Địa chỉ giao hàng : <b>'.$detail['customer_address'].'</b>
            </p>

            <div class="table-responsive">
            <style>
            table,tr,td,th{
            border: 1px solid black;border-collapse: collapse;
            }
            </style>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                    </thead>
                    <tbody>';
$q1 = "SELECT * FROM transactions WHERE transaction_code = {$code}";
$r1 = mysqli_query($dbc,$q1);
$total = 0;
while ($rows = mysqli_fetch_array($r1,MYSQLI_ASSOC)){
    $html .='
                                <tr>
                                    <td>'.$rows['product'].'</td>
                                    <td>'.$rows['quantity'].'</td>
                                    <td>'.number_format($rows['subtotal'], 0, ',', '.')." VNĐ".'</td>
                                </tr>
    ';
    $total +=$rows['subtotal'];
}
$total +=30000;
$html .='
                                 <tr>
                                    <td>Phí giao hàng </td>
                                    <td>1</td>
                                    <td>30.000 VNĐ</td>
                                </tr>
                                <tr>
                                <td></td>
                                <td></td>
                                <th>Tổng tiền :  '.number_format($total, 0, ',', '.').' VNĐ'.'</th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>';
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();

?>