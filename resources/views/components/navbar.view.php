<nav class='bg-red-300 container-xl navbar'>
    <img src='../images/watchers-eye.jpg' alt='mainlogo' class='logo'>
    <a href='?name=&type=All&page=home' class='cursor-pointer navbutton'>Home</a>
    <?php if (logInCheck() === true) : ?>
        <a class='cursor-pointer navbutton' href='?page=watchlist'>Watchlist</a>
    <?php endif; ?>
    <?php if (isset($_SESSION["logInRank"]) && $_SESSION["logInRank"] == "admin") : ?>
        <a class='cursor-pointer navbutton' href='?page=admin'>Admin</a>
    <?php endif; ?>
    <a class='cursor-pointer navbutton' href='?page=login'>Sign Up</a>
</nav>
<h4 class='line'>I</h4>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<?php if (logInCheck() === true) {
    $_SESSION["createuser"] = 0;
} ?>