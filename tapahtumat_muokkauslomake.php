<!-- Haluan muokata tätä tietuetta: $_GET['id']

// Haen sen kannasta, helppoa: 

$sql = <<<SQLEND
   SELECT tunnus, sukunimi, etunimi, email, osoite, puhnro
   FROM henkilot WHERE tunnus = $_GET['id']
SQLEND; 

// Haetaan se YKSI rivi

// Sieltä tulee $row[]-taulu

// Laitetaan row:n kentät lomakkeeseen
// katso ensimmäinen esimerkki: 


// muokkauksessa katso esimerkkiä http://student.labranet.jamk.fi/~ara/iim50300/06-2014-vko-07/osoitekirja-basic-old-fashioned/dir.php?action=show&fiilu=muokkaa.php
// vanhaa muotoa, pitää muuttaa uuteen muotoon
-->



<?php
	session_start();
	require_once('db-init.php');
	include_once('navbar.php');
	include_once('tapahtumat_muokkaa.php');
	//include_once('abook-poista.php');
	
	alustaKanta($db);
	
function alustaKanta($db) {

	$tietue = $_GET['id'];
		
	$sql = <<<SQLEND
		SELECT tapahtumaID, nimi, ajankohta, jarjestaja, kuvaus, paikka, lipunhinta, lippukiintio, lippuostorajoitus, kuva, lisatiedot
		FROM Tapahtuma WHERE tapahtumaID = :tapahtumaID;
SQLEND;
	
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':tapahtumaID', $tietue, PDO::PARAM_STR);
	$stmt->execute();
	
	teeLomake($stmt);
}
	
	

function teeLomake($stmt) {

$id = $_GET['id'];

$row = $stmt->fetch(PDO::FETCH_ASSOC);
$forms = <<<FORMSEND
<form method='post' enctype='multipart/form-data' action='tapahtumat_muokkauslomake.php?id=$id'>
<table border='0' cellpadding='5'>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Nimi</td>
  <td><input type='text' name='nimi' size='30' value='{$row['nimi']}'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Ajankohta</td>
  <td><input type='text' name='ajankohta' size='30' value='{$row['ajankohta']}'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Järjestäjä</td>
  <td><input type='text' name='jarjestaja' size='30' value='{$row['jarjestaja']}'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Kuvaus</td>
  <td><input type='text' name='kuvaus' size='30' value='{$row['kuvaus']}'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Paikka</td>
  <td><input type='text' name='paikka' size='30' value='{$row['paikka']}'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Hinta</td>
  <td><input type='text' name='lipunhinta' size='30' value='{$row['lipunhinta']}'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Kiintiö</td>
  <td><input type='text' name='lippukiintio' size='30' value='{$row['lippukiintio']}'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Ostorajoitus</td>
  <td><input type='text' name='lippuostorajoitus' size='30' value='{$row['lippuostorajoitus']}'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Lisätiedot</td>
  <td><input type='text' name='lisatiedot' size='30' value='{$row['lisatiedot']}'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Kuva</td>
  <td><img src='lataaKuva.php?id=$id' ></td>
  <td><input type='file' name='kuva'><td>
  Huom! Kuvan tulee olla 150x150px
</tr>
</table>
<input type='submit' name='muokkaa' value='Tallenna'><br>
<input type='submit' name='poista' value='Poista' onclick="javascript: return confirm('Hyväksy poisto?')">
</form>


FORMSEND;

echo $forms;

}

?>