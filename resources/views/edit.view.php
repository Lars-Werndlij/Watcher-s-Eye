<?php require_once '../controllers/user.controller.php' ?>
<?php if (isset($_POST["edit"])) : executeEdit(); endif; ?>
<?php $result = getDataEdit($_GET["id"]) ?>
<body class="bg-gray-100">
    <div class="mx-auto">
        <table class="min-w-full bg-white-300 shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <tr>
                    <th class="p-2 py-3 px-6 text-left">Username</th>
                    <th class="p-2 py-3 px-6 text-left">Email</th>
                    <th class="p-2 py-3 px-6 text-left">Password</th>
                    <th class="p-2 py-3 px-6 text-left">Favorite Genre</th>
                    <th class="p-2 py-3 px-6 text-left">Submit</th>
                </tr>
            </thead>
            <div class="bg-white shadow-lg rounded-lg overflow-hidden w-64 m-4 transform hover:-translate-y-2 transition-transform duration-300">
                <tbody class="text-gray-600 text-sm font-light">
                            <form method="post" id="loginform">
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="p-2 py-3 px-6 text-left whitespace-nowrap"><input type="text" name="username" placeholder="Username" value="<?= $result['username']; ?>"></td>
                                    <td class="p-2 py-3 px-6 text-left"><input type="text" name="email" placeholder="Email" value="<?= $result['email']; ?>"></td>
                                    <td class="p-2 py-3 px-6 text-left"><input type="password" name="password" placeholder="Password" value="**********"></td>
                                    <td class="p-2 py-3 px-6 text-left">
                                        <select name="favorite" class="p-2 py-3 px-6 text-left">
                                            <option value="favorite" <?= $result["favorite_genre"] == "favorite" ? "selected" : "" ?>>N/A</option>
                                            <option value="action" <?= $result["favorite_genre"] == "action" ? "selected" : "" ?>>Action</option>
                                            <option value="adventure" <?= $result["favorite_genre"] == "adventure" ? "selected" : "" ?>>Adventure</option>
                                            <option value="animation" <?= $result["favorite_genre"] == "animation" ? "selected" : "" ?>>Animation</option>
                                            <option value="apocalypse" <?= $result["favorite_genre"] == "apocalypse" ? "selected" : "" ?>>Apocalypse</option>
                                            <option value="fantasy" <?= $result["favorite_genre"] == "fantasy" ? "selected" : "" ?>>Fantasy</option>
                                            <option value="romance" <?= $result["favorite_genre"] == "romance" ? "selected" : "" ?>>Romance</option>
                                            <option value="sci-fi" <?= $result["favorite_genre"] == "sci-fi" ? "selected" : "" ?>>Sci-fi</option>
                                            <option value="story" <?= $result["favorite_genre"] == "story" ? "selected" : "" ?>>Story</option>
                                            <option value="superhero" <?= $result["favorite_genre"] == "superhero" ? "selected" : "" ?>>Superhero</option>
                                            <option value="thriller" <?= $result["favorite_genre"] == "thriller" ? "selected" : "" ?>>Thriller</option>
                                        </select>
                                    </td>
                                    
                                    <td class="py-3 px-6 text-center">
                                    <input type="hidden" name="edit_id" value="<?= $result['id']; ?>">
                                    <button type="submit" id="edit" name="edit" class="inline-block bg-red-700 text-white px-4 rounded">edit</button>
                                    </td>
                                </tr>
                            </form>
                </tbody>
            </div>
        </table>
    </div>
</body>