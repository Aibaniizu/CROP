<style type='text/css'> 
.header {width:1024px;}
.haku {float:right; margin-right: 20px;}
</style>
<div class="header">

<form method='get' action='profiili_listaus.php'>

[ <a href='etusivu.php'> Etusivu </a> ]
[ <a href='tapahtumat_listaa.php'> Tapahtumat </a> ]
[ <a href=''> Yhteystiedot </a> ]
[ <a href=''> Ohjeet </a> ]

<?php 
session_start();
if (isset($_SESSION['tunnus'])) {
echo "[ <a href=''> Ostoskori </a> ]";
echo "[ <a href='profiilin_tiedot.php'> Oma profiili ".$_SESSION['tunnus'].")</a> ] ";
} ?>

<div class="haku" >Haku:<input type='text' size='30' name='hakuehto' value=''>
<input type='submit' name='action' value='Hae'></div>
</form>

<?php

$kayttaja =isset($_SESSION['tunnus']) ? $_SESSION['tunnus'] : "";

if (!isset($_SESSION['tunnus'])) {
  kirjaudupalkki();
} else {
  uloskirjaudunappi();
}

function kirjaudupalkki() {
?>
<form method="post" action="kirjaudu_sisaan.php"
style=color:#000;background-color:#eeeeee>
Tunnus:<input type="text" name="tunnus" size="30">
Salasana:<input type="text" name="salasana" size="30">
<input type='submit' name='action' value='Kirjaudu'>
</form> 
<?php 
}

function uloskirjaudunappi() { 
?>

<form method="post" action="kirjaudu_ulos.php"
style=color:#000;background-color:#eeeeee>
<input type='submit' name='action' value='Kirjaudu ulos'>
</form> 
<?php } ?>
<div>