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
    <link rel="stylesheet" href="../css/diary.css" />
    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/2.4.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
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
            if (isset($_GET['date'])) {
                $date = $_GET['date'];
            } else {
                $date = date('Y-m-d');
            }

            $query = "SELECT diary.* FROM diary WHERE user_id = '$user_id' AND diary_date = '$date'";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_array($result);
            ?>
            <div class="date_and_btn_part">
                <div class="date_part">
                    <button onclick="today_diary()" class="today_btn">Today</button>
                    <h2><?php echo $date; ?></h2>
                </div>
                <div class="btn_part">
                    <button onclick="diary_write('<?php echo $date; ?>')" class="write_btn">Write</button>
                    <button onclick="diary_delete('<?php echo $date; ?>')" class="delete_btn">Delete</button>
                </div>
            </div>
            <div class="diary_and_btn_container">
                <button onclick="left_diary()" class="move_date_btn"><img
                        src="../img/free-icon-font-angle-left.png"></button>
                <div class="diary">
                    <div class="title"><?php if ($row)
                        echo $row['diary_title']; ?></div>
                    <div class="content"><?php if ($row)
                        echo $row['diary_content']; ?></div>
                </div>
                <button onclick="right_diary()" class="move_date_btn"><img
                        src="../img/free-icon-font-angle-right.png"></button>
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

    <!-- js -->
    <script type="text/javascript">
        function left_diary() {
            let date = new Date('<?php echo $date; ?>');
            let previousDate = new Date(date);
            previousDate.setDate(date.getDate() - 1);
            let pDate = previousDate.toISOString().split('T')[0];
            location.href = '../home/diary.php?date=' + pDate;
        }

        function right_diary() {
            if ('<?php echo $date; ?>' == '<?php echo date('Y-m-d'); ?>') {
                alert('Today is the last day.');
            } else {
                let date = new Date('<?php echo $date; ?>');
                let nextDate = new Date(date);
                nextDate.setDate(date.getDate() + 1);
                let nDate = nextDate.toISOString().split('T')[0];
                location.href = '../home/diary.php?date=' + nDate;
            }
        }

        function today_diary() {
            location.href = '../home/diary.php';
        }

        function diary_delete(date) {
            const d = confirm("Are you sure you want to delete it?");
            if (d) {
                location.href = '../home/diary_delete.php?date=' + date;
            }
        }

        function diary_write(date) {
            location.href = '../home/diary_write.php?date=' + date;
        }
    </script>
</body>

</html>