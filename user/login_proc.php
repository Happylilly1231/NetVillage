<?php
session_start();
include '../db/db_conn.php';

$id = $_POST['id'];
$pw = $_POST['pw'];
$hashed_pw = hash('sha256', $pw);

// Check whether ID exists
$query = "SELECT * FROM user WHERE user_id='$id'";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);

if (!$row) { // If the ID does not exist, go to the login page.
    echo "<script> 
        alert(\"ID does not match.\");
        history.back();
        </script>";
    exit;
} else { // If ID exists, check password
    if ($row['user_password'] != $hashed_pw) { // If password does not match, go to login page
        echo "<script>
                    alert(\"Password does not match.\");
                    history.back();
                </script>";
        exit;
    } else { // Login completed -> Session variable created when password matches
        $_SESSION['name'] = $row['user_name'];
        $_SESSION['id'] = $row['user_id'];
        $_SESSION['village_id'] = $row['village_id'];
        echo '<script>location.href = "../main/index.php?village=' . $_SESSION['village_id'] . '"</script>';
        mysqli_close($db);
    }
}
?>