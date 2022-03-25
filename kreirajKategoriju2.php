<?php
if (isset($_GET['submit'])) {
    $kategorija=$_GET["kategorija"];
    echo $kategorija=$_GET["kategorija"];
    require "./baza.class.php";
    $veza = new Baza();
    $veza->spojiDB();
    $upit2="INSERT INTO kategorija VALUES ( default , '$kategorija' , 41)";
    $rezultat2=$veza->updateDB($upit2);
    $veza->zatvoriDB();
    header("Location: kreirajKategoriju.php");
}
?>