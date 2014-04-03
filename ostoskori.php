<?php
include_once('navbar.php');
require_once('db-init.php');

session_start();

$vw_lkm = isset($_SESSION['vw_lkm']) ? $_SESSION['vw_lkm'] : 0;
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
   <form method="POST" action="<?php echo "{$_SERVER['PHP_SELF']}"?>">
   <input type="submit" value="Tyhjennä ostoskori" name="tyhjaa">
   </form>

   <form method="POST" action="<?php echo "{$_SERVER['PHP_SELF']}"?>">
   <input type="submit" value="Vahvista tilaus" name="vahvista">
   </form>

<?php
// h3t2-autolaskuri-sessio.php

// Pääohjelma
session_start();

$vw_lkm = isset($_SESSION['vw_lkm']) ? $_SESSION['vw_lkm'] : 0;
$opel_lkm =isset($_SESSION['opel_lkm']) ? $_SESSION['opel_lkm'] : 0;
$toyota_lkm = isset($_SESSION['toyota_lkm']) ? $_SESSION['toyota_lkm'] : 0;
$painike = isset($_POST['painike']) ? $_POST['painike'] : '';

laske_lkm($vw_lkm, $opel_lkm, $toyota_lkm, $painike);
aseta_arvot($vw_lkm, $opel_lkm, $toyota_lkm);
lomake();
nayta_tulokset($vw_lkm, $opel_lkm, $toyota_lkm);


// Alustetaan tai päivitetään autojen lukumääriä:
// Viittaukset (&) välittyvät "takaisin" kutsuvaan ohjelmalohkooon
function laske_lkm(&$vw_lkm, &$opel_lkm, &$toyota_lkm, $nappi)
{
   if (isset($nappi))
   {    //         Lisätään kertymää tai nollataan:
      if ($nappi == "VW")
      {
         $vw_lkm = $vw_lkm + 1;
      }
      elseif ($nappi == "Opel")
      {
         $opel_lkm = $opel_lkm + 1;
      }
      elseif ($nappi == "Toyota")
      {
         $toyota_lkm = $toyota_lkm + 1;
      }
      elseif ($nappi == "Nollaa") // Painettiin Nollaa-painiketta
      {
         $vw_lkm = 0;
         $opel_lkm = 0;
         $toyota_lkm = 0;
      }
   }
}

function nayta_tulokset($vw_lkm, $opel_lkm, $toyota_lkm)
{
   echo "<pre>\n";
   echo "Volkswagenit ... : $vw_lkm kpl.\n";
   echo "Opelit ......... : $opel_lkm kpl.\n";
   echo "Toyotat ........ : $toyota_lkm kpl.\n</pre>";
}

// Syöttölomake autojen laskentaan.
function lomake()
{
?>

   <form method="POST" action="<?php echo "{$_SERVER['PHP_SELF']}"?>">

   <!--
    Huomaa useat samannimiset painikkeet: Arvona välittyy
    _vain_ sen painikkeen arvo, jota painettiin!
   -->

   <input type="submit" value="VW" name="painike">
   <input type="submit" value="Opel" name="painike">
   <input type="submit" value="Toyota" name="painike">
   <input type="submit" value="Nollaa" name="painike">
   </form>
<?php
}

function do_header()
{
?>

<title>Autolaskuri</title>
<h3 style=background-color:#fed;color:#000>Autolaskuri</h3>

<?php
}


function aseta_arvot($vw_lkm, $opel_lkm, $toyota_lkm)
{
     $_SESSION['vw_lkm'] = $vw_lkm;
     $_SESSION['opel_lkm'] = $opel_lkm ;
     $_SESSION['toyota_lkm'] = $toyota_lkm;
}


?>