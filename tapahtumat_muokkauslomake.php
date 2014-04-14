<?php
	require_once('db-init.php');
	include_once('navbar.php');
	include_once('navbar_tapahtumat.php');
	include_once('tapahtumat_muokkaa.php');
	
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
  <td align='right' bgcolor='#749FA9'>Nimi</td>
  <td><input type='text' name='nimi' size='30' value='{$row['nimi']}' required></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Ajankohta</td>
  <td><input type='text' name='ajankohta' size='30' value='{$row['ajankohta']}' required></td>
  Anna päiväys muodossa vvvv-kk-pp
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Järjestäjä</td>
  <td><input type='text' name='jarjestaja' size='30' value='{$row['jarjestaja']}' required></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Kuvaus</td>
  <td><input type='text' name='kuvaus' size='30' value='{$row['kuvaus']}' required></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Paikka</td>
  <td><input type='text' name='paikka' size='30' value='{$row['paikka']}' required></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Hinta</td>
  <td><input type='text' name='lipunhinta' size='30' value='{$row['lipunhinta']}' required></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Kiintiö</td>
  <td><input type='text' name='lippukiintio' size='30' value='{$row['lippukiintio']}' required></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Ostorajoitus</td>
  <td><input type='text' name='lippuostorajoitus' size='30' value='{$row['lippuostorajoitus']}' required></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Lisätiedot</td>
  <td><input type='text' name='lisatiedot' size='30' value='{$row['lisatiedot']}'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Kuva</td>
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