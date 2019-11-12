<?php
require_once ('sql.php');
// session_start();
// if(isset($_SESSION["member"]) && ($_SESSION["member"] !="")){
//     if($_SESSION["memberLevel"]=="member"){
//         header("Location:index");
//     }
//     // else{
//     //     header("Location:index");
//     // }
// }

if (!isset($_REQUEST['account'])) header('Location:member.html');
// $name = $_REQUEST["name"];
$account = $_REQUEST['account'];
$password = $_REQUEST['password'];

$sql = "SELECT mName, mPassword, mLevel FROM member WHERE mAccount = ?";
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
        // $_SESSION['member'] = $member->mName;
        // $_SESSION['memberLevel'] = $member->mLevel;
        echo "success";
        // header('Location:index.html');
    } else {
        echo "fail";
        // echo "<script>console.log('$account,$password')</script>";
        header('Location:member.html');
    }
} else {
    //not exist account
    echo "error";
    header('Location: member.html');
}

?>