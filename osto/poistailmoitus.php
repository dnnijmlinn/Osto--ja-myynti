<?php
session_start();
include("kantayhteys.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Content-Type: text/html; charset=utf-8");

//nämä 2 if isset on lisätty, kokeilua toimiiko ilmoituksen poistaminen näillä komennoilla
if (isset($_POST['poista'])) {
    $poista = $_POST['poista'];
}

if (isset($_POST['ilmoitus_id'])) {
   $ilmoitus_id = $_POST['ilmoitus_id'];

}
// vai toimiiko ilmoituksen poistaminen näillä 2 komennolla. Kokeile.
$poista = $_POST['poista'];
$ilmoitus_id = $_POST['poista_id'];

if (isset($poista)){
$query= mysqli_query($dbconnect, "DELETE FROM ilmoitukset WHERE ilmoitus_id = '$ilmoitus_id'");

echo "Ilmoitus poistettu! <a href='index.php'>Palaa edelliselle sivulle</a>.";
}
?>

