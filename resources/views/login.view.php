<?php require_once("../resources/views/components/navbar.view.php"); ?>
<?php 
if (!isset($_SESSION["createuser"])) {
    $_SESSION["createuser"] = 0;
}
if (isset($_POST["email"])) {
    $_SESSION["createuser"] = 1;
}
$_SESSION["logInRank"] = "user";
?>
<?php 
require_once '../controllers/login.controller.php';
    if(isset($_POST['create']) || isset($_POST['login'])) {
        login();
    }
if (isset($_POST['creator'])) {
    $_SESSION["createuser"] = 1;
}
if (isset($_POST["username"])) {
    $user = $_POST["username"];
} else {
    $user = "";
}


if (isset($_POST["password"])) {
    $password = $_POST["password"];
} else {
    $password = "";
}


if (isset($_POST["email"])) {
    $mail = $_POST["email"];
} else {
    $mail = "";
}


if (isset($_POST["favorite"])) {
    $genre = $_POST["favorite"];
} else {
    $genre = "";
}
?>
<div class="container mx-auto p-6">
    <form method="post" class="flex justify-center mb-6" id="loginform">
        <input type="text" name="username" placeholder="Username" class="border rounded-lg p-2 w-64" value='<?php $user ?>'>
        <?php if ($_SESSION["createuser"] == 1) : ?>
            <input type='email' placeholder='Email' class="border rounded-lg p-2 w-64" name="email" value='<?php $mail ?>'> 
        <?php endif; ?>
        <input type="password" name="password" placeholder="Password" class="border rounded-lg p-2 w-64" value='<?php $password ?>'>
        <?php if ($_SESSION["createuser"] == 1) : ?> 
        <select name="favorite" class="border-t border-b border-r rounded-lg p-2" value='<?php $user ?>'>
                <option value="favorite" >Favorite genre</option>
                <option value="action" >Action</option>
                <option value="adventure" >Adventure</option>
                <option value="animation" >Animation</option>
                <option value="apocalypse" >Apocalypse</option>
                <option value="fantasy" >Fantasy</option>
                <option value="romance" >Romance</option>
                <option value="sci-fi" >Sci-fi</option>
                <option value="story" >Story</option>
                <option value="superhero" >Superhero</option>
                <option value="thriller">Thriller</option>
        </select>
        
        <input type=submit value="Create Account" class="bg-red-700 text-white p-2 rounded ml-2" name="create">
            <?php endif;
            if ($_SESSION["createuser"] == 0) : ?>
                <input type=submit value="Log in" class="bg-red-700 text-white p-2 rounded ml-2" name="login">
                <input type=submit value="No account? Create one!" class="bg-red-700 text-white p-2 rounded ml-2" name="creator">
            <?php endif; ?>
            <?php if ($_SESSION["createuser"] == 1) : ?>
                <input type=submit value="Already have an account? Log in!" class="bg-red-700 text-white p-2 rounded ml-2" name="login2">
            <?php endif; ?>
            
    </form>
</div>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<?php require_once '../resources/views/components/footer.view.php' ?>
</body>
</html>