<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test4";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); }
$sql = "SELECT * FROM rooms where name='NAXOS'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        echo "<table><tr><td>ROWS=".$row["r_rows"]."</td><td>Cols=<td>".$row["r_cols"]."</td></tr>";
    $_SESSION['rows']=$row["r_rows"];
    $_SESSION['cols']=$row["r_cols"];
     $_SESSION['roomname']=$row["name"];    
    }    echo "</table>"; }
else {    echo "0 results"; }
$conn->close(); ?>
<form method="get">
<div>
    Movie:<input type="text" name="m_id"><br>
    Room:<input type="text" name="room" value="<?php echo $_SESSION['roomname'];?>"><br>
    Date:<input type="date" name="r_date"><br>
    Time:<input type="time" name="r_time"><br>
    
</div>
<table align="left" border="1" cellpadding="3" cellspacing="0">
<?php
if (isset($_GET["r_date"]) AND isset($_GET["r_time"])){
for($i=1;$i<=$_SESSION['cols'];$i++)
{
echo "<tr>";
for ($j=1;$j<=$_SESSION['rows'];$j++)
  {
echo "<td>";  
  if($i<>"" AND $j<>""){
   $servername = "localhost";
$username = "root";
$password = "";
$dbname = "test4";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); }
$sql = "SELECT * FROM reservations where seat_nr='$i-$j' AND r_date='$_GET[r_date]' AND r_time='$_GET[r_time]'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        echo "Seat ".$i. "-" .$j."<img src=red.png width=30>";    
    }     }
else {    echo "Seat ".$i. "-" .$j."<img src=green.png width=30><input type='checkbox' name='seat[]' value='".$i. "-" .$j."'>"; }
$conn->close();   
  }
  echo "</td>";
  
  }
  echo "</tr>";
}}
?>
</table><input type="submit"></form>
<?php
if(isset($_GET["seat"])){
    for($i=0; $i<count($_GET['seat']); $i++){
        echo $_GET['seat'][$i]."<br>";// edv sth thesi tou echo balte insert
    }
}
?>

