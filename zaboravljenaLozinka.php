
<?php
    function generirajKod()
    {
        $znakoviGeneriranja = '0123456789abcdefghijklmnjOPRSTUVZ';
        $duljina = strlen($znakoviGeneriranja);
        $kod = '';
        for($i=0;$i<$duljina;$i++)
        {
            $kod .= $znakoviGeneriranja[rand(0,$duljina-1)];
        }
        
        return $kod;
    }
    require './baza.class.php';
    $veza = new Baza();
    $veza->spojiDB();
    if (isset($_POST['submit'])) {
        $korisnicko_ime=$_POST['korime'];
        $email=$_POST['email'];
        $upitZaboravljena="SELECT * FROM korisnici WHERE korisnicko_ime ='$korisnicko_ime' AND email ='$email' " ;
        $rezultatZaboravljena=$veza->selectDB($upitZaboravljena); 
        $red=mysqli_fetch_array($rezultatZaboravljena);
        if(!empty($red)){
            $generirani_kod = generirajKod();
            $salt = sha1(time());
            $kriptirani_generirani_kod=sha1($salt."--".$generirani_kod);
            $upitZaboravljena="UPDATE korisnici set lozinka='$generirani_kod' WHERE korisnicko_ime='$korisnicko_ime'";
            $rezultatZaboravljena=$veza->updateDB($upitZaboravljena);
            $upitZaboravljenaKriptirano="UPDATE korisnici set kriptirano='$kriptirani_generirani_kod' WHERE korisnicko_ime='$korisnicko_ime'";
            $rezultatZaboravljenaKriptirano=$veza->updateDB($upitZaboravljenaKriptirano);
            $toEmail = $email;
            $subject = "Aktivacijski Mail";
            $content = "Ovo je Vasa nova lozinka : ". $generirani_kod. "";
            $mailHeaders = "From: Admin\r\n";
            if(mail($toEmail, $subject, $content, $mailHeaders)) {
                 echo $message = "Nova generirana lozinka je poslana na Vas email.";	
                }
                
        }
        else{
            echo "Krivo korisnicko ime ili email";
        }

    }
?>
<html>
    <form   novalidate  id="zaboravljenaLozinka" method="post" name="zaboravljenaLozinka" 
            action="">
    <label> Unesite korisnicko ime: </label>
    <input type="text" id="korime" name="korime"
       maxlength="30" placeholder="korisnicko ime"  
       ><br>
    <label> Unesite email: </label>
    <input type="text" id="email" name="email"
       maxlength="30" placeholder="email"  
       ><br>
    <input type="submit" id="submit" name="submit" value="Unesi">
</html>