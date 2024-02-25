<?php
@include 'config.php';
function uuidv4()
{
    return sprintf('%04x%04x_%04x_%04x_%04x_%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),

        // 16 bits for "time_mid"
        mt_rand(0, 0xffff),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand(0, 0x0fff) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand(0, 0x3fff) | 0x8000,

        // 48 bits for "node"
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}

$uuid = uuidv4();

// echo $uuid;

// echo strval($uuid);



// $readableTime = date("Y.m.d H:i:s", $unixTime);
// $unixTime = time();

// echo $unixTime;

$sql2 = "SELECT MAX(id) as max_id FROM user_form";

$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$max_id = $row2['max_id']+1;

echo "A legnagyobb id értéke: " . $max_id;


?>