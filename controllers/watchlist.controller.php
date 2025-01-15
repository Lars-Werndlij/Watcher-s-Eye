<?php
function connectUserMediaDB($status) {
    $pdo = dbConnect();
    if ($status == "nog niet gekeken"){
    $sql = "SELECT user_id, media_id, id, watch_status FROM user_media WHERE watch_status = '".$status."'";
    } else if ($status == "aan het kijken"){
        $sql = "SELECT user_id, media_id, id, watch_status FROM user_media WHERE watch_status = '".$status."'";
    } else if ($status == "gekeken"){
        $sql = "SELECT user_id, media_id, id, watch_status FROM user_media WHERE watch_status = '".$status."'";
    }
    if (!isset($sql)) {
        $sql = "SELECT user_id, media_id, id, watch_status FROM user_media";
    }
    $result = $pdo->query($sql);
    
    $userMedia = $result->fetchAll(PDO::FETCH_ASSOC);
    return $userMedia;
}

function getMedia($userMedia)
{
        $mediaId = $userMedia["media_id"];
        $pdo = dbConnect();
            $sql = "SELECT name, genre , rating, trailer_url, producer, main_cast, streaming, cinema, poster, length_in_minutes, release_date, type, wiki_page, id FROM media WHERE id = '".$mediaId."'";

        $result = $pdo->query($sql);
    
        $media = $result->fetchAll(PDO::FETCH_ASSOC);
        return $media;
    }
function editWatchStatus($idMediawatch, $statuswatch) {
    $host = 'localhost';
$db   = 'watcherseye';
$user = 'bit_academy';
$pass = 'bit_academy';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $options);
$stmt = $pdo->query('SELECT * FROM users');
$conn = mysqli_connect("localhost", "bit_academy", "bit_academy", "watcherseye");
    $sql = "UPDATE user_media SET watch_status='".$statuswatch."' WHERE media_id = '".$idMediawatch."'";
    mysqli_query($conn, $sql);
}
?>