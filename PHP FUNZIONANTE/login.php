<?php include('checksignin.php');?>
<?php include('checklogin.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
		<title>Zoo - Registrati</title>
		<meta name="title" content="Zoo"/>
		<meta name="description" content="Log in"/>
		<meta name="keywords" content="zoo, tecnologie web, progetto, animali"/>
		<meta name="language" content="italian it"/>
		<meta name="author" content="Alessio Barbiero"/>
			<link href="https://fonts.googleapis.com/css?family=Fredoka One" rel="stylesheet"/>
			<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"/>
		<link rel="stylesheet" href="css/style.css"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
		<script type="text/javascript" src="script/script.js"></script>
	</head>
	<body>
		<div id="header"></div>
		<div id="breadcrumb">
			<p><a href="index.php">Home</a> &#124; Login</p>
		</div>
		<div id="content">
			<?php if(isset($error_m)):?>
				<h3 class="errorH"><?php echo $error_m; ?>
			<?php endif ?>
			<div id="loginForm">
				<form method="post" action="login.php">
					<fieldset>
						<legend>Login</legend>
						<label>Username:</label>
						<input type="text" name="user" placeholder="MarioRossi00"/><?php if(isset($error_u)): ?> <div class="error"><?php echo $error_u; ?></div><?php endif ?><br/>
						<label>Password:</label>
						<input type="password" name="password"/><?php if(isset($error_p)): ?> <div class="error"><?php echo $error_p; ?></div><?php endif ?></br>
						<input type="submit" name="log" value="Login"/>
					</fieldset>
				</form>
			</div>
			<h2>Se non sei ancora iscritto:</h2>
			<div id="signinForm">
				<form method="post" action="login.php" id="register">
					<fieldset>
						<legend>Registrati</legend>
						<label>Username:</label>
						<input type="text" name="user" placeholder="MarioRossi00" value="<?php echo $username; ?>"/>
						<?php if(isset($error_n)): ?>
							<div class="error"><?php echo $error_n; ?></div>
						<?php endif ?><br/>
						<?php if(isset($error_r_u)): ?>
							<div class="error"><?php echo $error_r_u; ?></div>
						<?php endif ?><br/>						
						<label>Password:</label>
						<input type="password" name="password"/><br/>
						<?php if(isset($pError)): ?>
							<div class="error"><?php echo $pError; ?></div>
						<?php endif ?><br/>
						<?php if(isset($error_r_p)): ?>
							<div class="error"><?php echo $error_r_p; ?></div>
						<?php endif ?><br/>
						<label>Nome:</label>
						<input type="text" name="name" placeholder="Mario"/>
						<?php if(isset($error_r_n)): ?>
							<div class="error"><?php echo $error_r_n; ?></div>
						<?php endif ?><br/>
						<label>Cognome:</label>
						<input type="text" name="surname" placeholder="Rossi"/>
						<?php if(isset($error_r_s)): ?>
							<div class="error"><?php echo $error_r_s; ?></div>
						<?php endif ?><br/>
						<label>Data di nascita:</label>
						<input type="date" name="date" min="1900-01-01" value="01-01-2000"/>
						<?php if(isset($error_r_d)): ?>
							<div class="error"><?php echo $error_r_d; ?></div>
						<?php endif ?><br/>
						<label>Email:</label>
						<input type="email" name="email" placeholder="mariorossi@gmail.com" value="<?php echo $email; ?>"/>
						<?php if(isset($error_e)): ?>
							<div class="error"><?php echo $error_e; ?></div>
						<?php endif ?><br/>
						<?php if(isset($error_r_e)): ?>
							<div class="error"><?php echo $error_r_e; ?></div>
						<?php endif ?><br/>
						<label>Ti stai iscrivendo come:</label><br/>
						<input type="radio" name="type" value="Utente" id="utente" onclick="change(this)"/> Utente generico<br/>
						<input type="radio" name="type" value="Accompagnatore" id="accompagnatore" onclick="change(this)"/> Utente accompagnatore<br/>
						<?php if(isset($error_r_t)): ?>
							<div class="error"><?php echo $error_r_t; ?></div>
						<?php endif ?><br/>
						<div id="more">
						</div>
						<div id="scuole">
						</div>
						<input type="submit" name="sign" value="Registrati"/>
					</fieldset>
				</form>	
			</div>
		</div>
		<div id="footer"></div>
		<script>
			function change(radio){
				if(radio.checked && radio.id==="accompagnatore"){
					document.getElementById("more").innerHTML="<label>Da quante persone è formato il gruppo?</label><input type='number' name='num' min='2' max='50'/><br/><label>Si tratta di un gruppo di studenti?</label><input type='radio' name='choice' value='si' id='si' onclick='change(this)'/> Sì<br/><input type='radio' name='choice' value='no' id='no' onclick='change(this)'/> No<br/>";
				}else if(radio.checked && radio.id==="utente"){
					document.getElementById("more").innerHTML="";
					document.getElementById("scuole").innerHTML="";
				}
				if(radio.checked && radio.id==="no"){
					document.getElementById("scuole").innerHTML="";
				}else if(radio.checked && radio.id==="si"){
					document.getElementById("scuole").innerHTML="<label>Inserisci il nome della classe</label><input type='text' name='class' placeholder='1A'/></br><label>Seleziona la scuola dalla lista</label><select name='scuole'><?php while($scuola = mysqli_fetch_array($scuole)){ ?><option value='<?php echo $scuola['Nome_Ist']; ?>'><?php echo $scuola['Nome_Ist'].' ('.$scuola['Citta_Ist'].')'; ?></option><?php }?></select>";
				}
			}//change
		</script>
	</body>
</html>


