<!-- da inserire nel file includes/setProfile.php -->
<?php
	if(isset($_SESSION['userName'])){
		$username=$_SESSION['userName'];
		$biglietti=$connessione->query("SELECT * FROM ticket where UsernameUt_T = '$username';");
	}
?>

<!-- da inserire nel file user.php -->

<?php if(isset($_SESSION['userName'])): ?>
	<h3>I tuoi biglietti</h3>
		<?php while ($biglietto = mysqli_fetch_array($biglietti)){ ?>
			<p>
				<h4>Transazione numero <?php echo $biglietto['ID_T']; ?> - spesa totale: <?php echo $biglietto['CostoTot_T']; ?> euro</h4><br/>
					<ul>
						<li>Numero biglietti interi: <?php echo $biglietto['NumInteri_T']; ?></li>
						<li>Numero biglietti bambini: <?php echo $biglietto['NumRidottiB_T']; ?></li>
						<li>Numero biglietti anziani: <?php echo $biglietto['NumRidottiA_T']; ?></li>
					</ul>
			</p>
		<?php } ?>
<?php endif;?>