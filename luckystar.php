<?php
include ("/etc/php/include/class.layout");
include ("/etc/php/include/class.poker");

$playerid=$_POST['playerid'];


$start = get_start_date($playerid);
$name = get_name($playerid);
setdefault("window",array("bgcolor"=>"#960AD0"));
setdefault("table",array("cellpadding"=>"0"));
setdefault("text",array("size"=>"4", "color"=>"white"));
newhtml(&$w);
insert($w, wheader("Find your lucky partner for $name "));
    insert($w, image("/poker/$playerid.jpg",array("align"=>"left")));
    insert($w,$t = table(array("cols"=>"2","width"=>"650")));
    insert($t,$c = cell(array("colspan"=>"2")));
    insert($c,text("Partners for $name<br>"));

$link = mysql_connect("localhost", "USERNAME","PASSWORD");
mysql_select_db("poker") or die("Could not select database");
$countplayers = "select playerid from players";
$result = mysql_query($countplayers);
$num_rows = mysql_num_rows($result);


for ($i=1;$i<=$num_rows;$i++) {

if ($i == $playerid) { continue;}

$query = "select avg(a.money) from main a, main b where a.date = b.date and a.playerid=$playerid and b.playerid=$i";
$gotit = mysql_query($query);
$row = mysql_fetch_row($gotit);
$printme[$i] = $row[0];

}

asort($printme);
reset($printme);
while (list($key, $val) = each($printme)) {

if ($key == $playerid) { continue;}
if ($val == 0) { continue;}
$name = get_name($key);
$val = currency($val);
    insert($c,text("Average with $name: $val<br>"));
                                }

    printhtml($w);


   ?>
