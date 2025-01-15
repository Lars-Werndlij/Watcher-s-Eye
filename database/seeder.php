<?php
require_once '../config.php';
require_once '../lib/helper.php';

$pdo = dbConnect();
$sql = 'ALTER TABLE users AUTO_INCREMENT = 1';
$statement = $pdo->prepare($sql);
$statement->execute();

$sql = 'INSERT INTO users (id, username, email, password, favorite_genre, watchtime, rank) VALUES (:id, :username, :email, :password, :favorite_genre, :watchtime, :rank)';

$forcedusers = array(
    array('username' => 'Dolfijntje123', 'email' => 'dolfijnfan@gmail.com', 'password' => 'password', 'rank' => 'user'),
    array('username' => 'manoman', 'email' => 'manoman@gmail.com', 'password' => 'password', 'rank' => 'user'),
    array('username' => 'bitmeneer36', 'email' => 'bitter@gmail.com', 'password' => 'password', 'rank' => 'user'),
    array('username' => 'admin', 'email' => 'admin@admin.com', 'password' => 'password', 'rank' => 'admin')
);

foreach ($forcedusers as $value) {
    $hashed_password = password_hash($value['password'], PASSWORD_DEFAULT);

    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':id' => NULL,
        ':username' => $value['username'],
        ':email' => $value['email'],
        ':password' => $hashed_password,
        ':favorite_genre' => '',
        ':watchtime' => '',
        ':rank' => $value['rank']
    ]);
}

function registerUser($conn, $email, $password, $role)
{
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $insert_user = $conn->prepare("INSERT INTO `users` (email, password, role) VALUES (?, ?, ?)");
    $insert_user->execute([$email, $hashed_password, $role]);
}

$sql = 'DELETE FROM user_media WHERE media_id IS NOT NULL';
$statement = $pdo->prepare($sql);
$statement->execute();

$sql = 'DELETE FROM media';
$statement = $pdo->prepare($sql);
$statement->execute();

$sql = 'ALTER TABLE media AUTO_INCREMENT = 1';
$statement = $pdo->prepare($sql);
$statement->execute();

$sql = 'INSERT INTO media (id, type, name, genre, length_in_minutes, rating, trailer_url, wiki_page, producer, main_cast, release_date, streaming, cinema, poster)
        VALUES (:id, :type, :name, :genre, :length_in_minutes, :rating, :trailer_url, :wiki_page, :producer, :main_cast, :release_date, :streaming, :cinema, :poster)';




$media_entries = array(
    [
        'type' => 'film',
        'name' => 'The Batman',
        'genre' => 'superhero',
        'length_in_minutes' => 176,
        'rating' => 7.8,
        'trailer_url' => 'mqqft2x_Aa4',
        'wiki_page' => 'https://en.wikipedia.org/wiki/The_Batman_(film)',
        'producer' => 'Matt Reeves',
        'main_cast' => 'Rovert Pattinson, Zoë Kravitz, Jeffrey Wright',
        'release_date' => '2022-03-04',
        'streaming' => 0,
        'cinema' => 1,
        'poster' => 'seyWFgGInaLqW7nOZvu0ZC95rtx.jpg'
    ],
    [
        'type' => 'film',
        'name' => 'Shooter',
        'genre' => 'action',
        'length_in_minutes' => 124,
        'rating' => 7.1,
        'trailer_url' => 'i3A0ptNnC5s',
        'wiki_page' => 'https://en.wikipedia.org/wiki/Shooter_(2007_film)',
        'producer' => 'Antoine Fuqua',
        'main_cast' => 'Mark Wahlberg, Michael Peña, Rhona Mitra',
        'release_date' => '2007-04-23',
        'streaming' => 1,
        'cinema' => 0,
        'poster' => '2aWGxo1E5polpBjPvtBRkWp7qaS.jpg'
        
    ],
    [
        'type' => 'film',
        'name' => 'The Lord of the Rings: The Return of the King',
        'genre' => 'fantasy',
        'length_in_minutes' => 201,
        'rating' => 9.0,
        'trailer_url' => 'r5X-hFf6Bwo',
        'wiki_page' => 'https://en.wikipedia.org/wiki/The_Lord_of_the_Rings:_The_Return_of_the_King',
        'producer' => 'Peter Jackson',
        'main_cast' => 'Elijah Wood, Viggo Mortensen, Ian McKellen',
        'release_date' => '2003-12-01',
        'streaming' => 1,
        'cinema' => 1,
        'poster' => 'wNB551TsEb7KFU3an5LwOrgvUpn.jpg'
    ],
    [
        'type' => 'film',
        'name' => 'Raging Bull',
        'genre' => 'thriller',
        'length_in_minutes' => 129,
        'rating' => 8.1,
        'trailer_url' => 'F2UKuKxCJqc',
        'wiki_page' => 'https://en.wikipedia.org/wiki/Raging_Bull',
        'producer' => 'Martin Scorsese',
        'main_cast' => 'Robert De Niro, Cathy Moriarty, Joe Perci',
        'release_date' => '1980-12-19',
        'streaming' => 0,
        'cinema' => 0,
        'poster' => 'bw3oEvjTyYDIskMpsWHbKMnAjtR.jpg'
    ],
    [
        'type' => 'film',
        'name' => 'The Shawshank Redemption',
        'genre' => 'thriller',
        'length_in_minutes' => 142,
        'rating' => 9.3,
        'trailer_url' => 'PLl99DlL6b4',
        'wiki_page' => 'https://en.wikipedia.org/wiki/The_Shawshank_Redemption',
        'producer' => 'Frank Darabont',
        'main_cast' => 'Tim Robbins, Morgan Freeman, Bob Gunton',
        'release_date' => '1994-09-10',
        'streaming' => 0,
        'cinema' => 1,
        'poster' => '9cqNxx0GxF0bflZmeSMuL5tnGzr.jpg'
    ],
    [
        'type' => 'film',
        'name' => 'Spirited Away',
        'genre' => 'adventure',
        'length_in_minutes' => 125,
        'rating' => 8.6,
        'trailer_url' => 'ByXuk9QqQkk',
        'wiki_page' => 'https://en.wikipedia.org/wiki/Spirited_Away',
        'producer' => 'Hayao Miyazaki',
        'main_cast' => 'Daveigh Chase, Suzanne Pleshette, Miyu Irino',
        'release_date' => '2001-07-20',
        'streaming' => 1,
        'cinema' => 0,
        'poster' => '39wmItIWsg5sZMyRUHLkWBcuVCM.jpg'
    ],
    [
        'type' => 'film',
        'name' => 'Cars 2',
        'genre' => 'animation',
        'length_in_minutes' => 106,
        'rating' => 6.2,
        'trailer_url' => 'lg5hj2c5Nkk',
        'wiki_page' => 'https://en.wikipedia.org/wiki/Cars_2',
        'producer' => 'John Lasseter',
        'main_cast' => 'Owen Wilson, Larry the Cable Guy, Michael Caine',
        'release_date' => '2011-06-18',
        'streaming' => 1,
        'cinema' => 1,
        'poster' => '6mVvjymPpuzE0VYAWAUCBxBAQVW.jpg'
    ],
    [
        'type' => 'film',
        'name' => 'La La Land',
        'genre' => 'romance',
        'length_in_minutes' => 128,
        'rating' => 8.0,
        'trailer_url' => '0pdqf4P9MB8',
        'wiki_page' => 'https://en.wikipedia.org/wiki/La_La_Land',
        'producer' => 'Damien Chazelle',
        'main_cast' => 'Ryan Gosling, Emma Stone, Rosemarie DeWitt',
        'release_date' => '2016-12-22',
        'streaming' => 0,
        'cinema' => 1,
        'poster' => 'uDO8zWDhfWwoFdKS4fzkUJt0Rf0.jpg'
    ],
    [
        'type' => 'film',
        'name' => 'Braveheart',
        'genre' => 'fantasy',
        'length_in_minutes' => 178,
        'rating' => 8.3,
        'trailer_url' => '1NJO0jxBtMo',
        'wiki_page' => 'https://en.wikipedia.org/wiki/Braveheart_(1995)',
        'producer' => 'Mel Gibson',
        'main_cast' => 'Mel Gibson, Sophie Marceau, Patrick McGoohan',
        'release_date' => '1995-09-06',
        'streaming' => 1,
        'cinema' => 1,
        'poster' => 'or1gBugydmjToAEq7OZY0owwFk.jpg'
    ],
    [
        'type' => 'film',
        'name' => 'The Curious Case Of Benjamin Button',
        'genre' => 'story',
        'length_in_minutes' => 166,
        'rating' => 7.8,
        'trailer_url' => 'iH6FdW39Hag',
        'wiki_page' => 'https://en.wikipedia.org/wiki/The_Curious_Case_of_Benjamin_Button',
        'producer' => 'David Fincher',
        'main_cast' => 'Brad Pitt, Cate Blanchett, Tilda Swinton',
        'release_date' => '2009-01-29',
        'streaming' => 1,
        'cinema' => 0,
        'poster' => '26wEWZYt6yJkwRVkjcbwJEFh9IS.jpg'
    ],
    [
        'type' => 'serie',
        'name' => 'The Umbrella Academy',
        'genre' => 'fantasy',
        'length_in_minutes' => 60,
        'rating' => 7.9,
        'trailer_url' => '0DAmWHxeoKw',
        'wiki_page' => 'https://en.wikipedia.org/wiki/The_Umbrella_Academy_(televisieserie)',
        'producer' => 'Steve Blackman',
        'main_cast' => 'Aidan Gallagher, Elliot Page, Tom Hopper',
        'release_date' => '2019-02-15',
        'streaming' => 1,
        'cinema' => 0,
        'poster' => 'qhcwrnnCnN8NE1N6XXKHFmveJR9.jpg'
    ],
    [
        'type' => 'serie',
        'name' => 'The Walking Dead',
        'genre' => 'apocalypse',
        'length_in_minutes' => 45,
        'rating' => 8.1,
        'trailer_url' => 'sfAc2U20uyg',
        'wiki_page' => 'https://en.wikipedia.org/wiki/The_Walking_Dead_(televisieserie)',
        'producer' => 'Frank Darabont',
        'main_cast' => 'Andrew Lincoln, Norman Reedus, Melissa McBride',
        'release_date' => '2010-10-31',
        'streaming' => 1,
        'cinema' => 0,
        'poster' => 'n7PVu0hSz2sAsVekpOIoCnkWlbn.jpg'
    ],
    [
        'type' => 'serie',
        'name' => 'Lego Ninjago',
        'genre' => 'animation',
        'length_in_minutes' => 30,
        'rating' => 7.7,
        'trailer_url' => '6Qz4Z_54UbE',
        'wiki_page' => 'https://en.wikipedia.org/wiki/LEGO_Ninjago',
        'producer' => 'Michael Hegner',
        'main_cast' => 'Michael Adamthwaite, Kelly Metzger, Kirby Morrow',
        'release_date' => '2011-01-14',
        'streaming' => 1,
        'cinema' => 1,
        'poster' => 'fqb9X4th2p2voefRLqdv1xoZQmC.jpg'
    ],
    [
        'type' => 'serie',
        'name' => 'Game of Thrones',
        'genre' => 'fantasy',
        'length_in_minutes' => 60,
        'rating' => 9.2,
        'trailer_url' => 'bjqEWgDVPe0',
        'wiki_page' => 'https://en.wikipedia.org/wiki/Game_of_Thrones',
        'producer' => 'David Benioff',
        'main_cast' => 'Emilia Clarke, Peter Dinklage, Kit Harington',
        'release_date' => '2011-04-17',
        'streaming' => 1,
        'cinema' => 0,
        'poster' => '1XS1oqL89opfnbLl8WnZY1O1uJx.jpg'
    ],
    [
        'type' => 'serie',
        'name' => 'Rings of Power',
        'genre' => 'fantasy',
        'length_in_minutes' => 60,
        'rating' => 7.0,
        'trailer_url' => 'x8UAUAuKNcU',
        'wiki_page' => 'https://en.wikipedia.org/wiki/The_Lord_of_the_Rings:_The_Rings_of_Power',
        'producer' => 'Patrick McKay',
        'main_cast' => 'Morfydd Clark, Ismael Cruz Cordova, Charlie Vickers',
        'release_date' => '2022-09-01',
        'streaming' => 1,
        'cinema' => 1,
        'poster' => 'mYLOqiStMxDK3fYZFirgrMt8z5d.jpg'
    ],
    [
        'type' => 'serie',
        'name' => 'Stranger Things',
        'genre' => 'sci-fi',
        'length_in_minutes' => 60,
        'rating' => 8.7,
        'trailer_url' => 'mnd7sFt5c3A',
        'wiki_page' => 'https://en.wikipedia.org/wiki/Stranger_Things',
        'producer' => 'Matt Duffer',
        'main_cast' => 'Millie Bobby Brown, Finn Wolfhard, Winona Ryder',
        'release_date' => '2016-07-17',
        'streaming' => 1,
        'cinema' => 0,
        'poster' => '49WJfeN0moxb9IPfGn8AIqMGskD.jpg'
    ],
    [
        'type' => 'serie',
        'name' => 'Doctor Who',
        'genre' => 'sci-fi',
        'length_in_minutes' => 45,
        'rating' => 6.1,
        'trailer_url' => 'QoyV65HoRFA',
        'wiki_page' => 'https://en.wikipedia.org/wiki/Doctor_Who',
        'producer' => 'Sydney Newman',
        'main_cast' => 'Jodie Whittaker, Peter Capaldi, Matt Smith, David Tennant',
        'release_date' => '1963-11-23',
        'streaming' => 1,
        'cinema' => 1,
        'poster' => 'xinqAmYrZ1TEwowcQhgTkZVtVE0.jpg'
    ],
    
);
foreach ($media_entries as $media) {
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':id' => NULL,
        ':type' => $media['type'],
        ':name' => $media['name'],
        ':genre' => $media['genre'],
        ':length_in_minutes' => $media['length_in_minutes'],
        ':rating' => $media['rating'],
        ':trailer_url' => $media['trailer_url'],
        ':wiki_page' => $media['wiki_page'],
        ':producer' => $media['producer'],
        ':main_cast' => $media['main_cast'],
        ':release_date' => $media['release_date'],
        ':streaming' => $media['streaming'],
        ':cinema' => $media['cinema'],
        ':poster' => $media['poster']
    ]);
}
