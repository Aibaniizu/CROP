<style type='text/css'>
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

//tarkistaa onko sessio olemassa ja onko siellä mitään
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


	foreach ($_SESSION['osto'] as $tilausrivi) {
	foreach ($tilausrivi AS	$kentta) {
	foreach($kentta as $arvo => $diu) {
	    //echo "diu $arvo: $diu <br>";
		
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
<td>{$row['lipunhinta']}</td> 
LIPPUEND;

//<td>{$row['lippukiintio']}</td>
echo $lippu;			
		}
		else{
			$maara = $diu;
			$tulo = $maara*$hinta;
			echo "<td>$diu</td><td>$tulo</td></tr>";
			
		}
	}
	}}
echo '</table>';
	naytaNappulat();
}

if(isset($_POST['tyhjaa'])){
	unset ($_SESSION['osto']);
	header("Location: http://" . $_SERVER['HTTP_HOST']
                           . dirname($_SERVER['PHP_SELF']) . '/'
                           . "ostoskori.php");
}

function haeTapahtuma($db, $diu) {
    $sql = <<<SQLEND
    SELECT tapahtumaID, nimi, ajankohta, jarjestaja, kuvaus, paikka, lipunhinta, lippukiintio, lisatiedot
    FROM Tapahtuma WHERE tapahtumaID=:diu
SQLEND;
 
			$stmt = $db->prepare("$sql");
			$stmt->bindValue(':diu', "$diu", PDO::PARAM_STR);
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



//GET sessiosta tilattavien lippujen tapahtumien 
//tunnukset, 
//lippujen määrä, 
//(ostorajoitus, jos liikaa lippuja herjaa jotain) jostain pitää tarkistaa riittääkö lippuja

//					 ilmoita asikkaalle tilauksen onnistumisesta
// tyhjennä sessio, jos tilaus vahvistettu tai ostoskori tyhjennetty

//toiseen tiedostoon -> tiedot saaduista tilauksista tapahtuma pvm mukaan(?), graafi (y)

?>