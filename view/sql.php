<?php
$mysqli=new mysqli('localhost','root','','messageBoard');
if ($mysqli->connect_error !=""){
    echo "資料庫連接失敗";
}else{
    $mysqli->set_charset('utf8');
}
?>