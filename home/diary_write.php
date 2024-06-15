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
    <link rel="stylesheet" href="../css/diary_write.css" />
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
            <img src="../img/diary.png">
            <h1>Diary</h1>
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
        <div class="diary_container">
            <?php
            $date = $_GET['date'];

            $user_id = $_SESSION['id'];
            $query = "SELECT diary.* FROM diary WHERE user_id = '$user_id' AND diary_date = '$date'";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_array($result);

            if ($row) {
                $title = $row['diary_title'];
                $content = $row['diary_content'];
                $modify = 1; // modify
            } else {
                $title = '';
                $content = '';
                $modify = 0; // create
            }
            ?>
            <h2 class="date"><?php echo $date; ?></h2>
            <form action=" ../home/diary_create.php?date=<?php echo $date; ?>" method="post" class="diary">
                <textarea type="text" placeholder="Please enter a title." name="title" rows="1"
                    class="title"><?php echo $title; ?></textarea>
                <textarea placeholder="Please enter your details." name="content" rows="20"
                    class="content"><?php echo $content; ?></textarea>
                <input type="hidden" name="modify" value="<?php echo $modify; ?>">
                <button type="submit" class="submit_btn">Save</button>
            </form>
        </div>
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