<?php
if(isset($_GET["submit"])){
                $natjecanje= $_GET["natjecanje"];
}

                require './baza.class.php';
                $veza = new Baza();
                $veza->spojiDB();
                $upitNatjecanja="INSERT INTO pitanja VALUES(default,'$pitanje','$odgovor','$id')";
                echo $upitNatjecanja;
                $rezultatNatjecanja=$veza->updateDB($upitNatjecanja);
                $veza->zatvoriDB();
                echo "Upit izvrsen";
?>