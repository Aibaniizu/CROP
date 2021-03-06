﻿<style type='text/css'>
tr:nth-child(odd) {background: #749FA9}
tr:nth-child(even) {background: #ffffff}
tr:nth-child(1) {background: #749FA9}
</style>

<?php
include_once('navbar.php');
require_once('db-init.php');
?>
<h1>Ostoskori</h1>
<?php

if(!isset($_SESSION['liikaa'])){
$_SESSION['liikaa'] = 'tyhja';
}

//ilmoitus jos lippuja yritetty tilata liikaa
if($_SESSION['liikaa'] == 'liikaa') {
echo "<script type='text/javascript'>alert('Ostoskorisi jouduttiin tyhjentämään, koska emme voi tarjota haluamaasi määrää lippuja :(');</script>";
unset ($_SESSION['liikaa']);
}

//tarkistaa onko sessio olemassa ja onko siellä mitään
//sessiossa on taulukko, josta löytyy tapahtumaID ja lippujen määrä (id, maara)
if(isset($_SESSION['osto']) && !empty($_SESSION['osto'])) {
echo '<table>';	
    $otsikot = <<<OEND
<tr>
<td>Tapahtuman nimi</td>
<td>Aika</td>
<td>Kuvaus</td>
<td>Paikka</td>
<td>Lisätiedot</td>  
<td>Hinta per lippu</td>
<td>Lippujen määrä</td>
<td>Kokonaishinta</td>
</tr>  
OEND;
echo $otsikot;

$yht = 0;
$tulo = 0;
$kiintio = 0;
$max_maara = 0;
$tapahtumaID;
	foreach ($_SESSION['osto'] as $tilausrivi) {
	foreach ($tilausrivi AS	$kentta) {
	foreach($kentta as $arvo => $diu) {
	
		if($arvo == 'id'){

			$stmt = haeTapahtuma($db, $diu);
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			$hinta = $row['lipunhinta'];
    $lippu = <<<LIPPUEND
<tr>
<td>{$row['nimi']}</td>
<td>{$row['ajankohta']}</td>
<td>{$row['kuvaus']}</td>
<td>{$row['paikka']}</td>
<td>{$row['lisatiedot']}</td> 
<td>{$row['lipunhinta']} €</td> 
LIPPUEND;
$kiintio = $row['lippukiintio'];
$max_maara = $row['lippuostorajoitus'];
$tapahtumaID = $diu;

echo $lippu;			
		}
		else{
			$maara = $diu;
			$i = 0;
			$stmt = haeLippu($db, $tapahtumaID);
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$i++;
			}
			$jaljella = $kiintio-$i;

			$tulo = $maara*$hinta;
			echo "<td>$diu</td><td>$tulo €</td></tr>";
			$yht += $tulo;
			
			if($maara > $max_maara || $jaljella <= $maara){
			unset ($_SESSION['osto']);
			$_SESSION['liikaa'] = 'liikaa';
				header("Location: http://" . $_SERVER['HTTP_HOST']
                           . dirname($_SERVER['PHP_SELF']) . '/'
                           . "ostoskori.php");
			}
		}
	}
	}}

echo '<tr><td><b>Yhteensä</b></td><td><b>';
echo $yht;
echo ' €</b></td></tr>';
echo '</table>';
	naytaNappulat();
}
else{echo 'Ostoskorisi on tyhjä';}

//tyhjennetään sessio
if(isset($_POST['tyhjaa'])){
	unset ($_SESSION['osto']);
	header("Location: http://" . $_SERVER['HTTP_HOST']
                           . dirname($_SERVER['PHP_SELF']) . '/'
                           . "ostoskori.php");
}
//haetaan tapahtuman tiedot
function haeTapahtuma($db, $diu) {
    $sql = <<<SQLEND
    SELECT tapahtumaID, nimi, ajankohta, jarjestaja, kuvaus, paikka, lipunhinta, lippukiintio, lippuostorajoitus, lisatiedot
    FROM Tapahtuma WHERE tapahtumaID=:diu
SQLEND;
 
			$stmt = $db->prepare("$sql");
			$stmt->bindValue(':diu', "$diu", PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;    
}

//haetaan liput
function haeLippu($db, $tapahtuma) {
    $sql = <<<SQLEND
    SELECT LippuNro
    FROM Asiakkaan_lippu WHERE tapahtumaID=:tapahtuma
SQLEND;
 
			$stmt = $db->prepare("$sql");
			$stmt->bindValue(':tapahtuma', "$tapahtuma", PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;    
}


//napit näkyviin jos ostoskorissa on jotakin
function naytaNappulat(){
?>
   <form method="POST" action="ostoskori.php">
   <input type="submit" value="Tyhjennä ostoskori" name="tyhjaa">
   </form>

   <form method="POST" action="ostoskori_tilauksen_tiedot.php">
   <input type="submit" value="Siirry kassalle" name="siirry">
   </form>

<?php
}
?>