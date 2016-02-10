<?php
include ("/etc/php/include/jpgraph.php"); 
include ("/etc/php/include/jpgraph_pie.php"); 
include ("jpgraph_pie3d.php");
$data = array_fill(0,10,40);
mysql_connect(localhost,"USERNAME","PASSWORD"); 
mysql_select_db(poker); 
$sql = "select playerid,paid_in from payouts where paid_in > 0;"; 
$result = mysql_query($sql); 
if ($myrow=mysql_fetch_array($result)) { 
       do { 
          $moneyin[] = $myrow["paid_in"];
          $playerin[] = $myrow["playerid"];
       }while ($myrow=mysql_fetch_array($result)); 
    } 


foreach ($playerin as $value) {
$sql = "select playername from players where playerid=$value";
$result = mysql_query($sql);
if ($myrow=mysql_fetch_array($result)) {
       do {
	   $playername[] = $myrow["playername"];
	 }while ($myrow=mysql_fetch_array($result));
    }
}


$graph = new PieGraph(1400,1000,"auto");
$graph->SetShadow();

$graph->title->Set("Where the Money Comes from");

$p1 = new PiePlot3D($moneyin);

$colors = array('#68228B','#36648B','#FF8C69','#8DB6CD','#458B00','#BCEE68','#8B008B','red','blue','green','yellow','brown','orange','#FFFFFF','#000000','#00CDCD','#CCCCFF','#00CC66','#0066FF','#FF0033','#999999','magenta','cyan','skyblue','#FAEBD7','#CCCC99','#FF6633','#666666','#FFCCFF','#FFFF99','#CCCC33','#33FF66','#00CCCC');

$p1->SetSliceColors($colors);
$p1->SetLegends($playername);
$p1->value->SetFormat('%01.2f%%');
$graph->img->SetMargin(40,200,20,40);
$graph->legend->Pos(0.05,0.5,"right","center");
$graph->Add($p1);
$graph->Stroke();




?>
