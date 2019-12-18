<?php
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');
$errors = array();
$sid = validate_id($_GET['sid']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

//upload a image

    if (!empty($_FILES['image']['name'])) {
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $str = explode('.', $_FILES['image']['name']);
        $str = end($str);
        $file_ext = strtolower($str);

        $expensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $expensions) === false) {
            $errors[] = "Hãy chọn 1 ảnh slide và ảnh chỉ hỗ trợ upload file JPG, JPEG hoặc PNG.";
        }

        if ($file_size > 2097152) {
            $errors[] = 'Kích thước slide không được lớn hơn 2MB';
        }

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp,"../uploads/slides/".$file_name);
        }
    }

    if (empty($_POST['description'])) {
        $errors[] = "Bạn phải nhập mô tả cho slide";
    } else {
        $decription = mysqli_real_escape_string($dbc, $_POST['description']);
    }

    if (empty($errors)) {
        $q = "UPDATE slides SET ";
        if (!empty($_FILES['image']['name']))
        {
            $q .= " slide_image = '{$_FILES['image']['name']}', ";
        }
        $q .= " description = '{$decription}', ";
        $q .= " post_on = NOW() ";
        $q .= " WHERE slide_id = {$sid} LIMIT 1 ";
        $r = mysqli_query($dbc, $q);
        confirm_query($r, $q);
        if (mysqli_affected_rows($dbc) == 1) {
            $msg = " Sửa slide thành công.";
            $suc = 1;
        }
        header('Location: ../view_slides.php?sid='.$sid.'&&'.'msg=' . $msg.'&&'.'suc='.$suc);
    } else {
        foreach ($errors as $error) {
            $msg .= $error . "<br/>";
         header('Location: ../edit_slide.php?sid='.$sid.'&&'.'msg=' . $msg.'&&'.'suc='.$suc);
        }
    }
}

?>