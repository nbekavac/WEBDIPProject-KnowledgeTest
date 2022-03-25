<?php
    if(isset($_POST["submit"])){
        require './baza.class.php';
        $veza = new Baza();
        $pitanje=$_POST["pitanje"];
        $odgovor= $_POST["odgovor"];
        $id1=$_POST["id"];
        $veza->spojiDB();
        $upitNatjecanja="INSERT INTO pitanja VALUES(default,'$pitanje','$odgovor','$id')";
        $rezultatNatjecanja=$veza->updateDB($upitNatjecanja);
        $veza->zatvoriDB();
        header("Location: pitanjeiodgovor.php");
}   
?>