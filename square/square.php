<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/common.css" />
    <link rel="stylesheet" href="../css/square.css" />
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
            <img src="../img/square.png">
            <h1>Square</h1>
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
        <div id="chat-box"></div>

        <div class="send_message_part">
            <input type="text" id="message" placeholder="Type your message..." class="send_message_input">
            <button onclick="sendMessage()" class="send_btn">Send</button>
        </div>
    </main>

    <!-- footer -->
    <footer>
        <nav>
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

    <!-- js -->
    <script type="text/javascript">
        function fetchMessages() {
            $.get('get_message.php', function (data) {
                name = data.name;
                messages = data.messages;

                $('#chat-box').html(messages); // Add messages html element to element with chat-box id

                plist = document.getElementById('chat-box').getElementsByTagName('p');

                // Data parsing
                for (let i = 0; i < plist.length; i++) {
                    console.log(plist[i].innerHTML.split(' :')[0]);
                    if (plist[i].innerHTML.split(' :')[0] == name) { // If the message is sent by the current user
                        plist[i].innerHTML = plist[i].innerHTML.split(' :')[1] // Print only message content without name
                        plist[i].classList.add("my-chat");
                    }
                    else { // If it is a message sent by another user
                        plist[i].classList.add("other-chat");
                    }
                }

                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight); // Scroll to latest message
            })
        }

        function sendMessage() {
            const message = $('#message').val(); // value of message input
            $.post('send_message.php', { message: message }, function (data) {
                $('#message').val(''); // reset
                fetchMessages();
            });
        }

        $(function () {
            setInterval(fetchMessages, 2000); // Execute fetchMessages function every 2 seconds
            fetchMessages(); // Executed only when the page is first loaded -> Since fetch is performed 2 seconds later by the setInerval function, it is necessary to fetch it at the very beginning as well.
        })
    </script>
</body>

</html>