<?php
include("../include/global.php");
include("../include/sql.php");

if(isset($_GET['getKorisniciByLetters']) && isset($_GET['letters'])){
	$letters = $_GET['letters'];
	$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$res = mysql_query("SELECT id, ime_i_prezime, telefon, tretman FROM korisnici WHERE ime_i_prezime like '".$letters."%'") or die(mysql_error());
	#echo "1###select ID,countryName from ajax_countries where countryName like '".$letters."%'|";
	while($inf = mysql_fetch_array($res)){
		echo $inf["telefon"]."%".($inf["tretman"]+1)."%".$inf["id"]."###".$inf["ime_i_prezime"]."|";
	}	
}
close_db($db);
?>
