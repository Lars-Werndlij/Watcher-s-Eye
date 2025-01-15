<?php
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
$serie = $stmt->fetch();
$conn = mysqli_connect("localhost", "bit_academy", "bit_academy", "watcherseye");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id = '';
$name = '';
$email = '';
$password = '';
$watchtime = '';
$favorite_genre = '';
$editing = false;
$deleting = false;
$sql = "SELECT id, username, email, password, watchtime, favorite_genre FROM users";
$result = $conn->query($sql);

if (isset($_GET["delete_id"])) {
    $sql = "DELETE FROM user_media WHERE user_id =" . $_GET["delete_id"];
    $result = $pdo->query($sql);
    $sql = "DELETE FROM users WHERE id =" . $_GET["delete_id"];
    $result = $pdo->query($sql);
    header('Location:' . "?page=admin");
}

if (isset($_GET["add_id"]) && $_GET["add_id"] == 1) {
    $_SESSION["add"] = 1;
    header('Location:' . "?page=add");
}

if (isset($_POST["edit"])) {
    header('Location:' . "?page=edit&id=".$_POST["user_id"]);
}

?>
<div class="text-slate-500">
    
</div>