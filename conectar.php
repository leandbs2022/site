
<?php
//dados BD
$servername = "179.188.16.95";
$username = "cursophp";
$password = "lbs031182";
$dbname = "cursophp";
//Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
//Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>