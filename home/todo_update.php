<?php
session_start();
include '../db/db_conn.php';

$todo_idx = $_POST['todo_idx'];
$todo_content = $_POST['todo_content'];
$checked = $_POST['checked'];
$next = $_POST['next'];
if ($checked == 3) { // delete
    $query = "DELETE FROM todo WHERE idx = $todo_idx";
} else if ($checked == 2) { // modify
    if ($todo_content != '') {
        $query = "UPDATE todo SET todo_content = '$todo_content' WHERE idx = $todo_idx";
    }
} else { // complete_check
    $query = "UPDATE todo SET todo_complete = $checked WHERE idx = $todo_idx";
}
$result = mysqli_query($db, $query);

if ($result === false) {
    echo "There was a problem saving. Please contact the administrator.";
    echo mysqli_error($db);
} else {
    echo "<script>location.href = '{$next}'</script>";
    mysqli_close($db);
}
?>