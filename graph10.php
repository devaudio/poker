<?php

$playerid=$_POST['playerid'];

$conn = new DB_Sql;
$conn->query("select money,date from main where playerid='$playerid' order by date DESC limit 10");
$i=0;
$a=array();
$b=array();
while ($conn->next_record()) {
   $date=substr($conn->Record["date"],2);
   $temp=explode("-",$date);
   $a[$i]=$temp[1]."/".$temp[2]."/".$temp[0];
   $b[$i]=$conn->Record["money"];
   $i++;
} // end while
$a=array_reverse($a);
$b=array_reverse($b);
$dates=serialize(&$a);
$money=serialize(&$b);

echo "<table border=0>";
echo "<tr>";
echo "<td>";
echo "<a href=\"historygraph.php?playerid=$playerid&player=$name&average=$naverage\">";
echo "<img src='./actualgraph.php?dates=$dates&money=$money&player=$name&average=$naverage&five=$nfive&ten=$nten'>";
echo "</a>";
echo "</td>";
echo "</tr>";
echo "</table>";
?>
