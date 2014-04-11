<style type='text/css'>
tr:nth-child(odd) {background: #AABBBF}
tr:nth-child(even) {background: #D9E2E4}
tr:nth-child(1) {background: #AABBBF}
.content {width:800px; margin:0 auto;}
.btn {margin-top:10px;}
.tieto {width:150px;}
</style>

<?php
//session_start();


include_once('navbar.php');
require_once('db-init.php');

if ($_SESSION['kirjautunut'] !== true) {
		header("Location: http://" . $_SERVER['HTTP_HOST']
                    . dirname($_SERVER['PHP_SELF']) . '/'
                    . "etusivu.php");

}

$msg = isset($_COOKIE['succeed']) ? $_COOKIE['succeed'] : '';

$getid = $_SESSION['tunnus'];
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
<div class="content">
<!--<h3>Hei <?php echo $row['etunimi'] ?>! </h3>-->
<h3>Omat tiedot:</h3>

<form method='get' action='profiilin_ohjaussivu.php'> 
<table border='0' cellpadding='5'>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Sähköposti (tunnus):</td>
  <td class='tieto'><?php echo $row['sahkoposti'] ?></td>
  <input type='hidden' name='id' size='30' value='<?php echo $row['sahkoposti'] ?>'>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Sukunimi:</td>
  <td class='tieto'><?php echo $row['sukunimi'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Etunimi:</td>
  <td class='tieto'><?php echo $row['etunimi'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Katuosoite:</td>
  <td class='tieto'><?php echo $row['katuosoite'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Postinumero:</td>
  <td class='tieto'><?php echo $row['postinumero'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Postitoimipaikka:</td>
  <td class='tieto'><?php echo $row['postitoimipaikka'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Puhelinnumero:</td>
  <td class='tieto'><?php echo $row['puhelinnumero'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Opiskelijatunnus:</td>
  <td class='tieto'><?php echo $row['opiskelijatunnus'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Kampus:</td>
  <td class='tieto'> <?php echo $row['kampus'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Lisätiedot:</td>
  <td class='tieto'><?php echo $row['lisatiedot'] ?></td>
</tr>
</table>
<input type='submit' name='action' value='Muokkaa tietoja' class='btn'>
<input type='submit' name='action' value='Katso tilaushistoria' class='btn'><br>
</form>
</div>
