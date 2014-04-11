<?php //rekisteroityminen-tallennus.php

require_once('db-init.php');
include_once('navbar.php');
 
//muuuttujat talteen linkista
$getid = $_GET['id'];
$getfname = $_GET['etunimi'];
$getlname = $_GET['sukunimi'];
$getaddr = $_GET['osoite'];
$getpostnmb = $_GET['postinumero'];
$getpostplace = $_GET['postitoimipaikka'];
$getphone = $_GET['puhelinnumero'];
$getuid = isset($_GET['opiskelijatunnus']) ? $_GET['opiskelijatunnus'] : "";
$getcampus = isset($_GET['getcampus']) ? $_GET['getcampus'] : "";
$getpswd = $_GET['salasana'];

if (preg_match("/^[0-9]{5}$/", $getpostnmb) 
	AND preg_match("/^[a-z,A-Z,ö,ä,å,Ö,Ä,Å]+$/",$getfname) 
	AND preg_match("/^[a-z,A-Z,ö,ä,å,Ö,Ä,Å]+$/",$getlname)
	AND preg_match("/^((\+358 ?)|0)(40 ?[0-9]{3}( [0-9]{3} ?[0-9]{1}|[0-9]{3}[0-9]{1}))$/", $getphone)
	AND preg_match("/^[a-z,A-Z,ö,ä,å,Ö,Ä,Å]+$/",$getpostplace)
	AND preg_match("/^[a-z,A-Z,ö,ä,å,Ö,Ä,Å, 0-9]+$/",$getaddr)) { 
	
lisaaKantaan($db, $getid, $getfname, $getlname, $getaddr, $getpostnmb, $getpostplace, $getphone, $getuid, $getcampus, $getpswd);
} else {
	echo "<script type='text/javascript'> alert('Jotain meni pieleen. Yritä uudelleen');</script>";
	   header("Location: http://" . $_SERVER['HTTP_HOST']
                           . dirname($_SERVER['PHP_SELF']) . '/'
                           . "rekisteroityminen.php?id=".$getid."&etunimi=".$getfname."&sukunimi=".$getlname."&osoite=".$getaddr."&postinumero=".$getpostnmb."&postitoimipaikka=".$getpostplace."&puhelinnumero=".$getphone."&opiskelijatunnus=".$getuid."&kampus=".$getcampus."&errori=virhe");
	}
 
function lisaaKantaan($db, $getid, $getfname, $getlname, $getaddr, $getpostnmb, $getpostplace, $getphone, $getuid, $getcampus, $getpswd) {
    $sql = <<<SQLEND
    INSERT INTO Kayttaja (sahkoposti, etunimi, sukunimi, katuosoite, postinumero, postitoimipaikka, puhelinnumero, opiskelijatunnus, kampus, salasana, kayttajataso, tila)
    VALUES (:f1, :f2, :f3, :f4, :f5, :f6, :f7, :f8, :f9, :f10, :f11, :f12)
SQLEND;
     
   $stmt = $db->prepare("$sql");
  
   $stmt->execute(array(':f1' => $getid, ':f2' => $getfname, ':f3' => $getlname, ':f4' => $getaddr, ':f5' => $getpostnmb, ':f6' => $getpostplace, ':f7' => $getphone, ':f8' => $getuid, ':f9' => $getcampus, ':f10' => $getpswd, ':f11' => 1, ':f12' => 'aktiivinen'));

	echo "<script type='text/javascript'> alert('Lisäys onnistui! Voit nyt kirjautua sisään.');</script>";
}



?>