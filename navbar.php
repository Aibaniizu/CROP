<form method='get' action='tapahtumat_listaa.php'>
	[<a href='tapahtumat_listaa.php'>Listaa tapahtumat</a>]
	<?php  if($_SESSION['taso'] >= 2) { echo "[<a href='tapahtumat_tyhjalomake.php'>Lisää tapahtuma</a>]";}?>

	<link rel="stylesheet" type="text/css" href="style.css">
	
	Valitse käyttäjätaso: 
	<select name="tasot">
		<option <?php if($_SESSION['taso'] == 0) {echo "selected";} ?> value="0">Vierailija</option>
		<option <?php if($_SESSION['taso'] == 1) {echo "selected";} ?> value="1">Peruskäyttäjä</option>
		<option <?php if($_SESSION['taso'] == 2) {echo "selected";} ?> value="2">Ylläpitäjä</option>
		<option <?php if($_SESSION['taso'] == 3) {echo "selected";} ?> value="3">Admin</option>
	</select>
	<input type="submit" name="valitse" value="Valitse">
</form>
