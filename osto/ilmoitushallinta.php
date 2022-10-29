<?php
session_start();
include("kantayhteys.php");
header("Content-Type: text/html; charset=utf-8");

$sivu= $_POST['lomaketunnistin'];

// ilmoituksen lisäys

if($sivu == 1) {
$ilmoitus_laji = $_POST['ilmoitus_laji'];
$ilmoitus_nimi = $_POST['ilmoitus_nimi'];
$ilmoitus_kuvaus = $_POST['ilmoitus_kuvaus'];
$ilmoitus_paivays = $_POST['ilmoitus_paivays'];
$myyja_id = $_POST['myyja_id'];
if(!empty($ilmoitus_nimi) && !empty($ilmoitus_kuvaus)) {
mysqli_query($dbconnect,"INSERT INTO ilmoitukset (ilmoitus_laji, ilmoitus_nimi, ilmoitus_kuvaus, ilmoitus_paivays, myyja_id ) VALUES ('$ilmoitus_laji', '$ilmoitus_nimi', '$ilmoitus_kuvaus', '$ilmoitus_paivays', '$myyja_id')");
echo "Ilmoituksen lisääminen onnistui! Palaa <a href='index.php'>etusivulle</a>.";
} 
else {
echo "Jätit tietoja täyttämättä. Ole hyvä ja <a href='lisaailmoitus.php'>täytä lomake uudestaan</a>.";
}
mysqli_close($dbconnect);
}

if($sivu == 2) {
    $ilmoitus_id = $_POST['ilmoitus_id'];
    $ilmoitus_uusilaji = $_POST['ilmoitus_uusilaji'];
    $ilmoitus_uusinimi = $_POST['ilmoitus_uusinimi'];
    $ilmoitus_uusikuvaus = $_POST['ilmoitus_uusikuvaus'];
    
    if(!empty($ilmoitus_uusinimi) AND !empty($ilmoitus_uusikuvaus)) {
        
    mysqli_query($dbconnect,"UPDATE ilmoitukset SET ilmoitus_laji = '$ilmoitus_uusilaji', ilmoitus_nimi = '$ilmoitus_uusinimi', ilmoitus_kuvaus = '$ilmoitus_uusikuvaus' WHERE ilmoitus_id = '$ilmoitus_id'");
    echo "Ilmoituksen muokkaaminen onnistui! Palaa <a href='index.php'>etusivulle</a>.";
    } 
    else {
    echo "Jätit kenttiä tyhjiksi. <a href='index.php'>Palaa etusivulle</a>ja muokkaa ilmoitusta uudestaan</a>.";
    }
    mysqli_close($dbconnect);
    }
?>
