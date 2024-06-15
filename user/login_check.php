<?php
// Check if you are logged in
if (!isset($_SESSION['id'])) {
    echo '<script>
    alert("Login is required.");
    location.href = "../main/index.php";
    </script>';
    exit();
} else {
    // session variables
    $village_id = $_SESSION['village_id'];
    $user_id = $_SESSION['id'];
    $user_name = $_SESSION['name'];
}
?>