<?php
require_once ('sql.php');
session_start();
// if(isset($_SESSION["member"]) && ($_SESSION["member"] !="")){
//     if($_SESSION["memberLevel"]=="member"){
//         header("Location:index.php");
//     }
    // else{
    //     header("Location:index");
    // }
// }

if (!isset($_REQUEST['account'])) header('Location:member.php');
// $name = $_REQUEST["name"];
$account = $_REQUEST['account'];
$password = $_REQUEST['password'];

$sql = "SELECT mId, mName, mPassword, mLevel FROM member WHERE mAccount = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('s', $account);
$stmt->execute();
// echo $stmt->execute();


$result = $stmt->get_result();
// echo $result;
if ($result->num_rows > 0) {
    $member = $result->fetch_object();
    // $member->account . '<br>' . $member->password
    if (password_verify($password, $member->mPassword)) {
        $_SESSION['member'] = $member->mName;
        $_SESSION['memberLevel'] = $member->mLevel;
        $_SESSION['memberId'] = $member->mId;

        echo "success";
        // header('Location:index.php');
    } else {
        echo "fail";
        // echo "<script>console.log('$account,$password')</script>";
        header('Location:member.php');
    }
} else {
    //not exist account
    echo "error";
    header('Location: member.php');
}

?>