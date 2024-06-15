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
    <link rel="stylesheet" href="../css/user/regist.css">
    <title>NetVillage</title>
    <script type="text/javascript" src="./regist.js"></script>
</head>

<body>
    <?php
    if (isset($_SESSION['id'])) {
        echo '<script>
        alert("You are already logged in.");
        location.href = "../main/index.php?village=' . $_SESSION['village_id'] . '"</script>';
    } else { ?>
        <h1>Sign Up</h1>
        <div id="regist_wrap" class="regist_container">
            <form action="regist_proc.php" method="post" name="regiform" id="regist_form" class="form"
                onsubmit="return sendit()">
                <div class="form_item">
                    <label for="name">Nickname</label>
                    <input type="text" name="name" id="username" placeholder="Nickname" class="form_input">
                </div>
                <div class="form_item" id="id_item">
                    <label for="id">ID</label>
                    <div id="id_part">
                        <input type="text" name="id" id="userid" placeholder="ID" class="form_input">
                        <input type="button" id="check_button" value="ID Double Check" onclick="checkId();"
                            class="check_btn">
                    </div>

                    <input type="hidden" name="decide_id" id="decide_id">
                    <span id="decide" style='color:red; font-size:13px;'>* Please double check your ID</span>

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
                            class="form_input"><span>@</span>
                        <select name="emadress">
                            <option value="gmail.com">gmail.com</option>
                            <option value="naver.com">naver.com</option>
                            <option value="daum.net">daum.net</option>
                        </select>
                    </div>
                </div>

                <div class="btn_part">
                    <input id="join_button" type="submit" value="Sign Up" class="regist_btn">
                    <a href="login.php" class="login_btn">Login</a>
                </div>
            </form>
        </div>
    </body>
    <?php
    }
    ?>

</html>