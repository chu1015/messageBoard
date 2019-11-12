<?php
require_once ('sql.php');
session_start();
if(isset($_SESSION["member"]) && ($_SESSION["member"] !="")){
    if($_SESSION["memberLevel"]=="member"){
        header("Location:index");
    }
    // else{
    //     header("Location:index");
    // }
}

if (!isset($_REQUEST['account'])) header('Location:member.html');
$name = $_REQUEST["name"];
$account = $_REQUEST['account'];
$password = $_REQUEST['password'];

$sql = "SELECT mName, mPassword, mLevel FROM member WHERE account = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('s', $account);
$stmt->execute();


$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $member = $result->fetch_object();
    // $member->account . '<br>' . $member->password
    if (password_verify($password, $member->mPassword)) {
        $_SESSION['member'] = $member->mName;
        $_SESSION['memberLevel'] = $member;
        header('Location:index.php');
    } else {
        header('Location:member.html');
    }
} else {
    //not exist account
    header('Location: lmember.html');
}
?>