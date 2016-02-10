<?

$n=1;


$average3 = array();
$average4 = array();
$average5 = array();
$average6 = array();
$average7 = array();
$average8 = array();
$average9 = array();
$average10 = array();



$link = mysql_connect("localhost", "USERNAME","PASSWORD");
mysql_select_db("poker") or die("Could not select database");
$getit = "select a.money, count(b.playerid) from main a, main b where a.date=b.date and a.playerid=$n group by b.date, a.money";
$result = mysql_query($getit);
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
print "<PRE>";

if ($row[1] == 3) {
		   array_push ($average3, $row[0]);
		   }

if ($row[1] == 4) {
                   array_push ($average4, $row[0]);
                   }

if ($row[1] == 5) {
                   array_push ($average5, $row[0]);
                   }
if ($row[1] == 6) {
                   array_push ($average6, $row[0]);
                   }

if ($row[1] == 7) {
                   array_push ($average7, $row[0]);
                   }
if ($row[1] == 8) {
                   array_push ($average8, $row[0]);
                   }
if ($row[1] == 9) {
                   array_push ($average9, $row[0]);
                   }
if ($row[1] == 10) {
                   array_push ($average10, $row[0]);
                   }

  }

$peeps[3] =  array_sum($average3) / count($average3); 
$peeps[4] =  array_sum($average4) / count($average4); 
$peeps[5] =  array_sum($average5) / count($average5); 
$peeps[6] =  array_sum($average6) / count($average6); 
$peeps[7] =  array_sum($average7) / count($average7); 
$peeps[8] =  array_sum($average8) / count($average8); 
$peeps[9] =  array_sum($average9) / count($average9); 
$peeps[10] =  array_sum($average10) / count($average10); 

print_r($peeps);


  mysql_free_result($result);
    ?>
