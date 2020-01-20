<?php include('includes/checkgroup.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
		<title>Zoo - Aggiungi Gruppo</title>
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
			<p><a href="index.php">Home</a> &#124; Aggiungi Gruppo</p>
		</div>
		<div id="content">
			<?php if(isset($done)): ?>
				<div class="done"><h2>
			<?php echo $done; ?>
				</h2></div>
			<?php endif ?></br> 
			<form method="post" id="addgroupForm" action="addgroup.php">
				<fieldset>
					<legend>Registra un nuovo gruppo</legend>
					<label>Da quante persone è formato il gruppo?</label>
					<input type="number" name="num" min="10" max="60"/>
					<?php if(isset($error_g_n)): ?>
						<div class="error">
					<?php echo $error_g_n; ?>
						</div>
					<?php endif ?><br/>
					<label>Si tratta di un gruppo di studenti?</label><br/>
					<input type="radio" name="choice" value="si" id="si" onclick="change(this)"/> Sì<br/>
					<input type="radio" name="choice" value="no" id="no" onclick="change(this)"/> No 
					<?php if(isset($error_g_c)): ?>
						<div class="error">
					<?php echo $error_g_c; ?>
						</div>
					<?php endif ?><br/>
					<div id="scuole">
					</div>
					<input type="submit" name="add" value="Aggiungi"/>
				</fieldset>
			</form>
		</div>
		<div id="footer"></div>
		<script>
			function change(radio){
				if(radio.checked && radio.id==="no"){
					document.getElementById("scuole").innerHTML="";
				}else if(radio.checked && radio.id==="si"){
					document.getElementById("scuole").innerHTML="<label>Inserisci il nome della classe</label><input type='text' name='class' placeholder='1A'/><?php if(isset($error_g_cl)): ?><div class='error'><?php echo $error_g_cl; ?></div><?php endif ?><br/><label>Seleziona l'istituto dalla lista</label><select name='scuole'><option value='---'>- - -</option><?php while($scuola = mysqli_fetch_array($scuole)){ ?><option value='<?php echo $scuola['Nome_Ist']; ?>'><?php echo $scuola['Nome_Ist'].' ('.$scuola['Citta_Ist'].')'; ?></option><?php }?></select><h4>Oppure aggiungine uno nuovo</h4><br/><?php if(isset($error_n)): ?><div class='error'><?php echo $error_n; ?></div><?php endif ?><br/><label>Nome istituto</label><input type='text' name='newS' placeholder='Istituto Da Vinci'/><br/><label>Citt&agrave; istituto</label><br/><select name='citta'><option value='---'>- - -</option><option value='ag'>Agrigento</option><option value='al'>Alessandria</option><option value='an'>Ancona</option><option value='ao'>Aosta</option><option value='ar'>Arezzo</option><option value='ap'>Ascoli Piceno</option><option value='at'>Asti</option><option value='av'>Avellino</option><option value='ba'>Bari</option><option value='bt'>Barletta-Andria-Trani</option><option value='bl'>Belluno</option><option value='bn'>Benevento</option><option value='bg'>Bergamo</option><option value='bi'>Biella</option><option value='bo'>Bologna</option><option value='bz'>Bolzano</option><option value='bs'>Brescia</option><option value='br'>Brindisi</option><option value='ca'>Cagliari</option><option value='cl'>Caltanissetta</option><option value='cb'>Campobasso</option><option value='ci'>Carbonia-iglesias</option><option value='ce'>Caserta</option><option value='ct'>Catania</option><option value='cz'>Catanzaro</option><option value='ch'>Chieti</option><option value='co'>Como</option><option value='cs'>Cosenza</option><option value='cr'>Cremona</option><option value='kr'>Crotone</option><option value='cn'>Cuneo</option><option value='en'>Enna</option><option value='fm'>Fermo</option><option value='fe'>Ferrara</option><option value='fi'>Firenze</option><option value='fg'>Foggia</option><option value='fc'>Forl&igrave;-Cesena</option><option value='fr'>Frosinone</option><option value='ge'>Genova</option><option value='go'>Gorizia</option><option value='gr'>Grosseto</option><option value='im'>Imperia</option><option value='is'>Isernia</option><option value='sp'>La spezia</option><option value='aq'>L'aquila</option><option value='lt'>Latina</option><option value='le'>Lecce</option><option value='lc'>Lecco</option><option value='li'>Livorno</option><option value='lo'>Lodi</option><option value='lu'>Lucca</option><option value='mc'>Macerata</option><option value='mn'>Mantova</option><option value='ms'>Massa-Carrara</option><option value='mt'>Matera</option><option value='vs'>Medio Campidano</option><option value='me'>Messina</option><option value='mi'>Milano</option><option value='mo'>Modena</option><option value='mb'>Monza e Brianza</option><option value='na'>Napoli</option><option value='no'>Novara</option><option value='nu'>Nuoro</option><option value='og'>Ogliastra</option><option value='ot'>Olbia-Tempio</option><option value='or'>Oristano</option><option value='pd'>Padova</option><option value='pa'>Palermo</option><option value='pr'>Parma</option><option value='pv'>Pavia</option><option value='pg'>Perugia</option><option value='pu'>Pesaro e Urbino</option><option value='pe'>Pescara</option><option value='pc'>Piacenza</option><option value='pi'>Pisa</option><option value='pt'>Pistoia</option><option value='pn'>Pordenone</option><option value='pz'>Potenza</option><option value='po'>Prato</option><option value='rg'>Ragusa</option><option value='ra'>Ravenna</option><option value='rc'>Reggio Calabria</option><option value='re'>Reggio Emilia</option><option value='ri'>Rieti</option><option value='rn'>Rimini</option><option value='rm'>Roma</option><option value='ro'>Rovigo</option><option value='sa'>Salerno</option><option value='ss'>Sassari</option><option value='sv'>Savona</option><option value='si'>Siena</option><option value='sr'>Siracusa</option><option value='so'>Sondrio</option><option value='ta'>Taranto</option><option value='te'>Teramo</option><option value='tr'>Terni</option><option value='to'>Torino</option><option value='tp'>Trapani</option><option value='tn'>Trento</option><option value='tv'>Treviso</option><option value='ts'>Trieste</option><option value='ud'>Udine</option><option value='va'>Varese</option><option value='ve'>Venezia</option><option value='vb'>Verbano-Cusio-Ossola</option><option value='vc'>Vercelli</option><option value='vr'>Verona</option><option value='vv'>Vibo valentia</option><option value='vi'>Vicenza</option><option value='vt'>Viterbo</option></select><br/><label>Indirizzo istituto</label><input type='text' name='ind' placeholder='via Roma'/>";
				}
			}//change
		</script>
	</body>
</html>