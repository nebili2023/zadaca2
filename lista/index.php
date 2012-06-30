<?php $current="Lista" ?>
<?php include("../include/top.php"); ?>
<?php include("../include/classes/korisnici.php"); ?>
<?php 

	function datum_print($datum){
		$datumarray = explode("-",$datum);
		return $datumarray[2].".".$datumarray[1].".".$datumarray[0];
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
			if(!isset($_GET["ascdesc"]) && !isset($_GET["col"]) && !isset($_GET["start"]))
			{
				$svikorisnici = $korisnici->getLista("ime_i_prezime", "ASC", 0);
				$start = 0;
			}
			else
			{
				$svikorisnici = $korisnici->getLista($_GET["col"], $_GET["ascdesc"], $_GET["start"]);
				$start = $_GET["start"];
			};
			
			$countall = $korisnici->countall();
			$pages = $countall[0]/$zapisi_po_strana;
			
			$last = ($countall[0]-($countall[0]%$zapisi_po_strana));
			
			$preth = $start - $zapisi_po_strana; 
			$sledna = $start + $zapisi_po_strana; 
			
			//die(print_r($maxpages));
?>	

<table cellspacing="0" align="center" cellpadding="0" border="1" width="700" class="termini">
    <tr align="center">
        <th width="350">
        <?php 
		//$col = $_GET["col"];
		if(!isset($_GET["ascdesc"])) $ascdesc = "ASC";
		if(!isset($_GET["col"]))
				{
					$imeup = "display:inline;";
					$imedown = "display:none;";
					$datumup = "display:none;";
					$datumdown = "display:none;";
					$col = "ime_i_prezime";

				} 
				else
				{
					$col = $_GET["col"];	
					if($_GET["col"]=="ime_i_prezime")
						{
							$datumup = "display:none;";
							$datumdown = "display:none;";
							if($_GET["ascdesc"]=="ASC")
							{
								$imeup = "display:inline;";
								$imedown = "display:none;";
								$ascdesc = "DESC";
							} else {
								$imeup = "display:none;";
								$imedown = "display:inline;";
								$ascdesc = "ASC";
							};
						} else {
							$imeup = "display:none;";
							$imedown = "display:none;";
							if($_GET["ascdesc"]=="ASC")
							{
								$datumup = "display:inline;";
								$datumdown = "display:none;";
								$ascdesc = "DESC";
							} else {
								$datumup = "display:none;";
								$datumdown = "display:inline;";
								$ascdesc = "ASC";
							};
						};
					};
					


		?>

        <div style=" <?php echo $imeup; ?> "><img src="../images/uparr.png" height="10" style="border:none;padding-right:20px;"/></div>
        <div style=" <?php echo $imedown; ?> "><img src="../images/downarr.png" height="10" style="border:none;padding-right:20px;"/></div>    	
        <a href="<?php echo $_SERVER["PHP_SELF"] . "?col=ime_i_prezime&ascdesc=".$ascdesc."&start=".$start; ?>" style="color:#000000;text-decoration:none">Ime i Prezime</a>

        </th>
        <th width="200">
        <div style=" <?php echo $datumup; ?> "><img src="../images/uparr.png" height="10" style="border:none;padding-right:20px;"/></div>
        <div style=" <?php echo $datumdown; ?> "><img src="../images/downarr.png" height="10" style="border:none;padding-right:20px;"/></div>
        
        <a href="<?php echo $_SERVER["PHP_SELF"] . "?col=datum&ascdesc=".$ascdesc."&start=".$start; ?>" style="color:#000000;text-decoration:none">Datum</a>
        </th>
        <th width="150">Vreme</th>
    </tr>
    
    <?php 
	$i=0;
	foreach($svikorisnici as $k=>$v) {
		$class = '';
		if($i%2==1) $class = 'par';
		
		echo '<tr class="'.$class.'">';
		echo '<td >'.$v["ime_i_prezime"].'</td>';
		echo '<td>'.datum_print($v["datum"]).'</td>';
		echo '<td>'.$termini[$v["termin"]].'</td>';
		echo '</tr>';
		$i++;
	};
	?>
    </table>
    <br/>
    <?php
	if(isset($_GET["ascdesc"]) && $ascdesc=="ASC") $ascdesc="DESC";
	else $ascdesc="ASC"; 
	?>
<table cellspacing="0" align="center" cellpadding="0" border="0" width="700" >
    <tr>
        <td align="left" width="60">
        <a href="<?php echo $_SERVER["PHP_SELF"] . "?col=".$col."&ascdesc=".$ascdesc."&start=0"; ?>" style="color:#FFFFFF;"><img src="../images/doubleleftarr.png" height="17" style="border:none;padding-left:5px;"/> </a>
        </td>
        <td align="left" width="60">
        <?php if($preth>=0) { ?>
        <a href="<?php echo $_SERVER["PHP_SELF"] . "?col=".$col."&ascdesc=".$ascdesc."&start=".$preth; ?>" style="color:#FFFFFF;"><img src="../images/leftarr.png" height="17" style="border:none;padding-left:5px;"/> </a>
        <?php } ?>
        </td>
        <td align="center">strana: <?php echo ($start/$zapisi_po_strana+1)."/".($last/$zapisi_po_strana+1) ?></td>
        <td align="right"  width="60">
        <?php if($sledna<$countall[0]) { ?>
        <a href="<?php echo $_SERVER["PHP_SELF"] . "?col=".$col."&ascdesc=".$ascdesc."&start=".$sledna; ?>" style="color:#FFFFFF;"><img src="../images/rightarr.png" height="17" style="border:none;padding-right:5px;"/></a>
        <?php } ?>
        </td>
        <td align="right" width="60">
        <a href="<?php echo $_SERVER["PHP_SELF"] . "?col=".$col."&ascdesc=".$ascdesc."&start=".$last; ?>" style="color:#FFFFFF;"><img src="../images/doublerightarr.png" height="17" style="border:none;padding-right:5px;"/></a>
        </td>
    </tr>
</table>
<?php include("../include/bottom.php"); ?>