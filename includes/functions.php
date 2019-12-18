<?php
//kiem tra ket qua tra ve dung hay sai
function confirm_query($result,$query){
    global $dbc;
    if (!$result){
        die('Query {$query} \n<br> MYSQL Error: '.mysqli_error($dbc));
    }
}
//xác nhận id
function validate_id($id){
    if (isset($id)&& filter_var($id,FILTER_VALIDATE_INT,array('min_array' => 1))) {
        $val_id = $id;
        return $val_id;
    }else{
        return NULL;
    }
}

function has_permission($account,$permission){
    global $dbc;
    $q = "SELECT * FROM users JOIN roles USING (role_id) WHERE user_account = '{$account}' AND permission LIKE '%{$permission}%'";
    $r = mysqli_query($dbc,$q);
    if (mysqli_num_rows($r) >= 1){
        return true;
    }else{
        return false;
    }
}



?>