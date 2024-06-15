<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/common.css" />
    <link rel="stylesheet" href="../css/user/login.css" />
    <title>NetVillage</title>
</head>

<body>
    <?php
    if (isset($_SESSION['id'])) {
        echo '<script>
        alert("You are already logged in.");
        location.href = "../main/index.php?village=' . $_SESSION['village_id'] . '"</script>';
    } else { ?>
        <h1>Login</h1>
        <div id="login_wrap" class="login_container">
            <form action="login_proc.php" method="post" name="loginform" id="login_form" class="form">
                <div class="form_item">
                    <label for="id">ID</label>
                    <input type="text" name="id" id="id" placeholder="ID" class="form_input">
                </div>
                <div class="form_item">
                    <label for="pw">Password</label>
                    <input type="password" name="pw" id="pw" placeholder="Password" class="form_input">
                </div>
                <div class="btn_part">
                    <input type="submit" value="Login" class="login_btn">
                    <a href="regist.php" class="regist_btn">Sign Up</a>
                </div>
                <div class="btn_part">

                </div>
            </form>
        </div>
    </body>

    </html>
    <?php
    }
    ?>