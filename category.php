<?php
session_start();
include "includes/mysqli_connect.php";
include "includes/functions.php";
include "includes/source.php";
include "includes/header.php";
?>
<?php
$cid = validate_id($_GET['cid']);
//Phan Trang

    $page=1;//khởi tạo trang ban đầu
    $limit=10;//số bản ghi trên 1 trang (2 bản ghi trên 1 trang)
    $arrs_list = mysqli_query($dbc,"
                select product_id from products WHERE cat_id = {$cid}
            ");
    $total_record = mysqli_num_rows($arrs_list);//tính tổng số bản ghi có trong bảng khoahoc

    $total_page=ceil($total_record/$limit);//tính tổng số trang sẽ chia

    //xem trang có vượt giới hạn không:
    if(isset($_GET["page"]))
        $page=$_GET["page"];//nếu biến $_GET["page"] tồn tại thì trang hiện tại là trang $_GET["page"]
    if($page<1) $page=1; //nếu trang hiện tại nhỏ hơn 1 thì gán bằng 1
    if($page>$total_page) $page=$total_page;//nếu trang hiện tại vượt quá số trang được chia thì sẽ bằng trang cuối cùng

    //tính start (vị trí bản ghi sẽ bắt đầu lấy):
    $start=($page-1)*$limit;

//products database
$q = "SELECT * FROM categories WHERE cat_id = {$cid}";
$r = mysqli_query($dbc,$q);

$cat = mysqli_fetch_array($r,MYSQLI_ASSOC);
?>
    <section>
        <div class="pageintro">
            <div class="pageintro-bg">
                <img src="style\images\bg-page_03.jpeg" alt="About Us">
            </div>
            <div class="pageintro-body">
                <h1 class="pageintro-title">Danh mục</h1>
                <nav class="pageintro-breadcumb">
                    <ul>
                        <li>
                            <a href="category.php?cid={$rows['cat_id']}"><?php echo $cat['cat_name']?></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
    <?php
        $q = "SELECT * FROM products WHERE cat_id = {$cat['cat_id']} ORDER BY post_on ASC";
        $r = mysqli_query($dbc,$q);
        $array = array();
        while ($rows = mysqli_fetch_array($r)){
            $array[] = $rows;
        }
        $dem = count($array);
    ?>
    <section>
        <div class="container p-t-100 p-b-70">

            <?php if ($total_page>0){?>

            <div class="row">
                <div class="col-md-9">
                    <div class="shop-list">
                        <div class="shop-list-heading">
                            <div class="number-product">
                                Có tất cả
                                <span>
                                    <?php
                                        echo "<b>".$dem."</b>";
                                    ?>
                                </span> sản phẩm thuộc danh mục <?php echo "<b>".$cat['cat_name']."</b>" ?>
                            </div>
                        </div>
                        <div class="shop-list-body">
                            <?php
                            $q = "SELECT * FROM products WHERE cat_id = {$cat['cat_id']} ORDER BY post_on DESC LIMIT $start,$limit";
                            $r = mysqli_query($dbc,$q);
                                while ($products = mysqli_fetch_array($r,MYSQLI_ASSOC)) {
                                    ?>
                                    <div class="shop-product">
                                        <div class="product-image">
                                            <a href="product_detail.php?pid=<?php echo $products['product_id'] ?>">
                                                <img src="admin/uploads/products/<?php echo $products['image']?>" style="width: 270px;height: 340px;" alt="Product 1">
                                        <?php
                                            if ($products['selling_price']<$products['product_price']){
                                                $discount = round((($products['product_price'] - $products['selling_price'])/$products['product_price'])*100);
                                                echo "
                                                    <span class=\"ribbons\">
                                                        <span class=\"onsale ribbon\">Giảm $discount%</span>
                                                    </span>
                                                ";
                                            }
                                        ?>
                                            </a>
                                        </div>
                                        <div class="product-body">
                                            <a href="product_detail.php?pid=<?php echo $products['product_id'] ?>" class="name"><?php echo $products['product_name']?></a><br><br>
                                            <?php
                                            if ($products['selling_price']<$products['product_price']){
                                                ?>
                                                <span class="price" style="text-decoration: line-through;"><?php echo number_format($products['product_price'], 0, ',', '.'); ?></span>
                                                <span class="price"> - </span>
                                            <?php } ?>
                                            <span class="price"><?php echo number_format($products['selling_price'], 0, ',', '.')." VNĐ"; ?></span><br>
                                            <p class="description"><?php echo $products['introduce']?></p>
                                            <div class="product-button">
                                                <a href="cart.php?action=add&id=<?php echo $products['product_id']?>" class="add-to-cart">Thêm vào giỏ hàng</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
                        <nav class="border-bottom-1 border-top-1">
                            <ul class="au-panigation">
                                <?php
                                $current_page = ($start/$limit) + 1;
                                if ($page>1){?>
                                    <li class="panigation-item">
                                        <a href="category.php?cid=<?php echo $cid; ?>&&page=<?php echo $current_page -1; ?>" class="panigation-link">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                                <li class="panigation-item">
                                    <span>Trang:</span>
                                </li>
                                <?php for($i=1;$i<=$total_page;$i++){ ?>
                                    <li class="panigation-item <?php if($page == $i) echo "active"; ?>">
                                        <a href="category.php?cid=<?php echo $cid; ?>&&page=<?php echo $i; ?>" class="panigation-link"><?php echo $i; ?></a>
                                    </li>
                                <?php } ?>
                                <?php
                                if ($current_page<$total_page){?>
                                    <li class="panigation-item" >
                                        <a href="category.php?cid=<?php echo $cid; ?>&&page=<?php echo $current_page +1; ?>" class="panigation-link">
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </nav>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-md-3">
                    <div class="page-sidebar">

                        <div class="page-sidebar-item">
                            <div class="sidebar-item__heading">
                                <h3 class="title">Danh mục</h3>
                                <div class="title-border m-b-24"></div>
                            </div>
                            <div class="sidebar-item__body">
                                <ul class="sidebar-list">
                                    <?php
                                    $q ="SELECT * FROM categories ORDER BY position ASC";
                                    $r = mysqli_query($dbc,$q);
                                    while ($cats = mysqli_fetch_array($r,MYSQLI_ASSOC)){
                                    ?>
                                    <li>
                                        <a href="category.php?cid=<?php echo $cats['cat_id']?>"><?php echo $cats['cat_name']?></a>
                                        <span class="number">
                                            <?php
                                            $q1 ="SELECT * FROM products WHERE cat_id = {$cats['cat_id']}";
                                            $r1 = mysqli_query($dbc,$q1);
                                            $mang = array();
                                            while ($product_total = mysqli_fetch_array($r1)){
                                                $mang[] = $product_total;
                                            }
                                            echo count($mang);
                                            ?>
                                        </span>
                                    </li>
                                        <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Sidebar -->
            </div>
            <?php }else{
                echo "Không có sản phẩm nào trong danh mục này!<br>";
                echo "<a href='index.php'>Quay lại trang chủ</a>";
            }?>
        </div>
    </section>
<?php
include "includes/footer.php";

?>