<?php
include ("jpgraph.php");
include ("jpgraph_line.php");
$dates=stripslashes($dates);
$money=stripslashes($money);
$dates=unserialize($dates);
$money=unserialize($money);
$counter = count($money);


$avg = array_fill(0,$counter, $average);

$datay = $money;
$datax = $dates;


if ($counter > 1)  {

// Setup the graph
$graph = new Graph(1024,500);
$graph->SetMarginColor("black");
$graph->SetScale("textlin");

$graph->xaxis->SetTickLabels($datax);
$graph->xaxis->SetTextLabelInterval(4);
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,10);
$graph->xaxis->SetLabelAngle(90);

// Hide the frame around the graph
$graph->SetFrame(false);

// Setup title
$graph->title->Set("Last $counter game(s) for $player");
$graph->title->SetFont(FF_VERDANA,FS_BOLD,14);
$graph->yaxis->title->Set("Dollars");
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

// Note: requires jpgraph 1.12p or higher
// $graph->SetBackgroundGradient('blue','navy:0.5',GRAD_HOR,BGRAD_PLOT);

// Enable X and Y Grid

// Create the line plots

$p1 = new LinePlot($datay);
$p1->SetColor("green");
$p1->SetFillColor('white'); 
$p1->SetWeight(2);
$graph->Add($p1);


$p2 = new LinePlot($avg);
$p2->SetColor("red");
$p2->SetWeight(2);
$graph->Add($p2);


// Output the graph
$graph->Stroke();
}





?>
