<?php
require_once "../admin/index.php";
?>

<body class="bg-gray-100">
    <div class="mx-auto">

        
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <tr>
                    <th class="p-2 py-3 px-6 text-left">Username</th>
                    <th class="p-2 py-3 px-6 text-left">Email</th>
                    <th class="p-2 py-3 px-6 text-left">Password</th>
                    <th class="p-2 py-3 px-6 text-left">Watchtime</th>
                    <th class="p-2 py-3 px-6 text-left">Favorite Genre</th>
                    <th class="p-2 py-3 px-6 text-left">Actions
                    <span><a href="index.php?page=admin&add_id=1" class="p-2 w-4 mr-2 text-white-600 hover:scale-110">[  +  ]</a></span></th>
                </tr>
            </thead>
            <div class="bg-white shadow-lg rounded-lg overflow-hidden w-64 m-4 transform hover:-translate-y-2 transition-transform duration-300">
                <tbody class="text-gray-600 text-sm font-light">
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="p-2 py-3 px-6 text-left whitespace-nowrap"><?php echo $row['username']; ?></td>
                                <td class="p-2 py-3 px-6 text-left"><?= $row['email']; ?></td>
                                <td class="p-2 py-3 px-6 text-left"><?php echo $_SESSION['password']; ?></td>
                                <td class="p-2 py-3 px-6 text-left"><?php echo $row['watchtime']; ?> hours</td>
                                <td class="p-2 py-3 px-6 text-left"><?php echo $row['favorite_genre']; ?></td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <form method='post'>
                                            <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" id="edit" name="edit" class="inline-block bg-red-700 text-white px-4 py-2">edit</button>
                                        </form>
                                        <a href="index.php?page=admin&delete_id=<?php echo $row['id']; ?>" class="mx-1 inline-block bg-red-700 text-white px-4 py-2">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                </tbody>
            </div>
        </table>
    </div>
</body>