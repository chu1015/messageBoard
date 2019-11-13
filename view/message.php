<?php
require_once('sql.php');
session_start();

$mId = $_SESSION['memberId'];
$author = $_SESSION['member'];
$subject = $_REQUEST['subject'];
$content = $_REQUEST['content'];
// echo $author ,$subject ,$content;
$sql = "INSERT INTO message(memberId,author,subject,content)"
    . "VALUES (?,?,?,?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('isss',$mId, $author, $subject, $content);
$msg = $stmt->execute();
// echo $msg;
if($msg){
    echo"success";
}else{
    echo"fail";
}