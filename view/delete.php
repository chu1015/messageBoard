<?php
require_once('sql.php');
session_start();
$id = $_REQUEST["del"];
$sql = "DELETE FROM `message` WHERE `message`.`id` =? ";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i',$id);
$msg = $stmt->execute();
if($msg){
    echo "success";
}else{
    echo "fail";
}