<?php
require_once('sql.php');
session_start();
$id = $_REQUEST["upd"];
$contnet = nl2br($_REQUEST["content"]);
$sql = "UPDATE message SET content = ? WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('si',$contnet,$id);
$msg = $stmt->execute();
// echo $id, $contnet;
if($msg){
    echo "success";
}else{
    echo "fail";
}