<?php
session_start();
include 'chat.php';

$messages = getMessages(); // get messages
$name = $_SESSION['name'];
$response = [
    'name' => $name,
    'messages' => $messages
];

// json data
header('Content-Type: application/json');
echo json_encode($response);
?>