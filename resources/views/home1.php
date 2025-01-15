<?php 
require_once '../controllers/media.controller.php';
?>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="../resources/css/app.css">
<?php $films = getFilms('streaming'); ?>
<?php 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<div class="container mx-auto p-6">
    <form method="GET" class="flex justify-center mb-6">
        <input type="text" name="name" placeholder="Search by title" class="border rounded-l-lg p-2 w-64" value="<?= htmlspecialchars($filterTitle)?>">
        <select name="type" class="border-t border-b border-r rounded-r-lg p-2">
            <option value="All">All</option>
            <option <?= 'value="film" ' . ($filterTitle == 'film' ? 'selected' : '') . '>Movies '; ?></option>
            <option <?= 'value="serie" ' . ($filterType == 'serie' ? 'selected' : '') . '>Series '?></option>
        </select>
        <button type="submit" class="bg-red-700 text-white p-2 rounded ml-2">Filter</button>
    </form>
</div>
<?php

echo '<div class="flex flex-wrap justify-center p-6">';
if ($result->num_rows == 0) {
    echo '<h1 class="flex text-6xl text-center"> no results </h1>';
}
if ($result->num_rows > 0) : ?>
    <body class="bg-gray-100">
    <div class="flex flex-wrap justify-center p-6">

    <?php while ($row = $result->fetch_assoc()) : ?>
        <div class="bg-white shadow-lg rounded-lg overflow-hidden w-64 m-4 transform hover:-translate-y-2 transition-transform duration-300">
        <img <?php echo 'src="https://image.tmdb.org/t/p/original/' . $row['poster'] . '" alt="' . $row['name'] . '" class="w-full h-80 object-cover"> ';?>
        <div class="p-4">
        <h2 <?php echo 'class="text-lg font-bold mb-2">' . $row['name'] . '</h2>';?>
        <p <?php echo 'class="text-gray-600"><span class="font-semibold">Duration:</span> ' . $row['length_in_minutes'] . ' minutes</p>' ?>
        <p <?php echo 'class="text-gray-600"><span class="font-semibold">Year:</span> ' . $row['release_date'] . '</p>' ?>
        <a <?php echo 'href="' . $row['wiki_page'] . '" target="_blank" class="inline-block bg-red-700 text-white px-4 py-2 mt-4 rounded">Wikipedia</a>' ?>
        <a <?php echo 'href=" " class="inline-block bg-red-700 text-white px-4 py-2 mt-4 rounded">+</a>' ?>
        </div>
        </div>
    <?php endwhile; ?>

    </div>
    </body>
    </html>
<?php endif;
$conn->close();

?>