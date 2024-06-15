<?php
session_start();
include '../db/db_conn.php';

$user_id = $_SESSION['id'];

$query = "DELETE FROM user WHERE user_id = '$user_id'";
$result = mysqli_query($db, $query);
if ($result === false) {
    echo "There was a problem saving. Please contact the administrator.";
    echo mysqli_error($db);
} else {
    include './logout.php';
    echo '<script>alert("User information has been deleted.")</script>';
    echo "<script>location.href = '../main/index.php'</script>";
    mysqli_close($db);
}
?>