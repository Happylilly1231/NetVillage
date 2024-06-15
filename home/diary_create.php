<?php
session_start();
include '../db/db_conn.php';

$user_id = $_SESSION['id'];
$title = $_POST['title'];
$content = $_POST['content'];
$modify = $_POST['modify'];
$date = $_GET['date'];

if ($content == '') {
    echo '<script>alert("Please enter your details.")</script>';
    echo '<script>location.href = "../home/diary_write.php"</script>';
    exit();
}

$query = "ALTER TABLE diary auto_increment=1";
$result = mysqli_query($db, $query);

if ($modify == 1) { // modify
    $query = "UPDATE diary SET diary_title = '$title', diary_content = '$content', modified_at = now() WHERE diary_date = '$date'";
} else { // create
    $query = "INSERT INTO diary VALUES(null, '$user_id', '$title', '$content', '$date', now(), null)";
}

$result = mysqli_query($db, $query);

if ($result === false) {
    echo "There was a problem saving. Please contact the administrator.";
    echo mysqli_error($db);
} else {
    echo '<script>alert("Diary completed.")</script>';
    echo "<script>location.href = '../home/diary.php?date={$date}'</script>";
    mysqli_close($db);
}
?>