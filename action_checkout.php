<?php
session_start();

include "includes/mysqli_connect.php";

require "PHPMailer/src/Exception.php";
require "PHPMailer/src/OAuth.php";
require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/POP3.php";
require "PHPMailer/src/SMTP.php";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$msg= '';

$arrKey = array_keys($_SESSION['cart']);
$strKey = implode(",",$arrKey);
$q = "SELECT * from products where product_id in($strKey)";
$r = mysqli_query($dbc, $q);


//Gui Mail
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors = array();
    if (!empty($_POST['name'])){
        $name = $_POST['name'];
    }else{
        $errors[] = "Vui lòng hãy điền họ tên của bạn!";
    }
    if (!empty($_POST['phone'])){
        $phone = $_POST['phone'];
    }else{
        $errors[] = "Vui lòng hãy điền số điện thoại của bạn!";
    }if (!empty($_POST['email'])){
        $email = $_POST['email'];
    }else{
        $errors[] = "Vui lòng hãy điền địa chỉ email của bạn!";
    }
    if (!empty($_POST['address'])){
        $address = $_POST['address'];
    }else{
        $errors[] = "Vui lòng hãy điền địa chỉ giao hàng đến cho bạn!";
    }
    $add_notice = $_POST['add_notice'];
    //gui mail
    if (empty($errors)) {
        $mail = new PHPMailer(true);

        try {
            //Server settings gooogle go port gmail google piavietnam them ob_start

            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = 'smtp.gmail.com';                    // mail server gooogle go port gmail google piavietnam
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = 'tientu99865@gmail.com';                     //mail minh
            $mail->Password = 'vptwgaaxtchtxyjf';                               //mat khau ung dung
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port = 587;                                    // port gmail google piavietnam
            $mail->CharSet = 'UTF-8';
            //Recipients
            $mail->setFrom('tientu99865@gmail.com', 'LYRAE FURNITURE-STORE'); //gui tu
            $mail->addAddress($email, 'Khách Hàng');     // gui den

            //lay noi dung mail gui di
            $mailHTML = '';
            $mailHTML .= '
                    <p>
                        <b>Họ & Tên:</b> ' . $name . '<br>
                        <b>Số điện thoại:</b> ' . $phone . '<br>
                        <b>Địa chỉ giao hàng:</b> ' . $address . '<br>
                        <b>Bổ sung thông tin:</b> ' . $add_notice . '<br>
                        <b>Phí giao hàng:</b><span> 30.000 VNĐ</span><br>
                    </p>


                    <table border="1" cellspacing="0" cellpadding="10" bordercolor="#305eb3" width="100%">
                        <tr bgcolor="#5e5e5e">
                            <td width="70%"><b>
                                    <font color="white">Sản Phẩm</font>
                                </b></td>
                            <td width="10%"><b>
                                    <font color="white">Số Lượng</font>
                                </b></td>
                            <td width="20%"><b>
                                    <font color="white">Tổng Tiền</font>
                                </b></td>
                        </tr>';

            $Tongcong = 0;
            $code = rand(100000,1000000);
            while ($sendmail = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                $Thanhtien = $_SESSION['cart'][$sendmail['product_id']]['quantity'] * $sendmail['selling_price'];

                $mailHTML .= '
                        <tr>
                            <td width="70%">' . $sendmail['product_name'] . '</td>
                            <td width="10%">' . $_SESSION['cart'][$sendmail['product_id']]['quantity'] . '</td>
                            <td width="20%">' . number_format($Thanhtien, 0, ',', '.') . "<span'> VNĐ</span>" . '</td>
                        </tr>';
                $Tongcong += $Thanhtien;
                $q1 = "INSERT INTO transactions (transaction_code,customer_name,customer_email,customer_phone,customer_address,product,quantity,subtotal,time_order) ";
                 $q1 .=" VALUE ($code,'{$name}','{$email}',$phone,'{$address}','{$sendmail['product_name']}','{$_SESSION['cart'][$sendmail['product_id']]['quantity']}',$Thanhtien,NOW())";
                 $r1 = mysqli_query($dbc,$q1);

            }
            $Tongcong += 30000;
            $mailHTML .= '
                                <tr>
                                    <td colspan="2" width="70%"></td>
                                    <td width="20%"><b>
                                            <font color="red">' . number_format($Tongcong, 0, ',', '.') . "<span style='color: red'> VNĐ</span>" . '</font>
                                        </b></td>
                                </tr>
                            </table>




                            <p>
                                Cảm ơn bạn đã tin tưởng và mua hàng của chúng tôi!Chúng tôi sẽ cố gắng giao hàng sớm nhất cho bạn.
                            </p>';
            // Content
            $mail->isHTML(true);                                  // Định dang email thành HTML
            $mail->Subject = 'Hóa Đơn';
            $mail->Body = $mailHTML;

            $mail->send();
            //gui mail xong thi xoa session cart
            unset($_SESSION['cart']);
            header('Location:success.php', true, 302);
        } catch (Exception $e) {
            echo "Lỗi!Mail đã không được gửi do lỗi: {$mail->ErrorInfo}";
        }
    }else {
        foreach ($errors as $error){
            $msg .= $error . "<br/>";
            header('Location: checkout.php?msg='.$msg.'');
        }
    }
}
?>
