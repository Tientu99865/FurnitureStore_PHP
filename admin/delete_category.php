<?php
include "check_login.php";
include ('../includes/mysqli_connect.php');
include ('../includes/functions.php');
include "admin_header.php";
include "admin_navbar.php";
include "admin_partial.php";
include "admin_sidebar.php"
?>
<?php
    $cid = validate_id($_GET['cid']);
    //lay du lieu cua danh muc da chon

    $q = "SELECT cat_name FROM categories WHERE cat_id ={$cid}";
    $r = mysqli_query($dbc, $q);
    confirm_query($r, $q);

    if (mysqli_num_rows($r) == 1) {
        list($cat_name) = mysqli_fetch_array($r, MYSQLI_NUM);
    } else {
        $msg = "Lỗi!Danh mục không tồn tại";
        $suc = 0;
    }
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row grid-margin">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style="text-align: center;font-size: 30px;">Xóa danh mục : <?php if (isset($cat_name)) echo $cat_name;?></h4>
                        <!-- Dummy Modal Starts -->
                        <form action="action/action_delete_category.php?cid=<?php echo $cid;?>" method="post">
                        <div class="modal demo-modal">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Thông báo</h5>
                                        <button type="button" class="close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Bạn có muốn xóa danh mục <b><?php if (isset($cat_name)) echo $cat_name;?></b> không?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-danger" name="delete" value="Xóa">
                                        <input type="submit" class="btn btn-light" name="delete" value="Hủy">
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                        <!-- Dummy Modal Ends -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
<?php include "admin_end.php" ?>;
