<?php
include "check_login.php";
include "admin_header.php";
include "admin_navbar.php";
include "admin_partial.php";
include "admin_sidebar.php";
include('../includes/mysqli_connect.php');
include('../includes/functions.php');

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
    $msg = '';
}
if (isset($_GET['suc'])) {
    $suc = $_GET['suc'];
} else {
    $suc = '';
}

?>
<?php
//Phan trang

$page = 1;//khởi tạo trang ban đầu
$limit = 10;//số bản ghi trên 1 trang (2 bản ghi trên 1 trang)
$arrs_list = mysqli_query($dbc, "
                    select product_id from products 
                ");
$total_record = mysqli_num_rows($arrs_list);//tính tổng số bản ghi có

$total_page = ceil($total_record / $limit);//tính tổng số trang sẽ chia

//xem trang có vượt giới hạn không:
if (isset($_GET["page"]))
    $page = $_GET["page"];//nếu biến $_GET["page"] tồn tại thì trang hiện tại là trang $_GET["page"]
if ($page < 1) $page = 1; //nếu trang hiện tại nhỏ hơn 1 thì gán bằng 1
if ($page > $total_page) $page = $total_page;//nếu trang hiện tại vượt quá số trang được chia thì sẽ bằng trang cuối cùng

//tính start (vị trí bản ghi sẽ bắt đầu lấy):
$start = ($page - 1) * $limit;
?>

<div class="main-panel">
    <div class="content-wrapper">

        <?php
        if (!empty($msg) && ($suc == 0)) {
            echo "
                    <div class=\"card card-inverse-warning\" id=\"context-menu-access\">
                        <div class=\"card-body\">
                          <p class=\"card-text\" style='text-align: center;'>{$msg}</p>
                        </div>
                    </div>";
        } elseif (!empty($msg) && ($suc == 1)) {
            echo "
                    <div class=\"card card-inverse-success\" id=\"context-menu-access\">
                        <div class=\"card-body\">
                          <p class=\"card-text\" style='text-align: center;'>{$msg}</p>
                        </div>
                    </div>";
        }//neu có lỗi hoac thanh cong thì thông báo ra màn hình
        ?>

        <div class="row grid-margin">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style="text-align: center;font-size: 30px;">Danh sách các sản phẩm</h4>
                        <p>Có tất cả <b><?php echo $total_record;?></b> sản phẩm</p><br>
                        <div id="js-grid" class="jsgrid" style="position: relative; height: 500px; width: 100%;">
                            <div class="jsgrid-grid-header jsgrid-header-scrollbar">
                                <table class="jsgrid-table">
                                    <tr class="jsgrid-header-row">
                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable"
                                            style="width: 30px;">
                                            #
                                        </th>
                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable"
                                            style="width: 120px;">
                                            Tên sản phẩm
                                        </th>
                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable"
                                            style="width: 150px;">
                                            Sản phẩm thuộc danh mục
                                        </th>
                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable"
                                            style="width: 100px;">
                                            Ảnh
                                        </th>
                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable"
                                            style="width: 100px;">
                                            Giá sản phẩm
                                        </th>
                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable"
                                            style="width: 100px;">
                                            Giá bán
                                        </th>
                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable"
                                            style="width: 100px;">
                                            Nơi sản xuất
                                        </th>
                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable"
                                            style="width: 100px;">
                                            Thông tin sản phẩm
                                        </th>
                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable"
                                            style="width: 100px;">
                                            Ngày đăng
                                        </th>
                                        <th class="jsgrid-header-cell jsgrid-control-field jsgrid-align-center"
                                            style="width: 50px;"><a href="add_product.php"><input
                                                        class="jsgrid-button jsgrid-mode-button jsgrid-insert-mode-button"
                                                        type="button" title="Thêm sản phẩm"></a></th>
                                    </tr>
                                </table>
                            </div>
                            <div class="jsgrid-grid-body" style="height: 307.625px;">

                                <table class="jsgrid-table">
                                    <tbody>
                                    <?php
                                    $q1 = "SELECT * FROM products ORDER BY product_id ASC LIMIT $start,$limit";
                                    $r1 = mysqli_query($dbc, $q1);
                                    confirm_query($r1, $q1);
                                    $stt = 0;
                                    while ($products = mysqli_fetch_array($r1, MYSQLI_ASSOC)) {
                                        $stt += 1;
                                        echo "
                                        <tr class=\"jsgrid-row\">
                                            <td class=\"jsgrid-cell jsgrid-align-center\" style=\"width: 30px;\">" . $stt . "</td>
                                            <td class=\"jsgrid-cell jsgrid-align-center\" style=\"width: 120px;\">" . $products['product_name'] . "</td>
                                            <td class=\"jsgrid-cell jsgrid-align-center\" style=\"width: 150px;\">";
                                        $q = "SELECT cat_id,cat_name ";
                                        $q .= " FROM categories ";
                                        $q .= " WHERE cat_id = {$products['cat_id']}";
                                        $r = mysqli_query($dbc, $q);
                                        confirm_query($r, $q);
                                        $cats = mysqli_fetch_array($r, MYSQLI_ASSOC);
                                        echo "{$cats['cat_name']}";
                                        echo "</td>
                                            <td class=\"jsgrid-cell jsgrid-align-center\" style=\"width: 100px;\"><a href='uploads/products/" . $products['image'] . "'><img src='uploads/products/" . $products['image'] . "' 
                                            style='    width: 50px;height: 50px;border-radius: 0%;' alt=''></a></td>
                                            <td class=\"jsgrid-cell jsgrid-align-center\" style=\"width: 100px;\">" . number_format($products['product_price'], 0, ',', '.') . "</td>
                                            <td class=\"jsgrid-cell jsgrid-align-center\" style=\"width: 100px;\">" . number_format($products['selling_price'], 0, ',', '.') . "</td>
                                            <td class=\"jsgrid-cell jsgrid-align-center\" style=\"width: 100px;\">" . $products['made_in'] . "</td>
                                            <td class=\"jsgrid-cell jsgrid-align-center\" style=\"width: 100px;\">" . $products['introduce'] . "</td>
                                            <td class=\"jsgrid-cell jsgrid-align-center\" style=\"width: 100px;\">" . $products['post_on'] . "</td>
                                            <td class=\"jsgrid-cell jsgrid-control-field jsgrid-align-center\"
                                                style=\"width: 50px;\">
                                                <a href='edit_product.php?pid={$products['product_id']}'><input class=\"jsgrid-button jsgrid-edit-button\" type=\"button\" title=\"Sửa\"></a>
                                                <a href='delete_product.php?pid={$products['product_id']}'><input class=\"jsgrid-button jsgrid-delete-button\" type=\"button\" title=\"Xóa\"></a>
                                            </td>
                                        </tr>
                                        ";
                                    }
                                    ?>

                                    </tbody>
                                </table>
                            </div>
                            <div class="jsgrid-pager-container">
                                <ul class="pagination" style="margin-top: 50px">
                                    <?php
                                    $current_page = ($start/$limit) + 1;
                                    if ($page>1){?>
                                        <li class="page-item">
                                            <a class="page-link" href="view_products.php?page=<?php echo $current_page -1; ?>">
                                                <i class="mdi mdi-chevron-left"></i>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php for($i=1;$i<=$total_page;$i++){ ?>
                                        <li class="page-item <?php if($page == $i) echo "active"; ?>">
                                            <a class="page-link" href="view_products.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                        </li>
                                    <?php } ?>
                                    <?php
                                    if ($current_page<$total_page){?>
                                        <li class="page-item">
                                            <a class="page-link" href="view_products.php?page=<?php echo $current_page +1; ?>">
                                                <i class="mdi mdi-chevron-right"></i>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
<?php include "admin_end.php" ?>;
