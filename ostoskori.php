<?php
include_once('navbar.php');
require_once('db-init.php');

session_start();

//tarkistaa onko sessio olemassa ja onko siellä mitään
if(isset($_SESSION['osto']) && !empty($_SESSION['osto'])) {
	
	//käy läpi session sisällön
	foreach ($_SESSION['osto'] as $tilausrivi) {
	foreach ($tilausrivi AS	$kentta => $arvo) {
	    echo "$kentta: $arvo <br>"
	}
	}
	
	naytaNappulat();
}

if(){

}


//napit näkyviin jos ostoskorissa on jotakin
function naytaNappulat(){
?>
   <form method="POST" action="<?php echo "{$_SERVER['PHP_SELF']}"?>">
   <input type="submit" value="Tyhjennä ostoskori" name="tyhjaa">
   </form>

   <form method="POST" action="ostoskori_tilauksen_vahvistus.php">
   <input type="submit" value="Vahvista tilaus" name="vahvista">
   </form>

<?php
}

function sessionLoppu(){
	session_destroy();
}


//GET sessiosta tilattavien lippujen tapahtumien 
//tunnukset, 
//lippujen määrä, 
//ostorajoitus, jos liikaa lippuja herjaa jotain
//vahvista tilaus -> toiseen näkymään
//					 lomake, josta näkee omat tiedot + toimitustapa, maksutapa, lisätiedot
//					 hae tilaus pvm
//					 	asiakkaan lippuun tilausnro, tapahtumaID
//					 tallenna tilaus tietokantaan
//					 ilmoita asikkaalle tilauksen onnistumisesta
// tyhjennä sessio, jos tilaus vahvistettu tai ostoskori tyhjennetty

//toiseen tiedostoon -> tiedot saaduista tilauksista tapahtuma pvm mukaan(?), graafi (y)
?>