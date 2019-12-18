<?php
include "includes/mysqli_connect.php";
include "includes/source.php";
include "includes/header.php";
?>
    <section>
        <div class="pageintro">
            <div class="pageintro-bg">
                <img src="style\images\bg-page_03.jpeg" alt="About Us">
            </div>
            <div class="pageintro-body">
                <h1 class="pageintro-title">Tìm Kiếm</h1>
            </div>
        </div>
    </section>
    <section>
        <div class="container p-t-100 p-b-70">
            <div class="row">
                <div class="col-md-9">
                    <div class="shop-list">
                        <?php
                        // Nếu người dùng submit form thì thực hiện
                        if (isset($_REQUEST['ok']))
                        {
                        // Gán hàm addslashes để chống sql injection
                        $search = addslashes($_GET['search']);

                        // Nếu $search rỗng thì báo lỗi, tức là người dùng chưa nhập liệu mà đã nhấn submit.
                        if (empty($search)) {
                            echo "Hãy nhập dữ liệu sản phẩm mà bạn muốn tìm kiếm";
                        }
                        else
                        {
                        //Phan Trang

                        $page=1;//khởi tạo trang ban đầu
                        $limit=10;//số bản ghi trên 1 trang (2 bản ghi trên 1 trang)
                        $arrs_list = mysqli_query($dbc,"
                            select product_id from products WHERE product_name like '%$search%'
                        ");
                        $total_record = mysqli_num_rows($arrs_list);//tính tổng số bản ghi có trong bảng khoahoc
                        $total_page=ceil($total_record/$limit);//tính tổng số trang sẽ chia
                        //xem trang có vượt giới hạn không:
                        if(isset($_GET["page"])){
                            $page=$_GET["page"];//nếu biến $_GET["page"] tồn tại thì trang hiện tại là trang $_GET["page"]
                        }
                        if($page>$total_page){
                            $page=$total_page;//nếu trang hiện tại vượt quá số trang được chia thì sẽ bằng trang cuối cùng
                        }
                        if($page<=1){
                            $page=1; //nếu trang hiện tại nhỏ hơn 1 thì gán bằng 1
                        }

                        //tính start (vị trí bản ghi sẽ bắt đầu lấy):
                        $start=($page-1)*$limit;
                        // Dùng câu lênh like trong sql và sứ dụng toán tử % của php để tìm kiếm dữ liệu chính xác hơn.
                        $q = "select * from products where product_name like '%$search%' LIMIT $start,$limit";
                        print_r($q);
                        // Thực thi câu truy vấn
                        $r = mysqli_query($dbc,$q);

                        // Nếu có kết quả thì hiển thị, ngược lại thì thông báo không tìm thấy kết quả
                        if ($total_record > 0 && $search != "")
                        {
                        // Dùng $num để đếm số dòng trả về.
                        echo "Tìm thấy <b>$total_record</b> sản phẩm với từ khóa <b>$search</b>";
                        ?>
                        <div class="shop-list-body shop-list">
                                <?php
                                    while ($rows = mysqli_fetch_array($r,MYSQLI_ASSOC)) {
                                        ?>

                                    <div class="shop-product">
                                        <div class="product-image">
                                            <a href="#">
                                                <img src="admin/uploads/products/<?php echo $rows['image']?>" style="width: 270px;height: 340px;" alt="Product 1">
                                                <?php
                                                if ($rows['selling_price']<$rows['product_price']){
                                                    $discount = round((($rows['product_price'] - $rows['selling_price'])/$rows['product_price'])*100);
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
                                            <a href="product_detail.php?pid=<?php echo $rows['product_id']?>" class="name"><?php echo $rows['product_name']?></a>
                                            <p class="price"><?php echo number_format($rows['selling_price'], 0, ',', '.')." VNĐ"?></p>
                                            <p class="description"><?php echo $rows['introduce']?></p>
                                            <div class="product-button">
                                                <a href="cart.php?action=add&id=<?php echo $rows['product_id']?>" class="add-to-cart">Thêm vào giỏ hàng</a>
                                            </div>
                                        </div>
                                    </div>
                                            <?php } ?>


                        </div>
                        <nav class="border-bottom-1 border-top-1">
                            <ul class="au-panigation">
                                <?php
                                $current_page = ($start/$limit) + 1;
                                if ($page>1){?>
                                    <li class="panigation-item">
                                        <a href="search.php?search=<?php echo $search?>&ok=Submit&&page=<?php echo $current_page -1; ?>" class="panigation-link">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                                <li class="panigation-item">
                                    <span>Trang:</span>
                                </li>
                                <?php for($i=1;$i<=$total_page;$i++){ ?>
                                    <li class="panigation-item <?php if($page == $i) echo "active"; ?>">
                                        <a href="search.php?search=<?php echo $search?>&ok=Submit&&page=<?php echo $i; ?>" class="panigation-link"><?php echo $i; ?></a>
                                    </li>
                                <?php } ?>
                                <?php
                                if ($current_page<$total_page){?>
                                    <li class="panigation-item" >
                                        <a href="search.php?search=<?php echo $search?>&ok=Submit&&page=<?php echo $current_page +1; ?>" class="panigation-link">
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </nav>
                    </div>
                </div>

                <!-- Sidebar -->
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
                <?php
                }
                else {
                    echo "Không tìm thấy sản phẩm nào với từ khóa <b>$search</b>!";
                }
                }
                }
                ?>
                <!-- End Sidebar -->
            </div>
        </div>
    </section>
<?php
include "includes/footer.php";

?>