<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'project_test_db';
$db = new mysqli($servername, $username, $password, $dbname) or die("Connection failed:");
date_default_timezone_set('Asia/Seoul'); // timezone set Seoul <- same mysql sever timezone

?>