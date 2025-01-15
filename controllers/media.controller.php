<?php

function getFilms()
{
    $pdo = dbConnect();
    $filterTitle = isset($_GET['name']) ? $_GET['name'] : '';
    $filterType = isset($_GET['type']) ? $_GET['type'] : '';

    if (isset($filterType) && isset($filterTitle) && $filterType != "All" && $filterTitle != "") {
        $sql = "SELECT name, poster, length_in_minutes, release_date, type, wiki_page, id FROM media WHERE type = '" . $filterType . "' AND name LIKE'%" . $filterTitle . "%'";
    } else if (isset($filterType) && $filterType != "All") {
        $sql = "SELECT name, poster, length_in_minutes, release_date, type, wiki_page, id FROM media WHERE type = '" . $filterType . "'";
    } else if (isset($filterTitle) && $filterType == "All" && $filterTitle != "") {
        $sql = "SELECT name, poster, length_in_minutes, release_date, type, wiki_page, id FROM media WHERE name LIKE'%" . $filterTitle . "%'";
    } else {
        $sql = "SELECT name, poster, length_in_minutes, release_date, type, wiki_page, id FROM media";
    }

    $result = $pdo->query($sql);

    $media = $result->fetchAll(PDO::FETCH_ASSOC);
    return $media;
}

function getUserMedia()
{

    if (isset($_SESSION['logInId'])) {
        $pdo = dbConnect();

        $sql = "SELECT * FROM user_media WHERE user_id=" . $_SESSION['logInId'];

        $result = $pdo->query($sql);

        $media = $result->fetchAll(PDO::FETCH_ASSOC);
        
        return $media;
    }
}

function getKeysBy($array, $key, $value){
    if (isset($array)) {
    return array_keys(array_filter($array,function($val) use ($key,$value) {
        return $val[$key] === $value;//exact match
        // return strpos($val[$key], $value) === 0;
    } ));
}
}
