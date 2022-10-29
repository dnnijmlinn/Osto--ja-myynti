<?php
session_start(); 
include("kantayhteys.php");
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
header("Content-Type: text/html; charset=utf-8");

$ilmoitus_id = $_POST['muokkaa_id'];
if (isset($ilmoitus_id)) {
}

$query = mysqli_query($dbconnect, "SELECT * FROM ilmoitukset WHERE ilmoitus_id = '$ilmoitus_id'");

$row = mysqli_fetch_assoc($query);
$ilmoitus_nimi = $row["ilmoitus_nimi"];
$ilmoitus_laji = $row["ilmoitus_laji"];
if ($ilmoitus_laji == 1) {
    $ilmoitus_laji = "Myydään";
} if ($ilmoitus_laji == 2) {
    $ilmoitus_laji = "Ostetaan";
}
$ilmoitus_kuvaus = $row["ilmoitus_kuvaus"];
echo "<form action='ilmoitushallinta.php' method='post'>";
echo "<h3>Muokkaa ilmoitusta</h3>";
echo "<p>Ilmoitustyyppi: <b>" . $ilmoitus_laji ."</b><br>Muuta: <select
name ='ilmoitus_uusilaji'><option value='1'>Myydään</option><option
value='2'>Ostetaan</option></select></p>";
echo "<p>Kohteen nimi: <input name='ilmoitus_uusinimi' type='text' size='50'
value='$ilmoitus_nimi'></p>";
echo "<p>Kohteen kuvaus: <textarea name='ilmoitus_uusikuvaus' rows='5'
cols='80'>$ilmoitus_kuvaus</textarea></p>";
echo "<input type='hidden' name='lomaketunnistin' value='2'>";
echo "<input type='hidden' name='ilmoitus_id' value='$ilmoitus_id'>";
echo "<p><input type='Submit' value='Lähetä'></p>";
echo "</form>";
echo "<p><a href='index.php'>Palaa edelliselle sivulle.</a></p>";

?>