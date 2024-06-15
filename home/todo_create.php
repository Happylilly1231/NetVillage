<?php
session_start();
include '../db/db_conn.php';

$user_id = $_SESSION['id'];
$content = $_POST['content'];

if ($content == '') {
    echo '<script>alert("Please enter your details.")</script>';
    echo '<script>location.href = "../home/to_do_list.php"</script>';
    exit();
}

$query = "ALTER TABLE todo auto_increment=1";
$result = mysqli_query($db, $query);

$query = "INSERT INTO todo VALUES(null, '$user_id', '$content', 0, now())";
$result = mysqli_query($db, $query);

if ($result === false) {
    echo "There was a problem saving. Please contact the administrator.";
    echo mysqli_error($db);
} else {
    echo '<script>alert("Todo creation completed.")</script>';
    echo '<script>location.href = "../home/to_do_list.php"</script>';
    mysqli_close($db);
}
?>