<?php
$user_id = $_SESSION['id'];
$today = date('Y-m-d');

// past_growth update
$query = "SELECT today_growth, past_growth, last_update_date FROM garden WHERE user_id = '$user_id'";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);
if ($row) {
    $today_growth = $row['today_growth'];
    $past_growth = $row['past_growth'];
    $last_update_date = $row['last_update_date'];
    if ($last_update_date != $today) {
        $query = "UPDATE garden SET past_growth = past_growth + $today_growth, today_growth = 0, last_update_date = '$today' WHERE user_id = '$user_id'";
        $result = mysqli_query($db, $query);
    }

    if ($past_growth >= 100) { // -> updated past_growth
        $query = "DELETE FROM garden WHERE user_id = '$user_id'";
        $result = mysqli_query($db, $query);
    } else {
        // all_todo_count
        $query = "SELECT * FROM todo WHERE user_id = '$user_id' AND DATE(created_at) = '$today'";
        $result = mysqli_query($db, $query);
        $all_todo_count = mysqli_num_rows($result);

        // checked_todo_count
        $query = "SELECT * FROM todo WHERE user_id = '$user_id' AND DATE(created_at) = '$today' AND todo_complete = 1";
        $result = mysqli_query($db, $query);
        $checked_todo_count = mysqli_num_rows($result);

        // today_growth
        if ($all_todo_count == 0) {
            $today_growth = 0;
        } else {
            $today_growth = number_format($checked_todo_count / $all_todo_count * 10, 1);
        }

        // today_growth update
        $query = "UPDATE garden SET today_growth = $today_growth WHERE user_id = '$user_id'";
        $result = mysqli_query($db, $query);

        // variables(crop_name, today_growth, all_growth)
        $query = "SELECT crop.crop_name, garden.today_growth, garden.past_growth FROM garden JOIN crop ON garden.crop_id = crop.crop_id WHERE user_id = '$user_id'";
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
        $row = mysqli_fetch_array($result);
        $crop_name = $row['crop_name'];
        $today_growth = $row['today_growth'];
        $past_growth = $row['past_growth'];
    }
}
?>