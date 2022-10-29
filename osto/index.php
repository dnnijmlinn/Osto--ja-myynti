<?php
session_start();
include("kantayhteys.php");

ini_set('display_errors', 1);	//poista tai kommentoi nämä rivit, kun sivusto toimii
ini_set('display_startup_errors', 1);	//poista tai kommentoi nämä rivit
error_reporting(E_ALL);	//poista tai kommentoi nämä rivit


header("Content-Type: text/html; charset=utf-8");


/* Anna tämän kommentin alle komento, jossa asetetaan oletus aikavyöhykkeeksi ('Europe/Helsinki'), jota käytetään myöhemmin kaikissa tähän tiedostoon lisättävissä päivämäärä- ja aikatoiminnoissa.  */
date_default_timezone_set('Europe/Helsinki');


echo "<h2>Osto- ja myyntipalsta</h2>";

if (isset($_SESSION['LOGGEDIN']) && $_SESSION['LOGGEDIN'] == 1) {

    echo "Tervetuloa käyttämään palvelua " . $_SESSION["kayttaja_tunnus"] ."!<br>";

    echo "(<a href='lisaailmoitus.php'>Lisää ilmoitus</a>) - (<a href='tiedot.php'>Muuta tietojasi</a>) - (<a href='uloskirjautuminen.php'>Kirjaudu ulos</a>)<br>";
} else {
    echo "<a href='kirjautuminen.html'>Kirjaudu sisään</a> tai <a href='rekisterointi.html'>rekisteröidy palveluun</a>.";
}

// ilmoitusten tuonti

$query= ("SELECT * FROM ilmoitukset INNER JOIN kayttajat ON ilmoitukset.myyja_id = kayttajat.kayttaja_id");
$result=mysqli_query($dbconnect, $query); //SET....tämä muutettu

if (!$result) {					//tämä rivi tarkastaa mahdollisen virheen $result = mysqli_query($link, $sql) rivillä
    printf("Error: %s\n", mysqli_error($dbconnect));
    exit();
}

$num=mysqli_num_rows($result);


$i=0;
while ($i < $num) {

//$ilmoitus_id = mysqli_fetch_object($result,$i,"ilmoitus_id");
//$ilmoitus_laji = mysqli_fetch_object($result,$i,"ilmoitus_laji");

$row = mysqli_fetch_assoc($result);
$ilmoitus_id = $row["ilmoitus_id"];
$ilmoitus_laji = $row["ilmoitus_laji"];

if (false === $ilmoitus_laji) {
    echo mysql_error();
}

if ($ilmoitus_laji == 1) {
$ilmoitus_laji = "Myydään";
} 
if ($ilmoitus_laji == 2) {
$ilmoitus_laji = "Ostetaan";
}

//$ilmoitus_nimi=mysqli_fetch_object($result,$i,"ilmoitus_nimi");
$ilmoitus_nimi = $row["ilmoitus_nimi"];

//$ilmoitus_kuvaus=mysqli_fetch_object($result,$i,"ilmoitus_kuvaus");
$ilmoitus_kuvaus=$row["ilmoitus_kuvaus"];

//$ilmoitus_paivays=mysqli_fetch_object($result,$i,"ilmoitus_paivays");
$ilmoitus_paivays=$row["ilmoitus_paivays"];

$ilmoitus_oikeapaivays = date("d-m-Y",strtotime($ilmoitus_paivays));

//$myyja_id=mysqli_fetch_object($result,$i,"kayttaja_id");
$myyja_id= $row["kayttaja_id"];

//$myyja_tunnus=mysqli_fetch_object($result,$i,"kayttaja_tunnus");
$myyja_tunnus= $row["kayttaja_tunnus"];

//$myyja_sahkoposti=mysqli_fetch_object($result,$i,"kayttaja_sahkoposti");
$myyja_sahkoposti=$row["kayttaja_sahkoposti"];

echo "<p><table width='500'><tr><td bgcolor='#AABBCC'><b>$ilmoitus_laji:
$ilmoitus_nimi</b></td></tr><tr><td>$ilmoitus_kuvaus</td></tr><tr><td>Ilmoitus jätetty: $ilmoitus_oikeapaivays</td></tr><tr><td>Myyjä: $myyja_tunnus 
(<a href='mailto: $myyja_sahkoposti'>$myyja_sahkoposti</a>)</td></tr>";

if ((isset($_SESSION['kayttaja_id']) AND $_SESSION['kayttaja_id'] == $myyja_id) OR (isset($_SESSION['kayttaja_taso']) AND $_SESSION['kayttaja_taso'] == "admin"))
{
echo "<tr><td><form action='poistailmoitus.php' method='post'/><input
type='hidden' name='poista' value='1'><input type='hidden' name='poista_id'
value='$ilmoitus_id'><input type='submit' value='Poista'></form><form
action='muokkaailmoitus.php' method='post'/><input type='hidden'
name='muokkaa_id' value='$ilmoitus_id'><input type='submit'
value='Muokkaa'></form></td></tr>";
}

echo "</table></p>";
$i++;

}
if($i == 0) {
echo "<p>Ilmoituksia ei löytynyt!</p>";
}
// ilmoitusten tuonti kommentin yläpuolelle.

echo "<h3>Ilmoitukset:</h3>";

echo "Hae ilmoituksia:<br> <form action='haeilmoitus.php' method='post'><input
name='haku' type='text'><input type='submit' name='submit' value='Hae'></form></p>";

?>
