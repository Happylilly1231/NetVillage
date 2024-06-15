<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message'])) {
    include 'chat.php';

    $name = $_SESSION['name'];
    $message = $_POST['message'];
    addMessage($name, $message); // add message
}
?>