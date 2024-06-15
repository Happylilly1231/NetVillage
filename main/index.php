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
    <link rel="stylesheet" href="../css/index.css" />
    <title>NetVillage</title>
    <script type="text/javascript" src="../js/nav_and_login.js"></script>
</head>

<body>
    <?php
    if (!isset($_SESSION['id'])) { // If you are not logged in
        ?>
        <!-- sign up, login -->
        <header>
            <div class="current_place">
                <img src="../img/village.png">
                <h1>NetVillage</h1>
            </div>

            <div class="profile">
                <button onclick="regist()" class="signup_btn">Sign Up</button>
                <button onclick="login()" class="login_btn">Login</button>
            </div>
        </header>
        <?php
        exit();
    } else { // If you are logged in
        // Check whether this village is the current user's village
        if ($_SESSION['village_id'] != $_GET['village']) {
            echo '<script>
            alert("Not your village!");
            location.href = "../main/index.php?village=' . $_SESSION['village_id'] . '"</script>';
        } else {
            // session variables
            $village_id = $_SESSION['village_id'];
            $user_id = $_SESSION['id'];
            $user_name = $_SESSION['name'];
        }
    }
    ?>

    <div class="after_login">
        <!-- header -->
        <header>
            <div class="current_place">
                <img src="../img/village.png">
                <h1>Village</h1>
            </div>

            <div class="profile">
                <div class="profile_text">
                    <div class="nickname"><?php echo $user_name; ?></div>
                    <button onclick="logout()" class="logout_btn">logout</button>
                </div>
                <a href="../user/profile.php"><img src="../img/profile.png"></a>
            </div>
        </header>

        <!-- main -->
        <main>
            <?php
            // get village_name
            $query = "SELECT village_name FROM village WHERE idx = $village_id";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_array($result);
            $village_name = $row['village_name'];
            ?>

            <div class="village_name_part">
                <h2><?php echo $village_name; ?></h2>
            </div>

            <div class="village">
                <div class="up_village">
                    <?php
                    $query = "SELECT user_name FROM user WHERE village_id=$village_id";
                    $result = mysqli_query($db, $query);

                    for ($i = 0; $i < 5; $i++) {
                        $row = mysqli_fetch_array($result);
                        ?>
                        <div class="home">
                            <img src="../img/home.png">
                            <div class="resident_part">
                                <img src="../img/profile.png" class="resident_profile">
                                <div class="resident_name">
                                    <?php if ($row)
                                        echo $row['user_name']; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <div class="road"></div>

                <div class="down_village">
                    <?php
                    for ($i = 0; $i < 5; $i++) {
                        $row = mysqli_fetch_array($result);
                        ?>
                        <div class="home">
                            <img src="../img/home.png">
                            <div class="resident_part">
                                <img src="../img/profile.png" class="resident_profile">
                                <div class="resident_name">
                                    <?php if ($row)
                                        echo $row['user_name']; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </main>


        <!-- footer -->
        <footer>
            <nav>
                <button class="bottom_nav_btn" onclick="moveToSquare()">
                    <img src="../img/square.png">
                    <br>Square
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
    </div>
</body>

</html>