<?php
//connect to MySQL
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'project_test_db';
$db = new mysqli($servername, $username, $password, $dbname) or die("Connection failed:");
//create the main database if it doesn't already exist
$query = 'CREATE DATABASE IF NOT EXISTS project_test_db';
mysqli_query($db, $query) or die(mysqli_error($db));
//make sure our recently created database is the active one
mysqli_select_db($db, 'project_test_db') or die(mysqli_error($db));

//create the user table
$query = 'CREATE TABLE IF NOT EXISTS user (
    idx INTEGER(11) NOT NULL AUTO_INCREMENT,
    user_name VARCHAR(50) NOT NULL,
    user_id VARCHAR(50) NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    user_email VARCHAR(255) NOT NULL,
    regdate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    village_id INTEGER(11) NOT NULL,
    PRIMARY KEY (idx),
    FOREIGN KEY (village_id) REFERENCES village(idx)
    )
    ENGINE=MyISAM';
mysqli_query($db, $query) or die(mysqli_error($db));

// //create the test_chat table
// $query = 'CREATE TABLE IF NOT EXISTS test_chat (
//     chat_id INTEGER(11) NOT NULL AUTO_INCREMENT,
//     user_id VARCHAR(50) NOT NULL,
//     message VARCHAR(255) NOT NULL,
//     created_at DATETIME NOT NULL,
//     PRIMARY KEY (chat_id)
//     )
//     ENGINE=MyISAM';
// mysqli_query($db, $query) or die(mysqli_error($db));

//create the village table
$query = 'CREATE TABLE IF NOT EXISTS village (
    idx INTEGER(11) NOT NULL AUTO_INCREMENT,
    village_name VARCHAR(50) NOT NULL,
    created_at DATETIME NOT NULL,
    PRIMARY KEY (idx)
    )
    ENGINE=MyISAM';
mysqli_query($db, $query) or die(mysqli_error($db));

//create the todo table
$query = 'CREATE TABLE IF NOT EXISTS todo (
    idx INTEGER(11) NOT NULL AUTO_INCREMENT,
    user_id VARCHAR(50) NOT NULL,
    todo_content VARCHAR(255) NOT NULL,
    todo_complete TINYINT(1) NOT NULL,
    created_at DATETIME NOT NULL,
    PRIMARY KEY (idx),
    FOREIGN KEY (user_id) REFERENCES user(user_id)
    )
    ENGINE=MyISAM';
mysqli_query($db, $query) or die(mysqli_error($db));

//create the crop table
$query = 'CREATE TABLE IF NOT EXISTS crop (
    crop_id TINYINT(1) NOT NULL AUTO_INCREMENT,
    crop_name VARCHAR(50) NOT NULL,
    created_at DATETIME NOT NULL,
    PRIMARY KEY (crop_id)
    )
    ENGINE=MyISAM';
mysqli_query($db, $query) or die(mysqli_error($db));

//create the garden table
$query = 'CREATE TABLE IF NOT EXISTS garden (
    idx INTEGER(11) NOT NULL AUTO_INCREMENT,
    user_id VARCHAR(50) NOT NULL,
    crop_id TINYINT(1) NOT NULL,
    today_growth DECIMAL(4,1) NOT NULL,
    past_growth DECIMAL(4,1) NOT NULL,
    last_update_date DATE NOT NULL,
    created_at DATETIME NOT NULL,
    PRIMARY KEY (idx),
    FOREIGN KEY (crop_id) REFERENCES crop(crop_id),
    FOREIGN KEY (user_id) REFERENCES user(user_id)
    )
    ENGINE=MyISAM';
mysqli_query($db, $query) or die(mysqli_error($db));

//create the diary table
$query = 'CREATE TABLE IF NOT EXISTS diary (
    idx INTEGER(11) NOT NULL AUTO_INCREMENT,
    user_id VARCHAR(50) NOT NULL,
    diary_title VARCHAR(50) DEFAULT "Untitled",
    diary_content VARCHAR(255) NOT NULL,
    diary_date DATE NOT NULL,
    created_at DATETIME NOT NULL,
    modified_at DATETIME,
    PRIMARY KEY (idx),
    FOREIGN KEY (user_id) REFERENCES user(user_id)
    )
    ENGINE=MyISAM';
mysqli_query($db, $query) or die(mysqli_error($db));

echo 'project_test_db database successfully created!';
?>