<?php
include "check_login.php";
include ('../includes/mysqli_connect.php');
include ('../includes/functions.php');
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

//xu li code

$uid = validate_id($_GET['uid']);//function


//lay du lieu cua danh muc da chon

$q = "SELECT * FROM users WHERE user_id ={$uid}";
$r = mysqli_query($dbc, $q);
confirm_query($r, $q);

if (mysqli_num_rows($r) == 1) {
    $user = mysqli_fetch_array($r,MYSQLI_ASSOC);
} else {
    $msg = "Lỗi!Tài khoản này không còn tồn tại";
    $suc = 0;
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
                        <h4 class="card-title" style="text-align: center;font-size: 30px;">Sửa tài khoản của  : <?php if(isset($user['user_name'])) echo $user['user_name'];?></h4>
                        <form class="forms-sample" action="action/action_edit_user.php?uid=<?php echo $uid;?>" method="post" >
                            <div class="form-group">
                                <label for="exampleInputName1">Họ & Tên<span style="color: red">*</span></label>
                                <input type="text" value="<?php if(isset($user['user_name'])) echo $user['user_name'];?>"
                                       name="name" class="form-control" id="exampleInputName1" placeholder="Họ & Tên" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Tài khoản <span style="color: red">*</span></label>
                                <input type="text" value="<?php if(isset($user['user_account'])) echo $user['user_account'];?>"
                                       name="account" class="form-control" id="exampleInputEmail3" placeholder="Tài khoản   " />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword4">Chọn chức vụ <span style="color: red">*</span></label>
                                <select name="role_id" aria-controls="order-listing" class="form-control">
                                    <option>Chưa có chức vụ</option>
                                    <?php
                                    $q = "SELECT * FROM roles";
                                    $r = mysqli_query($dbc,$q);
                                    confirm_query($r,$q);

                                    if (mysqli_num_rows($r) > 0){
                                        while ($role = mysqli_fetch_array($r,MYSQLI_ASSOC)){
                                            echo "<option value='{$role['role_id']}'";
                                            if (isset($user['role_id']) && $role['role_id'] == $user['role_id']) echo "selected='selected'";
                                            echo ">".$role['role']."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary mr-2">Sửa tài khoản</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
<?php include "admin_end.php" ?>;

