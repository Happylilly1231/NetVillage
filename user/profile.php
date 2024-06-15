<?php
session_start();
include '../db/db_conn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/common.css" />
    <link rel="stylesheet" href="../css/user/profile.css" />
    <title>NetVillage</title>
    <script type="text/javascript" src="../js/nav_and_login.js"></script>
</head>

<body>
    <?php
    // Check if you are logged in
    include '../user/login_check.php';
    ?>

    <header>
        <div class="current_place">
            <img src="../img/profile.png">
            <h1>Profile</h1>
        </div>

        <div class="profile">
            <div class="profile_text">
                <div class="nickname"><?php echo $user_name; ?></div>
                <button onclick="logout()" class="logout_btn">logout</button>
            </div>
            <a href="../user/profile.php"><img src="../img/profile.png"></a>
        </div>
    </header>

    <?php
    $query = "SELECT user_email FROM user WHERE user_id = '$user_id'";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    $row = mysqli_fetch_array($result);
    $user_email = $row['user_email'];
    ?>
    <div class="profile_container">
        <img src="../img/profile.png" class="profile_img">
        <h1><?php echo $user_name; ?></h1>
        <div class="text_part">ID : <?php echo $user_name; ?></div>
        <div class="text_part">Email : <?php echo $user_email; ?></div>
        <div class="btn_part">
            <button onclick="change_info()">Change Info</button>
            <button onclick="delete_user()" class="delete_user_btn">Delete User</button>
        </div>
    </div>

    <footer>
        <nav>
            <button class="bottom_nav_btn" onclick="moveToSquare()">
                <img src="../img/square.png">
                <br>Square
            </button>
            <button class="bottom_nav_btn" onclick="moveToVillage(<?php echo $village_id; ?>)">
                <img src="../img/village.png">
                <br>Village
            </button>
            <button class="bottom_nav_btn" onclick="moveToHome()">
                <img src="../img/home.png">
                <br>Home
            </button>
            <button class="bottom_nav_btn" onclick="moveToGarden()">
                <img src="../img/garden.png">
                <br>Garden
            </button>
            <button class="bottom_nav_btn" onclick="moveToLibrary()">
                <img src="../img/library.png">
                <br>Library
            </button>
        </nav>
    </footer>

    <form id="user_update_form" action="../user/user_update.php" method="post" onsubmit="return sendit()">
        <input type="hidden" id="username" name="username">
        <input type="hidden" id="pw" name="pw">
    </form>

    <!-- js -->
    <script type="text/javascript">
        function change_info() {
            location.href = '../user/profile_change.php';
        }

        function delete_user() {
            const d = confirm("Are you sure you want to delete it?");
            if (d) {
                location.href = '../user/user_delete.php';
            }
        }
    </script>
</body>

</html>