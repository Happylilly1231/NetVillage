<?php
session_start();
include '../db/db_conn.php';

$user_id = $_SESSION['id'];
$date = $_GET['date'];

$query = "SELECT * FROM diary WHERE user_id = '$user_id' AND diary_date = '$date'";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);

if ($row) {
    $query = "DELETE FROM diary WHERE user_id = '$user_id' AND diary_date = '$date'";
    $result = mysqli_query($db, $query);
    if ($result === false) {
        echo "There was a problem saving. Please contact the administrator.";
        echo mysqli_error($db);
    } else {
        echo '<script>alert("This Diary has been deleted.")</script>';
        echo "<script>location.href = '../home/diary.php?date={$date}'</script>";
        mysqli_close($db);
    }
} else {
    echo '<script>alert("There is no diary to delete.")</script>';
    echo "<script>location.href = '../home/diary.php?date={$date}'</script>";
}
?>