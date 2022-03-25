<?php
require '././baza.class.php';

if(isset($_GET["korime"]))
{
    $korime = $_GET["korime"];
}
  $veza = new Baza();
  $veza->spojiDB();
  $sql = "UPDATE korisnici SET broj_zabrana = 0 where korisnicko_ime = '$korime'";
  $rezultat = $veza -> updateDB($sql);
  $veza->zatvoriDB();

  header("Location: adminKorisnici.php");


?>