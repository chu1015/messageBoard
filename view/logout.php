<?php
session_start();
$logout = $_REQUEST["logout"];
// echo $logout;
if ($logout == "1") {
    session_destroy();
    echo "2";
} else {
    echo "0";
}