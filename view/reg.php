<?php
require_once('sql.php');

$name = $_REQUEST["name"];
$account = $_REQUEST["account"];
$password = $_REQUEST["password"];

$acFlag = preg_match('/^\w{6,12}$/', $account);
$pwFlag = preg_match('/^\w{6,12}$/', $password);
$pwd = password_hash($password, PASSWORD_DEFAULT);

if($acFlag && $pwFlag){
    $sql = "INSERT INTO member(mName,mAccount,mPassword)"
    . "VALUES (?,?,?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sss',$name,$account,$pwd);
    $msg=$stmt->execute();
    // echo $msg;    

    if($msg){
        echo "success";
    }else{
        echo "fail";
    }
}else{
    echo "error";
}
// if ($mysqli->query($sql)) {
//     header("member.html");
// } else {
//     echo "error";
// }

