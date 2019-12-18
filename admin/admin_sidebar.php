
<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="admin_index.php">
                <i class="mdi mdi-view-dashboard-outline menu-icon"></i>
                <span class="menu-title">Trang chủ</span>
            </a>
        </li>
<!--        <li class="nav-item">-->
<!--            <a class="nav-link" href="pages/widgets/widgets.html">-->
<!--                <i class="mdi mdi-airplay menu-icon"></i>-->
<!--                <span class="menu-title">Widgets</span>-->
<!--            </a>-->
<!--        </li>-->
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="mdi mdi-puzzle-outline menu-icon"></i>
                <span class="menu-title">Quản lý danh mục</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="add_category.php">Thêm danh mục</a></li>
                    <li class="nav-item"> <a class="nav-link" href="view_categories.php">Danh sách danh mục</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-advanced" aria-expanded="false" aria-controls="ui-advanced">
                <i class="mdi mdi-bullseye-arrow menu-icon"></i>
                <span class="menu-title">Quản lý sản phẩm</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-advanced">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="add_product.php">Thêm sản phẩm</a></li>
                    <li class="nav-item"> <a class="nav-link" href="view_products.php">Danh sách các sản phẩm</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                <span class="menu-title">Quản lý silde</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="add_slide.php">Thêm silde</a></li>
                    <li class="nav-item"><a class="nav-link" href="view_slides.php">Danh sách silde</a></li>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="view_transactions.php">
                <i class="mdi mdi-playlist-check menu-icon"></i>
                <span class="menu-title">Quản lý giao dịch</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="view_users.php">
                <i class="mdi mdi-comment-account-outline menu-icon"></i>
                <span class="menu-title">Danh sách tài khoản admin</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="view_roles.php">
                <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                <span class="menu-title">Quản lý chức vụ</span>
            </a>
        </li>
    </ul>
</nav>
<!-- partial -->