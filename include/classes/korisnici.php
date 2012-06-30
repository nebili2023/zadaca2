<?php
class korisnik
{
	var $ime_i_prezime;
	var $telefon;
	var $tretman;
	

	
	function getAllDan($dan)
	{
		$sql = "SELECT k.ime_i_prezime, k.telefon, k.tretman, t.termin, t.krevet 
				FROM korisnici as k, tretmani as t
				WHERE t.korisnik_id=k.id AND t.datum='".$dan."'
				ORDER BY t.termin ASC;";
		$query = mysql_query($sql);
		$i = 0;
		$danasnji = "";

		while ($row = mysql_fetch_array($query))
			$danasnji[$i++]=$row;
			
		return $danasnji;

	}
	
	
	function submitKorisnik()
	{
		$ime_i_prezime = $_POST["korisnik"];
		$telefon = $_POST["korisnik_telefon"];
		$krevet = $_POST["korisnik_krevet"];
		$termin = $_POST["korisnik_termin"];
		$datum = $_POST["datum"];
		
		
		$sql = "SELECT id, COUNT(ime_i_prezime) AS broj FROM korisnici WHERE LOWER(ime_i_prezime)=LOWER('".$ime_i_prezime."') GROUP BY id;";
		$count = @mysql_fetch_array(mysql_query($sql));
		
		if($count["broj"]==1)
		{
			$korisnik_id = $count["id"];
			$tretman = $_POST["korisnik_tretman"];
			$sql = "UPDATE korisnici SET tretman='".$tretman."' WHERE id='".$korisnik_id."';";
			@mysql_query($sql);
			
		}
		else
		{
			$sql = "INSERT INTO korisnici (ime_i_prezime, telefon, tretman) VALUES ('".$ime_i_prezime."', '".$telefon."', 1);";
			@mysql_query($sql);
			$korisnik_id = mysql_insert_id();
		}
		
		$sql = "INSERT INTO tretmani (korisnik_id, datum, termin, krevet) 
				VALUES ('".$korisnik_id."', '".$datum."', '".$termin."', '".$krevet."');";
		@mysql_query($sql);

	}
	
	function getLista($col, $ascdesc, $start)
	{
		global $zapisi_po_strana;
		
		$sql = "SELECT *
				FROM korisnici
				LEFT JOIN tretmani ON korisnici.id=tretmani.korisnik_id
				ORDER BY ".$col." ".$ascdesc."
				LIMIT ".$start.", ".$zapisi_po_strana.";";
		$query = mysql_query($sql);
		$i=0;

		while ($row = mysql_fetch_array($query))
			$lista[$i++]=$row;
			
		return $lista;

	}
	
	
	function countall()
	{
				
		$sql = "SELECT COUNT(ime_i_prezime)
				FROM korisnici
				LEFT JOIN tretmani ON korisnici.id=tretmani.korisnik_id;";
		$count = mysql_fetch_array(mysql_query($sql));
			
		return $count;

	}
	
}
?>
