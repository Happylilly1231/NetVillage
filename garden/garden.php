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
    <link rel="stylesheet" href="../css/garden.css" />
    <title>NetVillage</title>
    <script type="text/javascript" src="../js/nav_and_login.js"></script>
</head>

<body>
    <?php
    // Check if you are logged in
    include '../user/login_check.php';
    ?>

    <!-- header -->
    <header>
        <div class="current_place">
            <img src="../img/garden.png">
            <h1>Garden</h1>
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
        include ('../garden/garden_crop_growth_update.php');
        $query = "SELECT * FROM garden WHERE user_id = '$user_id'";
        $result = mysqli_query($db, $query);
        $count = mysqli_num_rows($result);
        if ($count < 1) {
            ?>
            <form action=" ../garden/garden_create.php" method="post" class="garden_create_form">
                <select name="crop_id">
                    <option value="1">potato</option>
                    <option value="2">carrot</option>
                </select>
                <button type="submit">Create</button>
            </form>
            <?php
        } else {
            echo '<div class="garden">';

            echo '<div class="growth_rate">';
            echo "<div>Today's growth : <span>{$today_growth}</span> %</div>";
            echo "<div>All growth : {$past_growth} + <span>{$today_growth}</span> %</div>";
            echo '</div>';

            for ($i = 0; $i < 4; $i++) {
                $all_growth = $past_growth + $today_growth;
                echo '<div>';
                for ($j = 0; $j < 8; $j++) {
                    if ($all_growth == 0) {
                        echo "<img src='../garden/crop_imgs/{$crop_name}/{$crop_name}0.png'>";
                    } else if ($all_growth < 25) {
                        echo "<img src='../garden/crop_imgs/{$crop_name}/{$crop_name}1.png'>";
                    } else if ($all_growth < 50) {
                        echo "<img src='../garden/crop_imgs/{$crop_name}/{$crop_name}2.png'>";
                    } else if ($all_growth < 75) {
                        echo "<img src='../garden/crop_imgs/{$crop_name}/{$crop_name}3.png'>";
                    } else if ($all_growth < 100) {
                        echo "<img src='../garden/crop_imgs/{$crop_name}/{$crop_name}4.png'>";
                    } else { // $crop_growth == 100
                        echo "<img src='../garden/crop_imgs/{$crop_name}/{$crop_name}5.png'>";
                    }
                }
                echo '</div>';
            }
            echo '</div>';
        }
        ?>
    </main>

    <!-- footer -->
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
        </nav>
    </footer>
</body>

</html>