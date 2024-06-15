<?php
// village_id, number of people in the village
$query = 'SELECT village.idx AS village_id, COUNT(user.idx) AS user_count FROM user
JOIN village ON user.village_id = village.idx
GROUP BY village.idx;';
$result = mysqli_query($db, $query);

// Find a village with less than 10 people
$village_id = 0;
while ($row = mysqli_fetch_array($result)) {
    if ($row['user_count'] < 10) {
        $village_id = $row['village_id'];
        break;
    }
}

if ($village_id == 0) { // Create a village
    // auto_increment reset
    $query = "ALTER TABLE village auto_increment=1";
    $result = mysqli_query($db, $query);

    // Choose a village name
    $query = "SELECT MAX(idx) AS max_idx FROM village";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_array($result);
    $max_idx = $row['max_idx'];
    if ($max_idx === null) { // When there is no village
        $max_idx = 0;
    }
    $village_name = "Village" . ($max_idx + 1);

    // Create a village
    $query = "INSERT INTO village VALUES(null, '$village_name', now())";
    $result = mysqli_query($db, $query);

    $village_id = $max_idx + 1;
}
?>