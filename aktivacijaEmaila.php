<?php
    require "./baza.class.php";
     $veza = new Baza();
     $veza->spojiDB();
     if (isset($_POST['submit'])) {
        $upit2 ="SELECT datum_pristupanja FROM korisnici WHERE korisnicko_ime='" . $_POST["korime"]. "'";
        $rezultat2=$veza->selectDB($upit2);
        $trenutniDatum = date("Y-m-d H:i:s");
        $trenutniDatum= date('Y-m-d H:i:s', strtotime($trenutniDatum . '-1 day'));
	    if($trenutniDatum<$rezultat2) {
             echo ("Korisnicki racun je aktiviran, sad se mozete prijaviti");
             $upit = "UPDATE korisnici set status = 'aktivan' WHERE korisnicko_ime='" . $_POST["korime"]. "'";          
             $rezultat = $veza->updateDB($upit);
             } else {
             echo ("Istekla aktivacija korisnickog racuna,potrebna ponovna registracija"); 
             }
        
    }
    if (isset($_POST['prijava1'])) {
        header("Location: prijava.php");
    }
    
   
?>
<html>
    <form   novalidate  id="aktivacijaEmaila" method="post" name="aktivacijaEmaila" 
                  action="">
    <label> Unesite korisnicko ime: </label>
    <input type="text" id="korime" name="korime"
       maxlength="30" placeholder="korisnicko ime"  
       ><br>
    <input type="submit" id="submit" name="submit" value="Unesi">
    <br><br><br>
    <form   novalidate  id="prijava" method="post" name="prijava" 
                  action="">
    <input type="submit" id="prijava1" name="prijava1" value="Prijavite se">
</html>


