<?php
include_once('navbar.php');
require_once('db-init.php');
?>
<h1>Tilauksen vahvistus</h1>
<?php
// if blah blah
echo "Tilauksenne on vastaanotettu.";
echo "Tilauksen käsittelyssä tapahtui ongelma.";
/*
if(){
$_SESSION['vw_lkm'] = $vw_lkm;
}
*/

//GET sessiosta tilattavien lippujen tapahtumien 
//tunnukset, 
//lippujen määrä, 
//ostorajoitus, jos liikaa lippuja herjaa jotain
//vahvista tilaus -> toiseen näkymään
//					 tallenna tilaus tietokantaan
//					 ilmoita asikkaalle tilauksen onnistumisesta
// tyhjennä sessio, jos tilaus vahvistettu tai ostoskori tyhjennetty

//toiseen tiedostoon -> tiedot saaduista tilauksista tapahtuma pvm mukaan(?), graafi (y)

?>