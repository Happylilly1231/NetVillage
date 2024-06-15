<?php
$messagesFile = 'messages.txt';

// Function to get messages from message file
function getMessages()
{
    global $messagesFile;
    if (file_exists($messagesFile)) {
        return file_get_contents($messagesFile);
    } else {
        return '';
    }
}

// Function to add a message to a message file
function addMessage($name, $message)
{
    global $messagesFile;
    $currentMessages = getMessages();

    // Add name, message
    $currentMessages = $currentMessages . "<p>" . htmlspecialchars($name) . " : " . htmlspecialchars($message) . "</p>\n"; // Escape message using htmlspecialchars
    file_put_contents($messagesFile, $currentMessages);
}
?>