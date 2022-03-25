<?php 
     
    function dobaviKategorijee(){
        if(isset($_COOKIE["korisnicko_ime"])){
            $korime=$_COOKIE["korisnicko_ime"];
       }
            require './baza.class.php';
            $veza = new Baza();
            $veza->spojiDB();
            $upitKategorija="SELECT kategorija.naziv FROM kategorija JOIN korisnici ON kategorija.korisnik_id=korisnici.korisnik_id WHERE korisnici.korisnicko_ime='$korime'";
            $rezultatKategorija=$veza->selectDB($upitKategorija);
            while(list($naziv)= $rezultatKategorija->fetch_array())
            {
                $kategorije[$naziv] = $naziv;
            }
            $veza->zatvoriDB();
            return $kategorije;
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
                            <li><a href="popisBlokiranje.php">Popis zahtjeva za blokiranjem</a></li>                          
                            <li><a href="popisKategorija.php">Definiraj pitanje i tocan odgovor za kategoriju</a></li>
                            <li><a href="popisKategorija2.php">Kreiraj natjecanje</a></li>
                        </ul>
            </nav>
            <form class="obrazac" id="kategorije" method="get"  action="kreirajNatjecanje.php">
                <label>Odaberi kategoriju za koju zelis kreirat natjecanje</label>
                <select name="naziv_kategorije">
                <option selected="selected">Izaberite kategoriju</option>
                        <?php
                                $korisnici = dobaviKategorijee();
                                foreach($korisnici as $key => $value) 
                                { ?>
                                  <option value="<?php echo $key ?>"><?= $value ?></option>
                        <?php
                                } ?>
                    </select>
                    <br>                    
                    <br>
                    
                    <input type="submit" id="submit" value="Odaberi">               
                    </form>
                  
                    <br>                    
                    <br>