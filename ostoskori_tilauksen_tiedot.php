<?php
include_once('navbar.php');
require_once('db-init.php');

session_start();

//tarkistaa onko sessio olemassa ja onko siellä mitään
if(isset($_SESSION['osto']) && !empty($_SESSION['osto'])) {
	
	//käy läpi session sisällön
	foreach ($_SESSION['osto'] as $tilausrivi) {
	foreach ($tilausrivi AS	$kentta => $arvo) {
	    echo "$kentta: $arvo <br>";
	}
	}
}





$getid = 'user@jamk.fi';
$stmt = haeHenkiloKannasta ($db, $getid);
$row=$stmt->fetch(PDO::FETCH_ASSOC);

function haeHenkiloKannasta($db, $getid) {
    $sql = <<<SQLEND
    SELECT sahkoposti, etunimi, sukunimi, katuosoite, postinumero, postitoimipaikka, puhelinnumero, opiskelijatunnus, kampus, lisatiedot
    FROM Kayttaja WHERE sahkoposti=:getid
SQLEND;
 
   $stmt = $db->prepare("$sql");
   $stmt->bindValue(':getid', "$getid", PDO::PARAM_STR);
   $stmt->execute();
   return $stmt;    
}

?>
<h2>Tilaajan tiedot </h2>
<p>Tarkistathan tietojesi oikeellisuuden ennen tilauksen loppuun viemistä.</p>

<table border='0' cellpadding='5'>
<tr valign='top'>
  <td align='right' bgcolor='#BEDBE2'>Sähköposti (tunnus)</td>
  <td><?php echo $row['sahkoposti'] ?></td>
  <input type='hidden' name='id' size='30' value='<?php echo $row['sahkoposti'] ?>'>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#BEDBE2'>Sukunimi</td>
  <td><?php echo $row['sukunimi'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#BEDBE2'>Etunimi</td>
  <td><?php echo $row['etunimi'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#BEDBE2'>Katuosoite</td>
  <td><?php echo $row['katuosoite'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#BEDBE2'>Postinumero</td>
  <td><?php echo $row['postinumero'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#BEDBE2'>Postitoimipaikka</td>
  <td><?php echo $row['postitoimipaikka'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#BEDBE2'>Puhelinnumero</td>
  <td><?php echo $row['puhelinnumero'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#BEDBE2'>Opiskelijatunnus</td>
  <td><?php echo $row['opiskelijatunnus'] ?></td>
</tr>
</table>

<form method="POST" action="ostoskori_tilauksen_vahvistus.php">

<select name="toimitustapa" size="1">
  <option selected value="ei valittu">
                 Valitse toimitustapa</option>
  <option value="posti">Posti</option>
  <option value="nouto toimistolta">Nouto toimistolta</option>
  <option value="nouto tapahtumapaikalta">Nouto ovelta/tapahtumapaikalta</option>
</select>
<br>
<select name="maksutapa" size="1">
  <option selected value="ei valittu">
                 Valitse maksutapa</option>
  <option value="käteinen">Käteinen</option>
  <option value="tilisiirto">Tilisiirto</option>
  <option value="verkkopankki">Verkkopankki</option>
  <option value="luottokortti">Luottokortti</option>
</select>
<br>
Lisätietoja tilaukseen liittyen<br>
<textarea name="lisatiedot" cols="50" rows="3"></textarea>
<br>
<input type="submit" value="Vahvista tilaus" name="vahvista">
</form>

   <form method="POST" action="ostoskori.php">
   <input type="submit" value="Peruuta" name="peruuta">
   </form>



<?php


//					 lomake, josta näkee omat tiedot + toimitustapa, maksutapa, lisätiedot
//					 hae tilaus pvm
//					 
//					 ->tallenna tilaus tietokantaan
//						->asiakkaan lippuun tilausnro, tapahtumaID

//toiseen tiedostoon -> tiedot saaduista tilauksista tapahtuma pvm mukaan(?), graafi (y)
?>