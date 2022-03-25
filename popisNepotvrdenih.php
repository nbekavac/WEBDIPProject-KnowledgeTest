<?php
require "./baza.class.php";

    if(isset($_COOKIE["korisnicko_ime"]))
    {
        $imeKorisnika = $_COOKIE["korisnicko_ime"];
    }


    function dohvatiKorisnika()
    {
        if(isset($_COOKIE["korisnicko_ime"]))
        {
            $korisnik = $_COOKIE["korisnicko_ime"];
        }

        $veza = new Baza();
        $veza->spojiDB();
        $sql = "SELECT * FROM korisnici WHERE '$korisnik'=korisnicko_ime";
        $rezultat=$veza->selectDB($sql);
        $korisnik = mysqli_fetch_array($rezultat)["korisnik_id"];
        $veza->zatvoriDB();
        return $korisnik;
    }

    function dohvatiSlike()
    {
        $slike = [];
        $korisnik = dohvatiKorisnika();
        $veza = new Baza();
        $veza->spojiDB();
        $sql = "SELECT slika FROM oglasi where korisnici_korisnik_id = '$korisnik' and status = 1";
        $rezultat = $veza ->selectDB($sql);
        while(list($naziv) = $rezultat->fetch_array())
        {
            $slike[]=$naziv;
        }
        $veza->zatvoriDB();
        return $slike;
    }

    function dohvatiZaUredit($slika)
    {

        $veza = new Baza();
        $veza->spojiDB();
        $sql = "SELECT * FROM oglasi WHERE slika = '$slika'";
        $rezultat=$veza->selectDB($sql);
        $idOglasa = mysqli_fetch_array($rezultat)["oglasi_id"];
        $veza->zatvoriDB();
        return $idOglasa;
    }


?>
<!DOCTYPE html>
<html>
    <head>
            <title>FOI - Web dizajn i programiranje : HTML - Primjer broj 03</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="naslov" content="Početna stranica">
            <meta name="datum promjene" content="06.03.2018.">
            <meta name="autor" content="Nikola Bekavac">
            <link href="css/nbekavac.css" rel="stylesheet" type="text/css">
            <link href="css/nbekavac_prilagodbe.css" rel="stylesheet" type="text/css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
            <script src="js/nbekavac.js"></script>
            
        
        </head>
            <header>
                    <h1 class="zaglavlje">Projekt </h1>	
                    <h2 class="trenutna"><form method="post" action="logout.php"><input type="submit" name="odjava" id="odjava" value="Odjavi se"></form></h2>
                    <p style="padding-top:30px">
                    </p>

            </header>
            <nav >
                        <ul>
                             <li><a href="registrirani.php">Pocetna</a></li>
                            <li><a href="zahtjeviBlokiranje.php">Posalji zahtjev za blokiranje oglasa</a></li>
                            <li><a href="zahtjevNovi.php">Posalji zahtjev za kreiranje oglasa</a></li>
                            <li><a href="popisNepotvrdenih.php">Popis nepotvrdenih oglasa</a></li>

                        </ul>
            </nav>

<body>


<?php
$slike = [];
$slike = dohvatiSlike();

if(!empty($slike))
{
foreach($slike as $key => $value)
{
    
    $dirr = glob($value,GLOB_BRACE);
    $dirr=implode($dirr);
    $idOglasa=dohvatiZaUredit($dirr);

    ?>  
        <img src="<?php echo $dirr; ?>">  
        <form action="urediOglas.php" method="get">
        <br>
        <label>Status: Na cekanju<label>
        <input type="hidden" name="id" value="<?php echo "$idOglasa" ?>">
        <button type="submit"/>Uredi oglas</button>
        <br>        
        </form>
        <br>
    
    <?php
}
}
else
{
    echo "<p id=para>Nemate zahtjeva</p>";
}


?>


</body>

</html>