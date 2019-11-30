<div id="header">
	<div id="title">
		<a href="index.php"><img class="logo" src="./images/logo.png" alt="logo dello zoo"/></a>
		<h1>Zoo Creola</h1>
		<a href="#" id="menuBtn" class="fa fa-bars menuControl" title="menu"></a>
	</div>
	<div id="navbar">
		<a href="#" id="closeBtn" class="fa fa-times-circle menuControl" title="close menu"></a>
		<a href="index.php" <?php if (basename($_SERVER['PHP_SELF']) == "index.php") { echo 'id="current"'; } ?>>Home</a>
		<a href="history.php" <?php if (basename($_SERVER['PHP_SELF']) == "history.php") { echo 'id="current"'; } ?>>Storia</a>
		<a href="animals.php" <?php if (basename($_SERVER['PHP_SELF']) == "animals.php") { echo 'id="current"'; } ?>>Animali</a>
		<a href="activities.php" <?php if (basename($_SERVER['PHP_SELF']) == "activities.php") { echo 'id="current"'; } ?>>Attivit&agrave;</a>
		<a href="contacts.php" <?php if (basename($_SERVER['PHP_SELF']) == "contacts.php") { echo 'id="current"'; } ?>>Contatti</a>
		<a href="login.php" <?php if (basename($_SERVER['PHP_SELF']) == "login.php") { echo 'id="current"'; } ?>>Log In</a>
	</div>
</div>