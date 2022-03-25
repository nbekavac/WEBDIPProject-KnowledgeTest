<?php
$servername = "localhost";
$username = "WebDiP2017x010";
$password = "admin_hcfs";
$dbname = "WebDiP2017x010";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to delete a record
/*$sql = "DELETE FROM MyGuests WHERE id=3";*/


if(isset($_GET["naziv"]))
{
    $naziv = $_GET["naziv"];
}
$sql = "SELECT oglasi_id FROM oglasi WHERE naziv='$naziv'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $oglasi_id=$row["oglasi_id"];
    
    }
}
    $sql1 = "DELETE FROM zahtjevi_za_blokiranje WHERE oglasi_oglasi_id=$oglasi_id";
    if ($conn->query($sql1) === TRUE) {
        echo "Record deleted successfully";
    }
    $conn->close();
  header("Location:popisBlokiranje.php");
  

?>