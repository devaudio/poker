<?php
include("/etc/php/include/class.layout");
include("/etc/php/include/class.db");

setdefault("window",array("bgcolor"=>"#960AD0"));
setdefault("table",array("cellpadding"=>"0"));
setdefault("text",array("size"=>"4", "color"=>"white"));
newhtml(&$w);

insert($w, wheader("Big Money, no Whammies, don't stop"));
insert($w, image("/poker/masks.jpg",array("align"=>"left")));
insert($w,$t = table(array("cols"=>"2","width"=>"650")));
insert($t,$c = cell(array("colspan"=>"2")));

mysql_connect(localhost,"USERNAME","PASSWORD");
mysql_select_db(poker)  or die("Could not select database");
$sql = "select playerid,date,money from main where date > SUBDATE( CURRENT_DATE, INTERVAL 730 DAY ) order by money DESC limit 10" ;
$result = mysql_query($sql);

if ($myrow=mysql_fetch_array($result)) {
       do {
          $moneyout[] = $myrow["money"];
          $playerout[] = $myrow["playerid"];
          $dateout[] = $myrow["date"];
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


$i=0;

insert($c,text("<h3>The Big Winners - Last 100 games<br></H3>"));

foreach ($playername as $name) {
   $j=$i+1;
   if ( $j == 10) {
   insert($c,text("#$j \$$moneyout[$i] $playername[$i] $dateout[$i]<br>"));
   }
   else {
   insert($c,text("#$j&nbsp&nbsp  \$$moneyout[$i] $playername[$i] $dateout[$i]<br>"));
   }
   $i++;
      }



$sql = "select playerid,date,money from main where date > SUBDATE( CURRENT_DATE, INTERVAL 730 DAY ) order by money ASC limit 10" ;
$result = mysql_query($sql);

if ($myrow=mysql_fetch_array($result)) {
       do {
          $lmoneyout[] = $myrow["money"];
          $lplayerout[] = $myrow["playerid"];
          $ldateout[] = $myrow["date"];
       }while ($myrow=mysql_fetch_array($result));
    }


foreach ($lplayerout as $value) {
$sql = "select playername from players where playerid=$value";
$result = mysql_query($sql);
if ($myrow=mysql_fetch_array($result)) {
       do {
           $lplayername[] = $myrow["playername"];
         }while ($myrow=mysql_fetch_array($result));
    }
}


$i=0;
insert($c,text("<br><br><h3>The Big Losers - Last 100 games<br></h3>"));

foreach ($lplayername as $name) {
   $j=$i+1;
    if ( $j == 10) {
   insert($c,text("#$j \$$lmoneyout[$i] $lplayername[$i] $ldateout[$i]<br>"));
   }
   else {
    insert($c,text("#$j&nbsp&nbsp  \$$lmoneyout[$i] $lplayername[$i] $ldateout[$i]<BR>"));
    }
      $i++;
      }

$sql = "select playerid,date,money from main order by money DESC limit 10" ;
$result2 = mysql_query($sql);

if ($myrow=mysql_fetch_array($result2)) { 
       do { 
          $tmoneyout[] = $myrow["money"];
          $tplayerout[] = $myrow["playerid"];
          $tdateout[] = $myrow["date"];
       }while ($myrow=mysql_fetch_array($result2)); 
    } 


foreach ($tplayerout as $value) {
$sql = "select playername from players where playerid=$value";
$result2 = mysql_query($sql);
if ($myrow=mysql_fetch_array($result2)) {
       do {
	   $tplayername[] = $myrow["playername"];
	 }while ($myrow=mysql_fetch_array($result2));
    }
}

  
$i=0;

insert($c,text("<h3>The Big Winners - All Time<br></H3>"));

foreach ($tplayername as $name) {
   $j=$i+1;
   if ( $j == 10) {
   insert($c,text("#$j \$$tmoneyout[$i] $tplayername[$i] $tdateout[$i]<br>"));
   }
   else {
   insert($c,text("#$j&nbsp&nbsp  \$$tmoneyout[$i] $tplayername[$i] $tdateout[$i]<br>"));
   }
   $i++;
      }
   


$sql = "select playerid,date,money from main order by money ASC limit 10" ;
$result2 = mysql_query($sql);

if ($myrow=mysql_fetch_array($result2)) {
       do {
          $ltmoneyout[] = $myrow["money"];
          $ltplayerout[] = $myrow["playerid"];
          $ltdateout[] = $myrow["date"];
       }while ($myrow=mysql_fetch_array($result2));
    }


foreach ($ltplayerout as $value) {
$sql = "select playername from players where playerid=$value";
$result2 = mysql_query($sql);
if ($myrow=mysql_fetch_array($result2)) {
       do {
           $ltplayername[] = $myrow["playername"];
         }while ($myrow=mysql_fetch_array($result2));
    }
}


$i=0;
insert($c,text("<br><br><h3>The Big Losers - All Time<br></h3>"));

foreach ($ltplayername as $name) {
   $j=$i+1;
    if ( $j == 10) {
   insert($c,text("#$j \$$ltmoneyout[$i] $ltplayername[$i] $ltdateout[$i]<br>"));
   }
   else {
    insert($c,text("#$j&nbsp&nbsp  \$$ltmoneyout[$i] $ltplayername[$i] $ltdateout[$i]<BR>"));
    }
      $i++;
      }
 printhtml($w); 
?>
