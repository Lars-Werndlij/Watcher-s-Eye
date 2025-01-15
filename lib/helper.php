<?php
function dbConnect()
{
    $dsn = "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'] . ";charset=" . $_ENV['DB_CHAR'];

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS'], $options);
    return $pdo;
}

/**
    (var_)dump variable(s)
    No params, just get vars from func_get_args function
 */
function dd()
{
    $args = func_get_args();

    if (count($args)) {
        echo "<pre>";

        foreach ($args as $arg) {
            print_r($arg);
        }

        echo "</pre>";

        die();
    }
}

function getPage()
{
    $page = isset($_GET["page"]) ? $_GET["page"] : '';
    if ($page == '') {
        return '../resources/views/home.view.php';
    }

    if (file_exists('../resources/views/' . $page . ".view.php")) {
        return '../resources/views/' . $page . ".view.php";
    }

    die('404 : page not found');
}

function logInCheck()
{
    if (isset($_SESSION["loggedInUser"])) {
        return true;
    }

    return false;
}

/**
 * Toggle favorite
 * Checks if user added serie or movie to favorite
 * When favorite: set to not favorite
 */
function favoriteCheck()
{
    $media = array();

    $pdo = dbConnect();

    $mediaID = $_POST['actionResult'];

    $sql = "SELECT * FROM user_media WHERE user_id=" . $_SESSION["logInId"] . " AND media_id=" . $mediaID;

    $query = $pdo->query($sql);
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if (empty($result)) {
        $sql = "INSERT INTO user_media (user_id, media_id, favorited, watch_status, rating) 
        VALUES (".$_SESSION['logInId'].", $mediaID, 1, 'nog niet gekeken', 0)";
        $pdo->query($sql);

        return;
    }

    $sql = "DELETE FROM user_media WHERE user_id=" . $_SESSION['logInId'] . " AND media_id=" . $mediaID;

    dd($sql);
}
