w<?php require_once '../controllers/media.controller.php';
    if (!isset($_SESSION["logInRank"])) {
        $_SESSION["logInRank"] = "user";
    }
    $media = getFilms(); ?>
<div class="container mx-auto p-6">
    <form method="GET" class="flex justify-center mb-6">
        <input type="text" name="name" placeholder="Search by title" class="border rounded-l-lg p-2 w-64" value="<?= isset($_GET["name"]) ? htmlspecialchars($_GET["name"]) : ""?>">
        <select name="type" class="border-t border-b border-r rounded-r-lg p-2">
            <option value="All">All</option>
            <option value="film" <?= (isset($_GET["name"]) && $_GET["name"] == 'film' ? 'selected' : '')?>> Movies </option>
            <option value="serie" <?= (isset($_GET["type"]) && $_GET["type"] == 'serie' ? 'selected' : '')?>> Series </option>
        </select>
        <button type="submit" class="bg-red-700 text-white p-2 rounded ml-2">Search</button>
    </form>
</div>

<div class="flex flex-wrap justify-center p-6">
    <?php if (isset($_POST['favorite'])) : favoriteCheck(); endif ?>
    <?php $favorites = getUserMedia(); ?>
    <?php shuffle($media); ?>
    <?php foreach ($media as $name => $row) : ?>
        <?php $find = getKeysBy($favorites, "media_id", $row['id']); ?>
        <div class="bg-white shadow-lg rounded-lg overflow-hidden w-64 m-4 transform hover:-translate-y-2 transition-transform duration-300">
            <form method="POST">
            <img src="https://image.tmdb.org/t/p/original/<?= $row['poster'] ?>" alt="<?= $row['name'] ?>" class="w-full h-80 object-cover">
            <div class="p-4">
                <h2 class="text-lg font-bold mb-2" name="<?php $row['name'] ?>"><?= $row['name'] ?></h2>
                <p class="text-gray-600"><span class="font-semibold">Duration:</span> <?= $row['length_in_minutes'] ?> minutes</p>
                <p class="text-gray-600"><span class="font-semibold">Year:</span> <?= $row['release_date'] ?></p>
                <a href="<?= $row['wiki_page'] ?>" target="_blank" class="inline-block bg-red-700 text-white px-4 py-2 mt-4 rounded">Wikipedia</a>
                <?php if (isset($_SESSION["loggedInUser"]) && $_SESSION["loggedInUser"] == true) : ?>
                    <input type="hidden" name="actionResult" id="actionResult" value="<?php echo $row['id']; ?>">
                    <button type="submit" id="favorite" name="favorite" class="inline-block bg-red-700 text-white px-4 py-2 mt-4 rounded"><?= $find == true ? '♥' : '♡'?></button>
                <?php endif; ?>
            </div>
            </form>
        </div>
    <?php endforeach; ?>
</div>