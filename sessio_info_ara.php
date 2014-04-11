$ruoka[] = "Salaatti"; //0
$ruoka[] = "Pata"; //1
$ruoka[] = "kaali"; //2



if lisaakoriin {
   $_SESSION['kori'][] = array("id" => id, "maara" => maara);
}

foreach ($_SESSION['kori'] as $tilausrivi) {
	foreach ($tilausrivi AS	$kentta => $arvo) {
	    echo "$kentta: $arvo <br>"
	}
}