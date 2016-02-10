<?php
include('class.db');
// $playerid=1;
// $name="Sean Clark";
// $average="4.72";

$conn = new DB_Sql;
$conn->query("select money,date from main where playerid='$playerid' order by date DESC");
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
echo "<img src='./actualgraphall.php?&player=$name&average=$naverage'>";
echo "</td>";
echo "</tr>";
echo "</table>";
?>
