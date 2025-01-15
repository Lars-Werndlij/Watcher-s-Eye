<?php require_once "../controllers/watchlist.controller.php"; ?>
    <div class="container mx-auto p-6">
        <form method="POST" class="flex justify-center mb-6" name="watchlistbutton">
            <button name="watch" href="?page=watchlist" type="submit" class="bg-red-700 text-white p-2 rounded ml-2">Watch</button>
            <button name="watching" href="?page=watchlist" type="submit" class="bg-red-700 text-white p-2 rounded ml-2">Watching</button>
            <button name="watched" href="?page=watchlist" type="submit" class="bg-red-700 text-white p-2 rounded ml-2">Watched</button>
        </form>
    </div>
<?php 

$status = "";
    if (isset($_POST["watch"])) {
        $status = "nog niet gekeken";
    } else if (isset($_POST["watching"])) {
        $status = "aan het kijken";
    } else if (isset($_POST["watched"])) {
        $status = "gekeken";
    } 
if (isset($status)) : ?>
<?php $userMedia = connectUserMediaDB($status);
for ($i = 0; $i < count($userMedia); $i++) : ?>
<?php $media = getMedia($userMedia[$i]); ?>
<?php foreach ($media as $name => $row) : ?>
        <div class="bg-white shadow-lg rounded-lg overflow-hidden w-64 m-4 transform hover:-translate-y-2 transition-transform duration-300">
            <form method="POST">
            <button name="watchcard" href="?page=watchlist" type="submit" class="bg-white-700 text-black p-2 rounded ml-2">Watch</button>
            <button name="watchingcard" href="?page=watchlist" type="submit" class="bg-white-700 text-black p-2 rounded ml-2">Watching</button>
            <button name="watchedcard" href="?page=watchlist" type="submit" class="bg-white-700 text-black p-2 rounded ml-2">Watched</button>
            <img src="https://image.tmdb.org/t/p/original/<?= $row['poster'] ?>" alt="<?= $row['name'] ?>" class="w-full h-80 object-cover">
            <div class="p-4">
                <h2 class="text-lg font-bold mb-2" name="<?php $row['name'] ?>"><?= $row['name'] ?></h2>
                <p class="text-gray-600"><span class="font-semibold">Duration:</span> <?= $row['length_in_minutes'] ?> minutes</p>
                <p class="text-gray-600"><span class="font-semibold">Year:</span> <?= $row['release_date'] ?></p>
                <p class="text-gray-600"><span class="font-semibold">Genre:</span> <?= $row['genre'] ?></p>
                <p class="text-gray-600"><span class="font-semibold">Rating:</span> <?= $row['rating'] ?>/10</p>
                <p class="text-gray-600"><span class="font-semibold">Producer:</span> <?= $row['producer'] ?></p>
                <p class="text-gray-600"><span class="font-semibold">Main Cast:</span> <?= $row['main_cast'] ?></p>
                <p class="text-gray-600"><span class="font-semibold">Location:</span> <?php
                if ($row["streaming"] == 1 && $row["cinema"] == 0) {
                    echo "On Streaming Services";
                } else if ($row["streaming"] == 0 && $row["cinema"] == 1) {
                    echo "In Cinema";
                } else if ($row["streaming"] == 1 && $row["cinema"] == 1) {
                    echo "In Cinema and On Streaming Services";
                }
                
                ?></p>
                <input type="hidden" name="idwatchcard" id="idwatchcard" value="<?php echo $row['id']; ?>">
                <a href="<?= $row['wiki_page'] ?>" target="_blank" class="inline-block bg-red-700 text-white px-4 py-2 mt-4 rounded">Wikipedia</a>
                <a href="<?= "https://www.youtube.com/watch?v=" . $row['trailer_url'] ?>" target="_blank" class="inline-block bg-red-700 text-white px-4 py-2 mt-4 rounded">Trailer</a>
            </div>
            </form>
        </div>
        <?php endforeach; ?>
</div>
<?php endfor;
endif;
if (isset($_POST["watchcard"])) {
    editWatchStatus($_POST["idwatchcard"], 'nog niet gekeken');
} else if (isset($_POST["watchingcard"])) {
    editWatchStatus($_POST["idwatchcard"], 'aan het kijken');
} else if (isset($_POST["watchedcard"])) {
    editWatchStatus($_POST["idwatchcard"], 'gekeken');
}
?>