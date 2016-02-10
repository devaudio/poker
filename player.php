<?php
include ("/etc/php/include/class.layout");
include ("/etc/php/include/class.poker");
$k=0;

$playerid=$_POST['playerid'];

$start = get_start_date($playerid);
$name = get_name($playerid);
$last = last_played($playerid);
$number = number_games($playerid);
$sumpoker = sumpoker($playerid);
$average = avgpoker($playerid);
$five = lastfive($playerid);
$ten = lastten($playerid);
list($paidin, $paidout) = moula($playerid);
list($day, $best) = bestday($playerid);
list($day2, $worst) = worstday($playerid);
$net = $sumpoker + $paidin - $paidout;
$net = currency($net);
$sumpoker = currency($sumpoker);
$naverage = $average;
$nfive = $five;
$nten = $ten;
$average = currency($average);
$paidin = currency($paidin);
$paidout = currency($paidout);
$best = currency($best);
$worst = currency($worst);
$five = currency($five);
$ten = currency($ten);
$avgbynum = averagebynumbers($playerid);


    setdefault("window",array("bgcolor"=>"#960AD0"));
    setdefault("table",array("cellpadding"=>"0"));
    setdefault("text",array("size"=>"4", "color"=>"white"));
    newhtml(&$w);


    insert($w, wheader("All the poker crap you wanted to know about $name"));
    // insert($w, image("/poker/$playerid.jpg",array("align"=>"left","width"=>"152","height"=>"200")));
    insert($w, image("/poker/$playerid.jpg",array("align"=>"left")));
    insert($w,$t = table(array("cols"=>"2","width"=>"650")));
    insert($t,$c = cell(array("colspan"=>"2")));
    insert($c,text("Stats for $name<br>"));
    insert($c,text("Started coming to Poker on $start<br>"));
    insert($c,text("Last game Played on $last<br>"));
    insert($c,text("$number games played in that span<br>"));
    insert($c,text("Current Net Total: $net<br>"));
    insert($c,text("Average win/loss per game $average<br>"));
    insert($c,text("Paid in to the Jar: $paidin<br>"));
    insert($c,text("Paid out from the Jar: $paidout<br>"));
    insert($c,text("Biggest win was $best on $day<br>"));
    insert($c,text("Biggest loss was $worst on $day2<br>"));
    insert($c,text("Average win/loss last 5  games: $five<br>"));
    insert($c,text("Average win/loss last 10 games: $ten<br>"));
    for ($k=3;$k<11;$k++) {
    				if ($avgbynum[$k]) {
				$avgbynum[$k] = currency($avgbynum[$k]);
				insert($c,text("Average with $k players: $avgbynum[$k]<br>"));
				}
				}

    printhtml($w); 

include('./graph10.php');

   ?>
