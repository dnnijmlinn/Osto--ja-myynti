<?php
session_start();
include("kantayhteys.php");
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

header("Content-Type:text/html;charset=utf-8");
date_default_timezone_set('Europe/Helsinki');
$ilmoitus_aika = date("Y-m-d");

$myyja_id = $_SESSION["kayttaja_id"];
if($_SESSION['LOGGEDIN'] == 1) {
    echo "<form action='ilmoitushallinta.php' method='post'>";
    echo "<h3>Lisää ilmoitus</h3>";
    echo "<p>Ilmoitustyyppi:<select name='ilmoitus_laji'><option
    value='1'>Myydään</option><option value='2'>Ostetaan</option></select></p>";
    echo "<p>Kohteen nimi:<input name='ilmoitus_nimi' type='text'
    size='50'></p>";
    echo "<p>Kohteen kuvaus:<textarea name='ilmoitus_kuvaus' rows='5'
    cols='80'></textarea></p>";
    echo "<input type='hidden' name='myyja_id' value='$myyja_id'>";
    echo "<input type='hidden' name='ilmoitus_paivays' value='$ilmoitus_aika'>";
    echo "<input type='hidden' name='lomaketunnistin' value='1'>";
    echo "<p><input type='submit' value='Lähetä'></p>";
    echo "</form>";
    echo "<p><a href='index.php'>Palaa edelliselle sivulle.</a></p>";
    exit;
}
else{
    echo "Et voi lisätä ilmoituksia, koska et ole kirjautunut sisään!";
}
?>