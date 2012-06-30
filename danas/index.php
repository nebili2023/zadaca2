<?php $current="Danas" ?>
<?php include("../include/top.php"); ?>
<?php include("../include/classes/korisnici.php"); ?>
<?php
//die(print_r(isset($_POST["korisnik_submit"])));
$msg = "";
if(isset($_POST["korisnik_submit"]))
{
	if(!isset($_POST["korisnik"]) || $_POST["korisnik"]=="")
		$msg .= " - Vnesite Ime i Prezime<br/>";
		
	if(!isset($_POST["korisnik_telefon"]) || $_POST["korisnik_telefon"]=="")
		$msg .= " - Vnesite Telefon<br/>";
		else if(!(preg_match("/^[0-9]/", $_POST["korisnik_telefon"])))
			$msg .= " - Vnesite Validan Telefon</br>";
	
	if($msg==""){		
		$korisnik = new korisnik;
		$korisnik->submitKorisnik();
	};
};
	$termini = array(	
				"11:00 – 11:20",
				"11:20 – 11:40",
				"11:40 – 12:00",
				"12:00 – 12:20",
				"12:20 – 12:40",
				"13:00 – 13:20",
				"13:20 – 13:40",
				"13:40 – 14:00",
				"PAUZA",
				"16:00 – 16:20",
				"16:20 – 16:40",
				"17:00 – 17:20",
				"17:20 – 17:40",
				"17:40 – 18:00",
				);
	$korisnici = new korisnik;
	$svikorisnici = $korisnici->getAllDan(date("Y-m-d"));
	if($svikorisnici!="")
	{
		foreach($svikorisnici as $k=>$v)
			$zafateni_termini[$k] = $v["termin"];
	}	 
	else
	{
		$zafateni_termini[0] = 15;
	}
	 
	//die(print_r($svikorisnici[1]["ime_i_prezime"]));
	//die(print_r($svikorisnici));
	//die(print_r($zafateni_termini));
?>
<script type="text/javascript" src="../scripts/ajax.js"></script>
<script type="text/javascript" src="../scripts/ajax-dynamic-list.js"></script>

<?php if($msg!="") echo '<div class="message"><h4>'.$msg.'</h4></div>';?>
<table cellspacing="0" align="center" cellpadding="0" border="0" width="700">
    <tr align="center"><td>
    	<h1><?php echo date("d.m.Y"); ?></h1></div>
    </td></tr>
</table>
<table cellspacing="0" align="center" cellpadding="0" border="1" width="700" class="termini">
    <tr align="center">
        <th>Vreme</th>
        <th>Ime i Prezime</th>
        <th>Krevet</th>
        <th>Telefon</th>
        <th>Tretman</th>
        <th>Akcija</th>
    </tr>
    <?php 
	$zt = 0;
	for($j=0;$j<14;$j++) {
		$class = '';
		if($j%2==1) $class = 'par';
		if((int)$j==8)
		{ 
			echo '<tr height="30" ><td colspan="6">PAUZA</td></tr>';			
		}
		else
		{

			if(in_array($j,$zafateni_termini))
			{
			echo '<tr height="30" class="'.$class.'" >';
			echo '<td>'.$termini[$j].'</td>';
			echo '<td>'.$svikorisnici[$zt]["ime_i_prezime"].'</td>';
			echo '<td>'.$svikorisnici[$zt]["krevet"].'</td>';
			echo '<td>'.$svikorisnici[$zt]["telefon"].'</td>';
			echo '<td>'.$svikorisnici[$zt]["tretman"].'</td>';
			echo '<td></td>';
			echo '</tr>';
			$zt++;
			}
			else
			{
			echo '<tr height="30" class="'.$class.'" ><form action="index.php" method="POST" onSubmit="return validate(this)">';
			echo '<td>'.$termini[$j].'</td>';
			echo '<td><input type="text" id="korisnik_'.$j.'" name="korisnik"';
			if(isset($_POST["korisnik_termin"]) && $_POST["korisnik_termin"]==$j)
					echo 'value="'.$_POST["korisnik"].'"';
			echo 'onkeyup="ajax_showOptions(this,';
			echo "'getKorisniciByLetters'";
			echo ',event)"></td>';
			echo '<td><select name="korisnik_krevet">';
					 for($i=1; $i<=3; $i++) 
					  echo '<option>'.$i.'</option>';
					
			echo '</select></td>';
			echo '<td><input type="text" id="korisnik_'.$j.'_hidden" name="korisnik_telefon"';
			if(isset($_POST["korisnik_termin"]) && $_POST["korisnik_termin"]==$j)
					echo 'value="'.$_POST["korisnik_telefon"].'"';
			echo '></td>';
			echo '<td>';
			echo '<label id="korisnik_'.$j.'_label"></label>';
			echo '<input type="hidden" id="korisnik_'.$j.'_hidden1" name="korisnik_tretman">';
			echo '<input type="hidden" id="korisnik_'.$j.'_hidden2" name="korisnik_id" value="0">';
			echo '<input type="hidden" id="korisnik_'.$j.'_hidden3" name="korisnik_termin" value="'.$j.'">';
			echo '<input type="hidden" id="korisnik_'.$j.'_hidden4" name="datum" value="'.date("Y-m-d").'">';
			echo '</td>';
			echo '<td><input type="submit" id="'.$j.'" name="korisnik_submit" value="Snimi" class="snimi_button"></td>';
			echo '</form>';
			echo '</tr>';
			};
		};
		
	}	
	?>
</table>
<?php include("../include/bottom.php"); ?>