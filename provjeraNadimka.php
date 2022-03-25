<?php
require "./baza.class.php";
$veza = new Baza();
$veza->spojiDB();
    $nadimak=($_POST["nadimak"]);
    $provjeraNadimka="SELECT *  FROM sudjelovanja_na_natjecanjima WHERE sudjelovanja_na_natjecanjima.nadimak='$nadimak' " ;
    $rezultatNadimak= $veza->selectDB($provjeraNadimka);
    $brojac=mysqli_num_rows($rezultatNadimak);
    if($brojac>0){
        
        echo "Nadimak postoji";
    }
    else{
        echo "Nadimak ne postoji";
    }     

    
?>