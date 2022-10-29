<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "osto";

/*
mysqli_connect("localhost", "root", "");
mysql_select_db("osto");
*/
// Create connection
$dbconnect = mysqli_connect($servername, $username, $password, $database);


// Check connection
if (!$dbconnect) {
  die("Yhteys tietokantaan ei toimii: " . mysqli_connect_error()); 
} 
//echo "Yhteys tietokantaan toimii "; 
?>