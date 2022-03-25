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

    function dohvatiVrste()
    {
        $veza = new Baza();
        $veza->spojiDB();
        $sql = "SELECT id,naziv FROM vrste_oglasa";
        $rezultat = $veza ->selectDB($sql);
        while(list($id,$imena) = $rezultat->fetch_array())
        {
            $vrste[$id]=$id." ".$imena;
        }
        $veza->zatvoriDB();
        return $vrste;
    }


    function unesiPodatke()
        {
            if(isset($_GET['naziv']))
        {
            $naslov = $_GET['naziv'];
        }
        if(isset($_GET['opis']))
        {
            $opis = $_GET['opis'];
        }
        if(isset($_GET['url']))
        {
            $url = $_GET['url'];
        }
        if(isset($_GET['slika']))
        {
            $slika = $_GET['slika'];
        }
        if(isset($_GET['status']))
        {
            $status = $_GET['status'];
        }
        if(isset($_GET['vrijeme_aktivnosti']))
        {
            $datum_otvaranja = $_GET['vrijeme_aktivnosti'];
        }
        if(isset($_GET['vrste_oglasa']))
        {
            $vrsta_oglasa = $_GET['vrste_oglasa'];
        }
       
        $korisnik = dohvatiKorisnika();
        $vrijeme = date("Y-m-d H:i:s");
        
        $veza = new Baza();
        $veza->spojiDB();
        $sql = "INSERT INTO oglasi (naziv,opis,url,slika,status,vrijeme_aktivnosti,vrste_oglasa_id,korisnici_korisnik_id) VALUES ('$naslov','$opis','$url','$slika','$status','$vrijeme','$vrsta_oglasa','$korisnik')";
        $rezultat = $veza ->updateDB($sql);
        $veza->zatvoriDB();
        if($rezultat==true)
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }


?>
<!DOCTYPE html>
<html>

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
            <p style="padding-top:30px"></p>

    </header>
            <nav>
                    <ul>
                        <li><a href="registrirani.php">Pocetna</a></li>
                        <li><a href="zahtjeviBlokiranje.php">Posalji zahtjev za blokiranje oglasa</a></li>
                        <li><a href="zahtjevNovi.php">Posalji zahtjev za kreiranje oglasa</a></li>
                        <li><a href="popisNepotvrdenih.php">Popis nepotvrdenih oglasa</a></li>
                    </ul>
            </nav>
            <body>
                <div>
                <h2 id="sadrzaj2" >Unesi zahtjev</h2>
                <form style="text-align:center" id="formaRegistracije" action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="get">
                    <label>Naslov</label>
                    <input  id="naslov"  type="text" placeholder="Unesite naslov"  name="naziv"><br>
                    <label>Opis</label>
                    <input  id="opis"  type="textarea"  placeholder="Unesite opis"   name="opis"> 
                    <br>
                    <label>URL</label>
                    <input  id="url"  type="datetime" placeholder="Unesite url"   name="url"/>
                    <br>
                    <select name="vrste_oglasa">
                    <option selected="selected">Izaberite vrstu</option>
                        <?php
                                $vrste = dohvatiVrste();
                                foreach($vrste as $key => $value) 
                                { ?>
                                  <option value="<?php echo $key ?>"><?= $value ?></option>
                        <?php
                                } ?>
                    </select>
                    <br>
                    <label for="slika">Slika</label>
                    <input  id="slika"  type="text" placeholder="Unesite ime slike"   name="slika"/>
                    <br>
                    <input  id="status"  type="hidden" value="1"  name="status"><br>
                    <button name="unos" type="submit">Posalji zahtjev</button>
                    <br>
                    <button type="reset"  value="Reset">Očisti sve</button>


                </form> 


<?php
if(isset($_GET["unos"]))
{
 
    if(unesiPodatke())
    {
        $potvrdaUnosa = "Uspjesno ste poslali zahtjev!";
        echo "<script type='text/javascript'>alert('$potvrdaUnosa');</script>"; 
    
    }
    else
    {
        $greska = "PHP: Korisnice, dogodila se greska";
        echo "<script type='text/javascript'>alert('$greska');</script>";
    }
} 


?>
       
</body>

</html>