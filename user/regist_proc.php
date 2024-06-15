<?php
session_start();
include '../db/db_conn.php';

// get POST value
$pw = $_POST['pw']; // pw
$hashed_pw = hash('sha256', $pw); // encrypted pw
$email = $_POST['email'] . '@' . $_POST['emadress']; // email

// get viallge_id
include '../village/village_create.php';

// auto_increment reset
$query = "ALTER TABLE user auto_increment=1";
$result = mysqli_query($db, $query);

// Add current user to village
$query = "INSERT INTO user VALUES(null, '{$_POST['name']}', '{$_POST['decide_id']}','$hashed_pw', '$email', now(), '$village_id')";
$result = mysqli_query($db, $query);

if ($result === false) {
    echo "There was a problem saving. Please contact the administrator.";
    echo mysqli_error($db);
} else { // sign up complete
    // Create login session variable
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['id'] = $_POST['decide_id'];
    $_SESSION['village_id'] = $village_id;

    echo '<script>alert("Sign up is complete.")</script>';
    echo '<script>location.href = "../main/index.php?village=' . $_SESSION['village_id'] . '"</script>';
    mysqli_close($db);
}
?>