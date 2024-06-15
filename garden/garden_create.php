<?php
session_start();
include '../db/db_conn.php';

$user_id = $_SESSION['id'];
$crop_id = $_POST['crop_id'];

$query = "ALTER TABLE garden auto_increment=1";
$result = mysqli_query($db, $query);

$query = "SELECT * FROM garden WHERE user_id = '$user_id'";
$result = mysqli_query($db, $query);
$count = mysqli_num_rows($result);
if ($count < 1) {
    $today = date('Y-m-d');
    $query = "INSERT INTO garden VALUES(null, '$user_id', $crop_id, 0, 0, '$today', now())";
    $result = mysqli_query($db, $query);
    if ($result === false) {
        echo "There was a problem saving. Please contact the administrator.";
        echo mysqli_error($db);
    } else {
        echo '<script>alert("Garden creation complete.")</script>';
        echo '<script>location.href = "../garden/garden.php"</script>';
    }
} else {
    echo '<script>alert("You can no longer create gardens.")</script>';
    echo '<script>location.href = "../garden/garden.php"</script>';
}
mysqli_close($db);
?>