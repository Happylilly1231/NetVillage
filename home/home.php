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
    <link rel="stylesheet" href="../css/home.css" />
    <title>NetVillage</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
            <img src="../img/home.png">
            <h1>Home</h1>
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
        $today = date('Y-m-d');
        echo "<h2>{$today}</h2>";
        ?>

        <div class="all_container">
            <div class="to_do_list">
                <?php
                $query = "SELECT todo.* FROM todo WHERE user_id = '$user_id' AND DATE(created_at) = '$today'";
                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <div class="todo_item">
                        <div class="todo_part">
                            <input type="checkbox" id="complete_check_<?php echo $row['idx']; ?>" class="complete_check"
                                value="<?php echo $row['idx']; ?>" <?php if ($row['todo_complete'] == 1) {
                                       echo 'checked';
                                   } ?>>
                            <label for="complete_check_<?php echo $row['idx']; ?>"></label>
                            <div class="todo_content">
                                <?php echo $row['todo_content']; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

            <div class="window"><img src="https://cdn.pixabay.com/photo/2017/08/01/09/34/white-2563976_1280.jpg"></div>

            <audio loop controls onloadstart="this.volume=0.5">
                <source src="../audio/bgm1.mp3" type="audio/mp3">
            </audio>
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
            <button class="bottom_nav_btn" onclick="moveToGarden()">
                <img src="../img/garden.png">
                <br>Garden
            </button>
            <button class="bottom_nav_btn" onclick="moveToToDoList()">
                <img src="../img/to_do_list.png">
                <br>To Do List
            </button>
            <button class="bottom_nav_btn" onclick="moveToDiary()">
                <img src="../img/diary.png">
                <br>Diary
            </button>
        </nav>
    </footer>

    <form id="todo_update_form" action="../home/todo_update.php" method="post">
        <input type="hidden" id="todo_idx" name="todo_idx">
        <input type="hidden" id="todo_content" name="todo_content">
        <input type="hidden" id="checked" name="checked">
        <input type="hidden" id="next" name="next" value="../home/home.php">
    </form>

    <!-- js -->
    <script type="text/javascript">
        $(function () {
            $(".complete_check").change(function () {
                var idx = $(this).val();
                if ($(this).is(':checked')) {
                    var checked = 1;
                }
                else {
                    var checked = 0;
                }
                document.getElementById('todo_idx').value = idx;
                document.getElementById('checked').value = checked;
                document.getElementById('todo_update_form').submit();
            });
        });
    </script>
</body>

</html>