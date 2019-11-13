<?php
require_once('sql.php');
session_start();
$msg = $_REQUEST["msg"];
if($msg){
    $sql = "SELECT * FROM `message` ORDER BY date DESC";
    $result = $mysqli->query($sql);
    // echo $result->num_rows;
    while($row=$result->fetch_assoc()){
        $all[]=$row;
    }
    echo json_encode($all);
    // echo $result;
}