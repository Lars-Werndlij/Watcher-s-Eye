<?php
function getData()
{
    $pdo = dbConnect();
    $sql = "SELECT id, username, email, password, watchtime, favorite_genre FROM users";
    $result = $pdo->query($sql);
    return $result;
}
function getDataEdit($userId)
{
    $pdo = dbConnect();
    $sql = "SELECT id, username, email, password, watchtime, favorite_genre FROM users WHERE id =" . $userId;
    $result = $pdo->query($sql);
    return $result->fetch();
}
function executeEdit()
{

    if (isset($_GET["page"]) && $_GET["page"] == "edit") {
        $pdo = dbConnect();
        if (strpos( $_POST["password"], "*" ) !== false || $_POST["password"] == "**********" || trim($_POST["password"]) == "") {
            $sql = "UPDATE users SET username='" . $_POST["username"] . "', email='" . $_POST["email"] . "', favorite_genre='" . $_POST["favorite"] . "' WHERE id=" . $_POST["edit_id"];
        } else {
            $sql = "UPDATE users SET username =" . $_POST["username"] . ", email =" . $_POST["email"] . ", password =" . $_POST["password"] . ", favorite_genre =" . $_POST["favorite"] . ") WHERE id=" . $_POST["edit_id"];
        }
        $result = $pdo->query($sql);
        header('Location:' . "?page=admin");
    }
}
function executeAdd() {
    if (isset($_GET["page"]) && $_GET["page"] == "add") {
        $pdo = dbConnect();
        if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["favorite"])) {
        $sql = "INSERT INTO users (username, email, password, favorite_genre, watchtime) 
        VALUES ('".$_POST['username']."', '".$_POST['email']."', '".$_POST['password']."', '".$_POST['favorite']."', '0')";
        $result = $pdo->query($sql);
        header('Location:' . "?page=admin");
        } else {
            echo "you have not filled out everything yet";
        }
    }
}
