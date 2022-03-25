<?php
require "./baza.class.php";
$veza = new Baza();
$veza->spojiDB();
    $korisnickoIme=($_POST["korime2"]);
    $provjeraUnosa="SELECT  * FROM korisnici WHERE korisnici.korisnicko_ime='$korisnickoIme'"  ;
    $rezultatUnosa= $veza->selectDB($provjeraUnosa);
    /*$brojac=mysqli_num_rows($rezultatUnosa);*/
    $brojac=0;
    if($rezultatUnosa!=null){
        $brojac=mysqli_num_rows($rezultatUnosa);
        if($brojac>0){
            echo "Korisnik postoji";
        }
        else{
            echo "Korisnik ne postoji";
           
        }
    }
    else{
        echo "Korisnik ne postoji";
    }     

    
?>
