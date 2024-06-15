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
    <link rel="stylesheet" href="../css/to_do_list.css" />
    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/2.4.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
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
            <img src="../img/to_do_list.png">
            <h1>To Do List</h1>
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
        <div class="todo_container">
            <button onclick="today_todo()" class="today_btn">Today</button>
            <?php
            if (isset($_GET['date'])) {
                $date = $_GET['date'];
            } else {
                $date = date('Y-m-d');
            }
            echo "<h2>{$date}</h2>";
            $query = "SELECT todo.* FROM todo WHERE user_id = '$user_id' AND DATE(created_at) = '$date'";
            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            ?>
            <div class="todo_and_btn_container">

                <button onclick="left_todo()" class="move_date_btn"><img
                        src="../img/free-icon-font-angle-left.png"></button>

                <div class="to_do_list">
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <div class="todo_item">
                            <div class="todo_part">
                                <input type="checkbox" id="complete_check_<?php echo $row['idx']; ?>" class="complete_check"
                                    value="<?php echo $row['idx']; ?>" <?php if ($row['todo_complete'] == 1) {
                                           echo 'checked ';
                                       }
                                       if ($date != date('Y-m-d')) {
                                           echo 'disabled';
                                       } ?>>
                                <label for="complete_check_<?php echo $row['idx']; ?>"></label>
                                <div class="todo_content">
                                    <?php echo $row['todo_content']; ?>
                                </div>
                            </div>
                            <textarea placeholder="Please enter your details." name="content" rows="5"
                                id="todo_modify_<?php echo $row['idx']; ?>" style="display: none;"
                                class="modify_textarea"><?php echo $row['todo_content']; ?></textarea>
                            <div class="btn_part">
                                <button onclick="todo_modify(this)" data-idx="<?php echo $row['idx']; ?>"
                                    class="modify_btn"><i class="fi fi-rr-pen-square"></i></button>
                                <button onclick="todo_delete(this)" data-idx="<?php echo $row['idx']; ?>"
                                    class="delete_btn"><i class="fi fi-rr-square-x"></i></button>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <button onclick="right_todo()" class="move_date_btn"><img
                        src="../img/free-icon-font-angle-right.png"></button>
            </div>

            <form action=" ../home/todo_create.php" method="post" class="create_form">
                <textarea placeholder="Please enter your details." name="content" rows="5"
                    class="create_textarea"></textarea>
                <button type="submit">Create</button>
            </form>
        </div>
    </main>

    <!-- hidden form -->
    <form id="todo_update_form" action="../home/todo_update.php" method="post">
        <input type="hidden" id="todo_idx" name="todo_idx">
        <input type="hidden" id="todo_content" name="todo_content">
        <input type="hidden" id="checked" name="checked">
        <input type="hidden" id="next" name="next" value="../home/to_do_list.php?date=<?php echo $date; ?>">
    </form>

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
            <button class="bottom_nav_btn" onclick="moveToGarden()">
                <img src="../img/garden.png">
                <br>Garden
            </button>
        </nav>
    </footer>

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

        function left_todo() {
            let date = new Date('<?php echo $date; ?>');
            let previousDate = new Date(date);
            previousDate.setDate(date.getDate() - 1);
            let pDate = previousDate.toISOString().split('T')[0];
            location.href = '../home/to_do_list.php?date=' + pDate;
        }

        function right_todo() {
            if ('<?php echo $date; ?>' == '<?php echo date('Y-m-d'); ?>') {
                alert('Today is the last day.');
            } else {
                let date = new Date('<?php echo $date; ?>');
                let nextDate = new Date(date);
                nextDate.setDate(date.getDate() + 1);
                let nDate = nextDate.toISOString().split('T')[0];
                location.href = '../home/to_do_list.php?date=' + nDate;
            }
        }

        function today_todo() {
            location.href = '../home/to_do_list.php';
        }

        function todo_modify(e) {
            let idx = e.dataset.idx;
            console.log(e.innerHTML);
            if (e.innerHTML == '<i class="fi fi-rr-pen-square"></i>') { // modify
                document.getElementById("todo_modify_" + idx).style.display = 'block';
                e.innerHTML = '<i class="fi fi-rr-check-circle"></i>'; // save
                e.style.backgroundColor = 'green';
            } else {
                console.log(document.getElementById("todo_modify_" + idx).value);
                document.getElementById('todo_idx').value = idx;
                document.getElementById('todo_content').value = document.getElementById("todo_modify_" + idx).value;
                document.getElementById('checked').value = 2;
                document.getElementById('todo_update_form').submit();
                document.getElementById("todo_modify_" + idx).style.display = 'none';
                e.innerHTML = '<i class="fi fi-rr-pen-square"></i>'; // modify
            }
        }

        function todo_delete(e) {
            let idx = e.dataset.idx;
            document.getElementById('todo_idx').value = idx;
            document.getElementById('checked').value = 3;
            document.getElementById('todo_update_form').submit();
        }
    </script>
</body>

</html>