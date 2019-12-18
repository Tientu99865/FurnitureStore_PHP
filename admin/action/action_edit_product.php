<?php
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');
$errors = array();
$pid = validate_id($_GET['pid']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cat_id']) && filter_var($_POST['cat_id'], FILTER_VALIDATE_INT, array('min_array' => 1))) {
        $cat_id = mysqli_real_escape_string($dbc, strip_tags($_POST['cat_id']));
    } else {
        $errors[] = 'Bạn phải chọn danh mục cho sản phẩm';
    }


//kiem tra nhap ten san pham
    if (empty($_POST['product'])) {
        $errors[] = 'Bạn phải điền tên cho sản phẩm';
    } else {
        $p_name = mysqli_real_escape_string($dbc, strip_tags($_POST['product']));
    }
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
            $errors[] = "Hãy chọn 1 ảnh sản phẩm và ảnh chỉ hỗ trợ upload file JPG, JPEG hoặc PNG.";
        }

        if ($file_size > 2097152) {
            $errors[] = 'Kích thước file không được lớn hơn 2MB';
        }

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../uploads/products/" . $file_name);
        }
    }

//kiem tra gia san pham
    if (!empty($_POST['product_price']) && (float)$_POST['product_price'] >= 0) {
        $product_price = $_POST['product_price'];
    } elseif (!empty($_POST['product_price']) && (float)$_POST['product_price'] < 0) {
        $errors[] = 'Giá sản phẩm không thể  có giá trị nhỏ hơn 0';
    } elseif (empty($_POST['product_price'])) {
        $errors[] = 'Bạn phải nhập giá sản phẩm';
    }

//kiem tra text giam gia
    if (!empty($_POST['selling_price']) && (float)$_POST['selling_price'] >= 0) {
        $selling_price = $_POST['selling_price'];
    } elseif (!empty($_POST['selling_price']) && (float)$_POST['selling_price'] < 0) {
        $errors[] = 'Giảm giá không thể có giá trị nhỏ hơn 0';
    } elseif (empty($_POST['selling_price'])) {
        $errors[] = 'Bạn phải nhập giảm giá sản phẩm';
    }

//kiem tra selling _price va product_price
    if (isset($_POST['product_price']) && isset($_POST['selling_price']) && ($_POST['product_price'] < $_POST['selling_price'])) {
        $errors[] = 'Giá bán sản phẩm không thể nhỏ hơn giá sản phẩm!!! Bạn vui lòng nhập lại.';
    }

//kiem tra noi san xuất
    if (empty($_POST['made_in'])) {
        $errors[] = 'Bạn phải nhập nơi sản xuất cho sản phẩm';
    } else {
        $made_in = mysqli_real_escape_string($dbc, strip_tags($_POST['made_in']));
    }

//
    if (empty($_POST['introduce'])) {
        $errors[] = "Bạn phải nhập thông tin của sản phẩm";
    } else {
        $introduce = mysqli_real_escape_string($dbc, $_POST['introduce']);
    }

    if (empty($errors)) {
        $q = "UPDATE products SET ";
        $q .= " cat_id = '{$cat_id}', ";
        $q .= " product_name = '{$p_name}', ";
        if (!empty($_FILES['image']['name'])){
        $q .= " image = '{$_FILES['image']['name']}', ";
        }
        $q .= " product_price = '{$product_price}', ";
        $q .= " selling_price = '{$selling_price}', ";
        $q .= " made_in = '{$made_in}', ";
        $q .= " introduce = '{$introduce}', ";
        $q .= " post_on = NOW() ";
        $q .= " WHERE product_id = {$pid} LIMIT 1 ";
        $r = mysqli_query($dbc, $q);
        confirm_query($r, $q);
        if (mysqli_affected_rows($dbc) == 1) {
            $msg = " Sửa sản phẩm thành công.";
            $suc = 1;
            header('Location: ../view_products.php?pid='.$pid.'&&'.'msg=' . $msg.'&&'.'suc='.$suc);
        } else {
            $msg = "Lỗi!Sản phẩm không thay đổi";
            $suc = 0;
        }
    } else {
        foreach ($errors as $error) {
            $msg .= $error . "<br/>";
            header('Location: ../edit_product.php?pid='.$pid.'&&'.'msg=' . $msg.'&&'.'suc='.$suc);
        }
    }

}

?>