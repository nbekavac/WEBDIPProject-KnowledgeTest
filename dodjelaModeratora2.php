<?php
if (isset($_GET['submit'])) {
    $moderator=$_GET["korisnik"];
    echo $kategorija=$_GET["kategorija"];
    require "./baza.class.php";
    $veza = new Baza();
    $veza->spojiDB();
    $upit="SELECT korisnik_id FROM korisnici WHERE korisnici.korisnicko_ime='$moderator'";
    $rezultat=$veza->selectDB($upit);
    while($red=mysqli_fetch_array($rezultat)){
        echo $moderator_id=$red["korisnik_id"];
    }
    $veza->zatvoriDB();
    $veza->spojiDB();
    $upit1="SELECT kategorija_id FROM kategorija WHERE kategorija.naziv='$kategorija'";
    $rezultat1=$veza->selectDB($upit1);
    while($red1=mysqli_fetch_array($rezultat1)){
        echo $kategorija_id=$red1["kategorija_id"];
    }
    $upit2="INSERT INTO moderira VALUES ('$moderator_id' , '$kategorija_id')";
    $rezultat2=$veza->updateDB($upit2);
    $veza->zatvoriDB();
    header("Location: dodjelaModeratora.php");
}
?>