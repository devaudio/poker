<?PHP

include ("/etc/php/include/class.db");

$this_script = $_SERVER['PHP_SELF'];


//echo "blah $this_script";

/***************************/
switch ($menu) {

case "add_to_main":
add_to_main();
break;

case "input":
input_screen($num,$date);
break;

case "add_to_players":
add_to_players($player_name);
break;

case "get_new_player":
get_new_player();
break;

default:
get_num();

}

/***************************/

function add_to_main() {
// add playerid's and amounts to main table

Global $playerid,$amount,$date;

for ($i=0;$i<count($playerid);$i++) {
// echo $i." -- ".$playerid[$i]." -- ".$amount[$i]."<br>"; // error checking

$pid=$playerid[$i];
$money=$amount[$i];

$sql = "INSERT INTO main (playerid,date,money) VALUES ('$pid','$date','$money')";
// echo $sql. "<br>"; // error checking

$conn=new DB_Sql;
 $conn->query($sql); // uncomment to activate

} // end for loop

echo "<SCRIPT LANGUAGE=\"JavaScript\">\n";
echo "document.location.href=\"index.php\"\n";
echo "</SCRIPT>\n";

} // end function add_to_main
 

function input_screen($num,$date) {
// gets amounts and players names


// javascript form validation -- amounts need to equal 0 and playerid cannot be null 
echo "<SCRIPT LANGUAGE=\"JavaScript\">\n";
echo "function valid(form) {\n";
for ($i=0;$i<$num;$i++) {
echo "if (!form.elements['playerid[$i]'].value) {\n";
echo "alert('You forgot to select a Player on line '+".($i+1).");\n";
echo "return false;\n"; 
echo "}\n";
echo "if (!form.elements['amount[$i]'].value) {\n";
echo "alert('You forgot to enter an amount on line '+".($i+1).");\n";
echo "return false;\n"; 
echo "}\n";
}
$line="";
for ($i=0;$i<$num;$i++) {
$line.= "(form.elements['amount[$i]'].value-0) + ";
}
$line=substr($line,0,-3);
echo "if ((".$line.")!=0) {\n";
echo "alert('Your total amount does not equal zero');\n";
echo "return true;\n";
echo "}\n";

echo "}\n";
echo "</SCRIPT>\n";

$conn=new DB_Sql;
$conn->query("SELECT * FROM players order by playername");

echo "<form method=post action=\"$this_script\" onSubmit=\"return valid(this)\">\n";
echo "<input type=hidden name=menu value=add_to_main>\n";
echo "<input type=hidden name=date value='$date'>\n";
echo "<table align=center width=50%>\n";
echo "<tr>\n";
echo "<td>&nbsp</td>\n";
echo "<td><b><u>Player</td>\n";
echo "<td><b><u>Amount</td>\n";
echo "</tr>\n";

for ($i=0;$i<$num;$i++) { // go through for the amount of players for the evening

echo "<tr>\n";
echo "<td>".($i+1).".</td>\n";
echo "<td><select name='playerid[$i]'>\n";
echo "<option value=''>>>>Select Player<<<</option>\n";

$conn->seek(); // need to set the pointer of result array to 0

while ($conn->next_record()) {

echo "<option value='".$conn->Record["playerid"]."'>".$conn->Record["playername"]."</option>\n";

} // end while loop

echo "</select></td>\n";
echo "<td>$<input type=text name=amount[$i] size=10></td>\n";
echo "</tr>\n";


} // end for loop

echo "</table>\n";
echo "<center><input type=submit name=submit value=Submit></center>\n";
echo "</form>\n";

} // end function input_screen

function get_num() {
// gets the number of players and date for the evening
// has a button for adding a new player

echo "<center>\n";
echo "<form method=post action=\"$this_script\">\n";
echo "<input type=hidden name=menu value=input>\n";
echo "Number of Players : <input type=text name=num size=5><br>\n";
echo "Date of Game : <input type=text name=date value='".date("Y-m-d",time())."' size=12><br><br>\n";
echo "<input type=submit name=submit value='Submit Game Totals'>\n";
echo "</form>\n";
echo "</center>\n";

echo "<br><br><center>\n";
echo "<form method=post action=\"$this_script\">\n";
echo "<input type=hidden name=menu value=get_new_player>\n";
echo "<input type=submit name=submit value='Add New Player'>\n";
echo "</form>\n";
echo "</center>\n";

} // end function get_num

function get_new_player() {

echo "<center>\n";
echo "<form method=post action=\"$this_script\">\n";
echo "<input type=hidden name=menu value=add_to_players>\n";
echo "Enter New Player Name : <input type=text name='player_name'>\n";
echo "<input type=submit name=submit value='Add Player'>\n";
echo "</form>\n";
echo "</center>\n";

} // end function get_new_player

function add_to_players($player_name) {

$conn=new DB_Sql;

// get the last sequence number for player id -- if this field in DB is changed to auto_increment -- then this won't be needed
$conn->query("SELECT max(playerid) FROM players");
$conn->next_record();
$new_pid= ($conn->Record[0]+1);
// echo $new_pid . "<br>";  // testing
$sql = "INSERT INTO players (playerid,playername) VALUES ('$new_pid','$player_name')";
// echo $sql; // testing
$conn->free();

$conn->query($sql);  // uncomment when ready to activate

echo "<SCRIPT LANGUAGE=\"JavaScript\">\n";
echo "document.location.href=\"./enter.php\"\n";
echo "</SCRIPT>\n";

} // end function get_new_player
?>
