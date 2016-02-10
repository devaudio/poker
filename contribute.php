<?php
include ("/etc/php/include/jpgraph.php"); 
include ("/etc/php/include/jpgraph_pie.php"); 
include ("jpgraph_pie3d.php");
$data = array_fill(0,10,40);
mysql_connect(localhost,"USERNAME","PASSWORD"); 
mysql_select_db(poker); 
$sql = "select playerid,paid_out from payouts where paid_out > 0;"; 
$result = mysql_query($sql); 
if ($myrow=mysql_fetch_array($result)) { 
       do { 
          $moneyout[] = $myrow["paid_out"];
          $playerout[] = $myrow["playerid"];
       }while ($myrow=mysql_fetch_array($result)); 
    } 


foreach ($playerout as $value) {
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

$graph->title->Set("Who the Money Goes To");

$colors = array('#68228B','#36648B','#FF8C69','#8DB6CD','#458B00','#BCEE68','#8B008B','red','blue','green','yellow','brown','orange','#FFFFFF','#000000','#00CDCD','#CCCCFF','#00CC66','#0066FF','#FF0033','#999999');

$p1 = new PiePlot3D($moneyout);
$p1->SetSliceColors($colors);
$p1->SetAngle(60);
$p1->SetLegends($playername);
$p1->value->SetFormat('%01.2f%%');
// $graph->img->SetMargin(40,200,20,40);
$graph->legend->Pos(0.05,0.5,"right","center");
$graph->Add($p1);
$graph->Stroke();




?>
