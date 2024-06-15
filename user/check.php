<?php
session_start();
include '../db/db_conn.php';

$id = $_GET['userid'];

$query = "SELECT * FROM user WHERE user_id='$id'";
$result = mysqli_query($db, $query) or die(mysqli_error($db));
$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
    <script type="text/javascript" src="./regist.js"></script>
    <title>ID Double Check</title>
    <style>
        #decide_button {
            font-size: 14px;
            padding: 7px;
            color: white;
            background-color: black;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php
    if (!$row) {
        echo $id . ' is an available ID.<br><br>';
        echo '<input type="button" id="decide_button" value="Use this ID" onclick="decide();">';
    } else {
        echo "
        <script>
            alert(\"This ID cannot be used.\");
            window.close();
        </script>";
        exit;
    }
    ?>
</body>