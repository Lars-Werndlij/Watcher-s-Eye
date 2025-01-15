<?php require_once '../controllers/user.controller.php' ?>
<?php if (isset($_POST["add"])) : executeAdd(); endif; ?>
<?php $result = getData() ?>
<body class="bg-gray-100">
    <div class="mx-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
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
                                    <td class="p-2 py-3 px-6 text-left whitespace-nowrap"><input type="text" name="username" placeholder="Username"></td>
                                    <td class="p-2 py-3 px-6 text-left"><input type="text" name="email" placeholder="Email"></td>
                                    <td class="p-2 py-3 px-6 text-left"><input type="password" name="password" placeholder="Password" ></td>
                                    <td class="p-2 py-3 px-6 text-left">
                                        <select name="favorite" class="p-2 py-3 px-6 text-left">
                                            <option value="favorite">N/A</option>
                                            <option value="action">Action</option>
                                            <option value="adventure">Adventure</option>
                                            <option value="animation">Animation</option>
                                            <option value="apocalypse">Apocalypse</option>
                                            <option value="fantasy">Fantasy</option>
                                            <option value="romance">Romance</option>
                                            <option value="sci-fi">Sci-fi</option>
                                            <option value="story">Story</option>
                                            <option value="superhero">Superhero</option>
                                            <option value="thriller">Thriller</option>
                                        </select>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                    <input type="hidden" name="actionResult" id="actionResult" value="<?php echo $row['id']; ?>">
                                    <button type="submit" id="add" name="add" class="inline-block bg-red-700 text-white px-4 rounded">Add</button>
                                    </td>
                                </tr>
                            </form>
                </tbody>
            </div>
        </table>
    </div>
</body>