<?php
$_SESSION["logInRank"] = "user";
function login() {
$_SESSION["loggedInUser"] = false;
$_SESSION["logInId"] = 0;
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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_SESSION['createuser'] == 1) {
    $favorite = $_POST['favorite'];
    $email = $_POST['email'];
    }
    $query3 = $pdo->query('SELECT id FROM `users`');
    $pdoid = $query3->fetch();
    
    $_SESSION["loggedInUser"] = false;
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if ($_SESSION['createuser'] == 1) {
        $favorite = $_POST['favorite'];
        $email = $_POST['email'];
    }
    $_SESSION["loggedInUser"] = false;
    
    try {
        $stmt = $pdo->prepare('SELECT id, username, password, rank FROM users WHERE username = :username');
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION["password"] = $password;
                $_SESSION["loggedInUser"] = true;
                $_SESSION["logInId"] = $user['id'];
                $_SESSION["logInRank"] = ($user['rank'] == 'admin') ? 'admin' : 'user';
                header('Location: ?name=&type=All&page=home');
                die();
            } else {
                echo "Password is incorrect<br>" . PHP_EOL;
            }
        } else {
            echo "Username does not exist<br>" . PHP_EOL;
        }
    
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $_POST["username"] = $username;
    $_POST["password"] = $password;
    if ($_SESSION["createuser"] == 1) {
        $_POST["email"] = $email;
        $_POST["favorite"] = $favorite;
    }
    if ($_SESSION["createuser"] == 1) {
        if (isset($username) && isset($email) && isset($wachtwoord) && isset($favorite)) {
            $hashed_password = password_hash($wachtwoord, PASSWORD_DEFAULT);
        $query2 = "INSERT INTO `users`(`username`, `email`, `password`, `favorite_genre`, `rank`, watchtime) 
        VALUES ('$username', '$email', '$hashed_password', '$favorite', 'user', 0)";
        mysqli_query($conn, $query2);
        $_SESSION["loggedInUser"] = true;
        $_SESSION["logInId"] = $pdoid;
        header('Location:' . "?name=&type=All&page=home");
        die();
        } else {
            if (!isset($username)) {
                echo "username has not been added";
            } else if (!isset($email)) {
                echo "no email has been submitted";
            } else if (!isset($wachtwoord)) {
                echo "no password was given";
            } else if (!isset($favorite)) {
                echo "Favorite genre was not submitted";
            }
        }
    }
}
}
?>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>