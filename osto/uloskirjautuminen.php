<?php
session_start();
include("kantayhteys.php");
?>
<?php
ini_set('display_errors', 1);	   //poista tai kommentoi nämä rivit, kun sivusto toimii
ini_set('display_startup_errors', 1);   //poista tai kommentoi nämä rivit, kun sivusto toimii
error_reporting(E_ALL);	 //poista tai kommentoi nämä rivit, kun sivusto toimii

header("Content-Type: text/html; charset=utf-8");
if($_SESSION['LOGGEDIN'] == 1) {

/* Tähän väliin tulee Destroy a PHP Session komennot (kaksi komentoa), joilla määritellään istunto loppuneeksi*/
echo "Uloskirjautuminen onnistui! <a href='kirjautuminen.html'>Kirjaudu</a>
uudelleen sisään tai <a href='index.php'>palaa etusivulle</a>.";
}
?>
