<?php
  $meseciIminja = Array("Januar", "Februar", "Mart", "April", "Maj", "Jun", "Jul", "Avgust", "Septembar", "Oktobar", "Novembar", "Decembar");
	if (!isset($_GET["mesec"])) $_GET["mesec"] = date("n");
	if (!isset($_GET["godina"]))  $_GET["godina"]  = date("Y");
	
  $tMesec = $_GET["mesec"];
  $tGodina  = $_GET["godina"];
                
  $preth_godina = $tGodina;
  $sled_godina = $tGodina;

 	$preth_mesec = $tMesec-1;
 	$sled_mesec = $tMesec+1;

 	if ($preth_mesec == 0 ) {
    $preth_mesec = 12;
    $preth_godina = $tGodina - 1;
  }
 	if ($sled_mesec == 13 ) {
    $sled_mesec = 1;
    $sled_godina = $tGodina + 1;
  }
?>
<div id="kalendar_div">
<table width="400" border="0" cellpadding="2" cellspacing="2" align="center">
<tr>
<td colspan="7" id="kalendar">
<table width="100%" >
                <tr align="center" id="kalendar" >
                <td colspan="2" align="left"><a href="<?php echo $_SERVER["PHP_SELF"] . "?mesec=". $preth_mesec . "&godina=" . $preth_godina; ?>" style="color:#FFFFFF;"><img src="../images/leftarr.png" height="17" style="border:none;padding-left:5px;"/> </a></td>
                  <td colspan="3" id="kalendar"><strong><?php echo $meseciIminja[$tMesec-1].' '.$tGodina; ?></strong></td>
                  <td colspan="2" align="right"><a href="<?php echo $_SERVER["PHP_SELF"] . "?mesec=". $sled_mesec . "&godina=" . $sled_godina; ?>" style="color:#FFFFFF;"><img src="../images/rightarr.png" height="17" style="border:none;padding-right:5px;"/> </a></td>
                </tr>
                </table>
                </td>
                </tr>
                <tr height="30">
                  <td align="center" id="kalendar"><strong>P</strong></td>
                  <td align="center" id="kalendar"><strong>U</strong></td>
                  <td align="center" id="kalendar"><strong>S</strong></td>
                  <td align="center" id="kalendar"><strong>C</strong></td>
                  <td align="center" id="kalendar"><strong>P</strong></td>
                  <td align="center" id="kalendar"><strong>S</strong></td>
                  <td align="center" id="kalendar"><strong>N</strong></td>
                </tr>

                <?php 
                	$denes = mktime(0,0,0,$tMesec,1,$tGodina);
                	$maxdenovi    = date("t",$denes);
                	$tekovenmesec = getdate ($denes);
                	$pocetenden  = $tekovenmesec['wday'];
					
					if($pocetenden==0) $pocetenden=7;
					$countnedeli = 0;
					$countdenovi = 0;

                  for ($i=1; $i<($maxdenovi+$pocetenden); $i++) {
                    if(($i % 7) == 1 ){
						 echo '<tr>';
						   $countnedeli++;
					};
					$countdenovi++;
                    if($i < $pocetenden) echo '<td id="mesec_polinja" ></td>';
                    else 
					{
						echo '<td align="center" valign="middle" id="mesec_denovi"';
						if(date("j")==($i - $pocetenden + 1) && date("n")==$tMesec && date("Y")==$tGodina) 
							echo 'style="background-color:#D24949;"';
						echo '><a href="../dan/index.php?dan='.($i - $pocetenden + 1).'&mesec='.$tMesec.'&godina='.$tGodina.'" class="datumot">'. ($i - $pocetenden + 1) . '</a></td>';
					};
                    if(($i % 7) == 0 ){
							echo '</tr>';
							$countdenovi = 0;
					};
                  };
				  if($countdenovi!=0){
				  	$countdenovi = 7 - $countdenovi;
				 	while($countdenovi--)
				  		echo  '<td id="mesec_polinja" ></td>';
					echo '</tr>';
					};
					
					if($countnedeli!=6){
						while($countnedeli!=6){
						$countnedeli++;
						echo "<tr>";
						for ($i=0; $i<7; $i++)
				  			echo  '<td id="mesec_polinja" ></td>';
						echo '</tr>';
						};
					};
					
                 ?>
</table>
</div>	
