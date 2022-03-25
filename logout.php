<?php
include_once('aplikacijskiOkvir.php');

echo "Uspjesna odjava";
Sesija::obrisiSesiju();
if (isset($_POST['pocetna'])) {
    header("Location: index.php");
}
/*header("Location: index.php");*/
?>
<form method="post"><input type="submit" name="pocetna" id="pocetna" value="Vrati se na pocetnu stranicu"></form></h2>