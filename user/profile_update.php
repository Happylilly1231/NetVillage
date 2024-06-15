<?php
session_start();
include '../db/db_conn.php';

$pw = $_POST['pw'];
$hashed_pw = hash('sha256', $pw);
$email = $_POST['email'] . '@' . $_POST['emadress'];

// !!! 추후 제거 (테스트용이었음) -> 제거 안해도 될 수도?
// auto_increment 초기화
$query = "ALTER TABLE user auto_increment=1";
$result = mysqli_query($db, $query);


$query = "UPDATE user SET user_name = '{$_POST['name']}', user_password = '$hashed_pw', user_email = '$email' WHERE user_id = '{$_SESSION['id']}'";
$result = mysqli_query($db, $query);
// $result = $db_conn -> query($sql);
// 입력이 됐으면 결과가 1

if ($result === false) {
    echo "저장에 문제가 생겼습니다. 관리자에게 문의 바랍니다.";
    echo mysqli_error($db);
} else {
    $_SESSION['name'] = $_POST['name'];
    echo '<script>alert("This change is complete.")</script>';
    echo '<script>location.href = "../main/index.php?village=' . $_SESSION['village_id'] . '"</script>';
    mysqli_close($db);
}
?>