<?php
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');
$msg= '';
$suc= '';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors = array();
    //kiem tra danh muc
    if (isset($_POST['cat_id']) && filter_var($_POST['cat_id'],FILTER_VALIDATE_INT,array('min_array' => 1))){
        $cat_id = mysqli_real_escape_string($dbc,strip_tags($_POST['cat_id']));
    }else {
        $errors[] = 'Bạn phải chọn danh mục cho sản phẩm';
    }


    //kiem tra nhap ten san pham
    if (empty($_POST['product'])){
        $errors[] = 'Bạn phải điền tên cho sản phẩm';
    }else{
        $product = mysqli_real_escape_string($dbc,strip_tags($_POST['product']));
    }

    //upload a image

    if(isset($_FILES['image'])){
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $str = explode('.',$_FILES['image']['name']); $str = end($str); $file_ext=strtolower($str);


        $expensions= array("jpeg","jpg","png");

        if(in_array($file_ext,$expensions)=== false){
            $errors[]="Hãy chọn 1 ảnh sản phẩm và ảnh chỉ hỗ trợ upload file JPG, JPEG hoặc PNG.";
        }

        if($file_size > 2097152) {
            $errors[]='Kích thước file không được lớn hơn 2MB';
        }

        if(empty($errors)==true) {
            move_uploaded_file($file_tmp,"../uploads/products/".$file_name);
        }
    }


    //kiem tra gia san pham
    if (isset($_POST['product_price']) && $_POST['product_price'] !== '' && (float)$_POST['product_price'] >= 0 ){
        $product_price = $_POST['product_price'];
    }elseif (isset($_POST['product_price'])&& $_POST['product_price'] !== ''&& (float)$_POST['product_price'] < 0){
        $errors[] = 'Giá sản phẩm không thể  có giá trị nhỏ hơn 0';
    }elseif(isset($_POST['product_price']) && $_POST['product_price'] == ''){
        $errors[] = 'Bạn phải nhập giá sản phẩm';
    }

    //kiem tra text gia ban san pham
    if (isset($_POST['selling_price']) && $_POST['selling_price'] !== '' && (float)$_POST['selling_price'] >= 0   ){
        $selling_price = $_POST['selling_price'];
    }elseif (isset($_POST['selling_price']) && $_POST['selling_price'] !== '' && (float)$_POST['selling_price'] < 0){
        $errors[] = 'Giá bán không thể có giá trị nhỏ hơn 0';
    }elseif(isset($_POST['selling_price']) && $_POST['selling_price'] == ''){
        $errors[] = 'Bạn phải nhập giá bán của sản phẩm';
    }
    //kiem tra selling _price va product_price
    if (isset($_POST['product_price']) && isset($_POST['selling_price']) && ($_POST['product_price']<$_POST['selling_price'])){
        $errors[] = 'Giá bán sản phẩm không thể nhỏ hơn giá sản phẩm!!! Bạn vui lòng nhập lại.';
    }

    //kiem tra noi san xuất
    if (empty($_POST['made_in'])){
        $errors[] = 'Bạn phải nhập nơi sản xuất cho sản phẩm';
    }else{
        $made_in = mysqli_real_escape_string($dbc,strip_tags($_POST['made_in']));
    }

    //
    if(empty($_POST['introduce'])) {
        $errors[] = "Bạn phải nhập thông tin của sản phẩm";
    } else {
        $introduce = mysqli_real_escape_string($dbc,$_POST['introduce']);
    }

    if (empty($errors)){
        $q = "INSERT INTO products (cat_id,product_name,product_price,selling_price,image,introduce,made_in,post_on) VALUE ($cat_id,'{$product}',$product_price,$selling_price,'{$_FILES['image']['name']}','{$introduce}','{$made_in}',NOW())";
        $r = mysqli_query($dbc,$q);
        confirm_query($r,$q);
        if (mysqli_affected_rows($dbc) == 1){
            $msg = "Thêm sản phẩm thành công";
            $suc = 1;
        }else{
            $msg = "Thêm sản phẩm không thành công";
            $suc = 0;
        }
    }else{
        foreach ($errors as $error){
            $msg .= $error ."<br/>";
        }
    }
    header('Location: ../add_product.php?msg=' . $msg.'&&'.'suc='.$suc);
}
?>
