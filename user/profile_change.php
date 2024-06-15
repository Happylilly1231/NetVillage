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
    <link rel="stylesheet" href="../css/user/profile_change.css">
    <script type="text/javascript" src="./regist.js"></script>
    <title>회원가입</title>
</head>

<body>
    <?php
    if (!isset($_SESSION['id'])) {
        echo '<script>
        alert("You are not logged in.");
        location.href = "../main/index.php"</script>';
    } else {
        $user_id = $_SESSION['id'];
        $user_name = $_SESSION['name'];

        $query = "SELECT user_email FROM user WHERE user_id = '$user_id'";
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
        $row = mysqli_fetch_array($result);
        $user_email = $row['user_email'];
        ?>
        <h1>Information</h1>
        <div id="regist_wrap" class="regist_container">
            <form action="profile_update.php" method="post" name="regiform" id="regist_form" class="form"
                onsubmit="return sendit()">
                <div class="form_item">
                    <label for="name">Nickname</label>
                    <input type="text" name="name" id="username" placeholder="Nickname" class="form_input"
                        value="<?php echo $user_name ?>">
                </div>

                <div class="form_item">
                    <label for="pw">Password</label>
                    <input type="password" name="pw" id="userpw" placeholder="Password" class="form_input">
                </div>

                <div class="form_item">
                    <label for="pw_ch">Password Check</label>
                    <input type="password" name="pw_ch" id="userpw_ch" placeholder="Password Check" class="form_input">
                </div>

                <div class="form_item">
                    <label for="pw_ch">Email</label>
                    <div class="email_part">
                        <input style="width:210px;" type="text" name="email" id="useremail" placeholder="Email"
                            class="form_input" value="<?php echo explode('@', $user_email)[0]; ?>"><span>@</span>
                        <select name="emadress">
                            <option value="gmail.com">gmail.com</option>
                            <option value="naver.com">naver.com</option>
                            <option value="daum.net">daum.net</option>
                        </select>
                    </div>
                </div>

                <div class="btn_part">
                    <input id="change_button" type="submit" value="Change" class="change_btn">
                </div>
            </form>
        </div>
    </body>
    <?php
    }
    ?>

</html>