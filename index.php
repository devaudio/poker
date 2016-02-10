<HTML>
<HEAD>
        <TITLE>NYROC LXA Poker pages</TITLE>
</HEAD>
<BODY BGCOLOR="#960AD0">
    <IMG SRC="/poker/title.jpg"  ALIGN="left">
    <TABLE CELLPADDING="0" WIDTH="650">
    <TR>
        <TD COLSPAN="2"><FONT SIZE="6" COLOR="white">Welcome to the Thursday Night Poker club.</FONT><FONT SIZE="6" COLOR="white"><br>Here you will find the statistics for all players going back to March 15th, 2001, as well as random other noteworthy statistics.</FONT>
            <FORM METHOD="post" ACTION="/poker/player.php">

<?php
echo "<br><Font Color=\"white\">View a Players stats:<br>";
echo "<SELECT NAME=\"playerid\">\n"; 
    $link = mysql_connect("localhost", "USERNAME","PASSWORD");
mysql_select_db("poker") or die("Could not select database");
    $getit = "SELECT playerid,playername FROM players ORDER BY playername";
    $result = mysql_query($getit);
    while ($row = mysql_fetch_object($result)) {
    echo "<OPTION VALUE=$row->playerid>$row->playername\n"; 
    }
    mysql_close($link);
 echo "</SELECT>\n"; 
?>

<INPUT TYPE=SUBMIT VALUE="Send">
<INPUT TYPE=RESET VALUE="Clear">
<br><br>

<?php

include ("/etc/php/include/class.poker");


$numgames = numgames();
$jartotal = jartotal();
list($day, $money, $name) = bigwinner();
list($day2, $money2, $name2) = bigloser();
list($games, $name3) = mostgames();
list($best, $name4) = bestaverage();
list($best3, $name10) = bestaverage3();
list($best2, $name42) = bestaverage2();
list($worst2, $name52) = blu();
list($worst, $name5) = worstaverage();
list($worst3, $name11) = worstaverage3();
list($hight, $name6) = mostpaid();
list($low, $name7) = leastpaid();
list($nettotal, $name8) = highnet();
list($netlow, $name9) = lownet();

$worst3 = currency($worst3);
$best3 = currency($best3);
$money = currency($money);
$money2 = currency($money2);
$jartotal = currency($jartotal);
$best = currency($best);
$best2 = currency($best2);
$worst = currency($worst);
$hight = currency($hight);
$low = currency($low);
$worst2 = currency($worst2);
$nettotal = currency($nettotal);
$netlow = currency($netlow);
echo "<br><Font Color=\"white\">Total Number of Games played so Far: $numgames<br>";
echo "Total Money in the poker Jar right now: $jartotal<br>";
echo "Biggest win: $money, by $name on $day<br>";
echo "Biggest Loss: $money2, by $name2 on $day2<br>";
echo "Most games played: $games, by $name3<br>";
echo "Best Average: $best2/game, by $name42<br>";
echo "Worst Average: $worst2/game, by $name52<br>";
echo "Best Average (regulars): $best/game, by $name4<br>";
echo "Worst Average (regulars): $worst/game, by $name5<br>";
echo "Best Average (Min 10 games): $best3/game, by $name10<br>";
echo "Worst Average (Min 10 games): $worst3/game, by $name11<br>";
echo "Most Money paid out to date: $hight, by $name6<br>";
echo "Most Money paid in to date: $low, by $name7<br>";
echo "Highest Net Total right now: $nettotal, by $name8<br>";
echo "Lowest Net Total right now: $netlow, by $name9<br><br>";
echo "click <a href=\"topten.php\"> here</a> to see the top ten winners and losers<br><br>";
echo "click <a href=\"moneys.php\"> here</a> to see money distribution<br><br>";
echo "click <a href=\"games.html\"> here</a> to see rules for the various games<br>";
?>
</FORM>
 <FORM METHOD="post" ACTION="/poker/luckystar.php">

 <?php
 echo "<br><Font COlor=\"white\">Find Your Lucky Playing Partner:<br>";
 echo "<SELECT NAME=\"playerid\">\n";
     $link = mysql_connect("localhost", "USERNAME",
     "PASSWORD");
         mysql_select_db("poker") or die("Could not select database");
	     $getit = "SELECT playerid,playername FROM players ORDER BY playername";
	         $result = mysql_query($getit);
		     while ($row = mysql_fetch_object($result)) {
		         echo "<OPTION VALUE=$row->playerid>$row->playername\n";
			     }
			         mysql_close($link);
				  echo "</SELECT>\n";
				  ?>
				  <INPUT TYPE=SUBMIT VALUE="LUCK">
				  <br><br>

