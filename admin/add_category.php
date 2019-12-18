<?php
include "check_login.php";
$account = $_SESSION['user_account'];
$permission = 'add_category';
include ('../includes/mysqli_connect.php');
include ('../includes/functions.php');
if (!has_permission($account,$permission)){
    header('Location: view_categories.php');
    exit;
}
include "admin_header.php";
include "admin_navbar.php";
include "admin_partial.php";
include "admin_sidebar.php";


    if (isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }else{
        $msg= '';
    }

    if (isset($_GET['suc'])){
        $suc = $_GET['suc'];
    }else{
        $suc= '';
    }
?>

<div class="main-panel">
    <div class="content-wrapper">
        <?php
        if (!empty($msg) && ($suc==0)){
            echo "
                    <div class=\"card card-inverse-warning\" id=\"context-menu-access\">
                        <div class=\"card-body\">
                          <p class=\"card-text\" style='text-align: center;'>{$msg}</p>
                        </div>
                    </div>";
        } elseif(!empty($msg) && ($suc==1)){
            echo "
                    <div class=\"card card-inverse-success\" id=\"context-menu-access\">
                        <div class=\"card-body\">
                          <p class=\"card-text\" style='text-align: center;'>{$msg}</p>
                        </div>
                    </div>";
        }//neu có lỗi hoac thanh cong thì thông báo ra màn hình
        ?>
        <div class="row grid-margin">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style="text-align: center;font-size: 30px;">Thêm danh mục</h4>
                        <form class="forms-sample" method="post" action="action/action_add_category.php">
                            <div class="form-group">
                                <label for="exampleInputName1">Tên danh mục <span style="color: red">*</span></label>
                                <input type="text" value="<?php if(isset($_POST['category'])) echo strip_tags($_POST['category']);?>"
                                       name="category" class="form-control" id="exampleInputName1" placeholder="Tên danh mục" />
                                <!-- Hàm strip_tags() sẽ loại bỏ các thẻ HTML và PHP ra khỏi chuỗi. Hàm sẽ trả về chuỗi đã loại bỏ hết các thẻ HTML và PHP.-->
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword4">Chọn vị trí <span style="color: red">*</span></label>
                                <select name="position" aria-controls="order-listing" class="form-control">
                                    <option>Vị trí</option>
                                    <?php
                                    $q = "SELECT count(cat_id) as count FROM categories";
                                    $r = mysqli_query($dbc,$q);
                                    confirm_query($r,$q);

                                    if (mysqli_num_rows($r) == 1){
                                        list($num) = mysqli_fetch_array($r,MYSQLI_NUM);
                                        //giong ham array
                                        for($i=1;$i<=$num+1;$i++){
                                            echo "<option value='{$i}'";
                                            if(isset($_POST['position']) && $_POST['position'] == $i) echo "selected='selected'";
                                            //selected='selected' dung de nho du lieu ;
                                            echo ">".$i."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary mr-2">Thêm danh mục</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
<?php include "admin_end.php" ?>;

