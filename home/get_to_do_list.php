<?php
$today = date('Y-m-d');
echo $today;
$query = "SELECT todo.* FROM todo JOIN user ON todo.user_id = user.user_id WHERE DATE(created_at) = '$today'";
$result = mysqli_query($db, $query) or die(mysqli_error($db));
while ($row = mysqli_fetch_array($result)) {
    ?>
    <div>
        <input type="checkbox" class="complete_check" value="<?php echo $row['idx']; ?>" <?php if ($row['todo_complete'] == 1) {
               echo 'checked';
           } ?>>
        <div>
            <?php echo $row['todo_content']; ?>
        </div>
    </div>
    <?php
}
?>