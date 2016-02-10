<?php
include ("jpgraph.php");
include ("jpgraph_line.php");
include ("jpgraph_scatter.php");
$dates=stripslashes($dates);
$money=stripslashes($money);
$dates=unserialize($dates);
$money=unserialize($money);
$counter = count($money);


$avg = array_fill(0,$counter, $average);
$favg = array_fill(0,$counter, $five);
$tavg = array_fill(0,$counter, $ten);

$datay = $money;
$datax = $dates;


if ($counter > 1)  {

// Setup the graph
$graph = new Graph(750,500);
$graph->SetMarginColor("black");
$graph->img->SetMargin(40,150,20,40);
$graph->SetScale("textlin",-40,40);
$graph->yscale->SetAutoTicks();
$graph->SetColor("#960AD0"); 


// $graph->xaxis->SetTickLabels($datax);
$graph->xaxis->SetTextLabelInterval(10);
// $graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,10);
// $graph->xaxis->SetLabelAngle(90);

// Hide the frame around the graph
$graph->SetFrame(false);

// Setup title
$graph->title->Set("Last $counter game(s) for $player");
$graph->title->SetFont(FF_VERDANA,FS_BOLD,14);
$graph->yaxis->title->Set("Dollars");
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->legend->Pos(0,0.25,"right","center");

// Note: requires jpgraph 1.12p or higher
// $graph->SetBackgroundGradient('blue','navy:0.5',GRAD_HOR,BGRAD_PLOT);

// Enable X and Y Grid
$graph->xgrid->Show();
$graph->xgrid->SetColor('gray@0.5');
$graph->ygrid->SetColor('gray@0.5');

// Create the line plots

$p1 = new LinePlot($datay);
$p1->SetColor("green");
$p1->SetFillColor('white'); 
$p1->SetWeight(2);
$p1->SetLegend("Win/Loss");
$graph->Add($p1);


$p2 = new LinePlot($avg);
$p2->SetColor("red");
$p2->SetWeight(2);
$p2->SetLegend("Overall Average");
$graph->Add($p2);

$p3 = new LinePlot($favg);
$p3->SetColor("orange");
$p3->SetWeight(2);
$p3->SetLegend("Last Five");
$graph->Add($p3);


$p4 = new LinePlot($tavg);
$p4->SetColor("blue");
$p4->SetWeight(2);
$p4->SetLegend("Last 10");
$graph->Add($p4);


// Output the graph
$graph->Stroke();
}

else  {

// Setup the graph
$graph = new Graph(750,500);
$graph->SetMarginColor("black");
$graph->SetScale("texlin");
$graph->SetColor("#960AD0");
$graph->yaxis->SetLabelFormat('%0.2f'); 


$graph->xaxis->SetTickLabels($datax);
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,10);

// Hide the frame around the graph
$graph->SetFrame(false);

// Setup title
$graph->title->Set("Last $counter game(s) for $player");
$graph->title->SetFont(FF_VERDANA,FS_BOLD,14);
$graph->yaxis->title->Set("Dollars");
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->legend->Pos(0.05,0.5,"right","center");

// Note: requires jpgraph 1.12p or higher
// $graph->SetBackgroundGradient('blue','navy:0.5',GRAD_HOR,BGRAD_PLOT);

// Enable X and Y Grid
$graph->xgrid->Show();
$graph->xgrid->SetColor('gray@0.5');
$graph->ygrid->SetColor('gray@0.5');




$sp1 = new ScatterPlot($datay);
$sp1->mark->SetType(MARK_FILLEDCIRCLE);
$sp1->mark->SetFillColor("black");
$sp1->mark->SetWidth(8);

$graph->Add($sp1);
$graph->Stroke();
}








?>
