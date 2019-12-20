<div id="containerHeader">
<div id="header">
    <div id="title">
        <a href="index.php"><h3>Zoo Creola</h3></a>
        <!--<a href="#" id="menuBtn" class="fa fa-bars menuControl" title="menu"></a>-->            
    </div>
    <ul>
		<!--<li><a href="#" id="closeBtn" class="fa fa-times-circle menuControl" title="close menu"></a></li>--->
        <li><a href="index.php" <?php if (basename($_SERVER['PHP_SELF']) == "index.php") { echo 'id="current"'; } ?>>Home</a></li>
        <li><a href="history.php" <?php if (basename($_SERVER['PHP_SELF']) == "history.php") { echo 'id="current"'; } ?>>Storia</a></li>
        <li><a href="animals.php" <?php if (basename($_SERVER['PHP_SELF']) == "animals.php") { echo 'id="current"'; } ?>>Animali</a></li>
        <li><a href="activities.php" <?php if (basename($_SERVER['PHP_SELF']) == "activities.php") { echo 'id="current"'; } ?>>Attivit&agrave;</a></li>
        <li><a href="contacts.php" <?php if (basename($_SERVER['PHP_SELF']) == "contacts.php") { echo 'id="current"'; } ?>>Contatti</a></li>
        <li><a href="maps.php">Come raggiungerci</a></li>
        <li><a href="login.php" <?php if (basename($_SERVER['PHP_SELF']) == "login.php") { echo 'id="current"'; } ?>>Log In</a></li>
    </ul>
</div>
</div>