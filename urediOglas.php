<?php
require "./baza.class.php";


    if(isset($_COOKIE["korisnicko_ime"]))
    {
        $imeKorisnika = $_COOKIE["korisnicko_ime"];
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
            //$korisnici[]=$imena;
        }
        $veza->zatvoriDB();
        return $vrste;
    }

    function dohvatiPodatke()
    {
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
        }
        $veza = new Baza();
        $veza->spojiDB();
        $sql = "SELECT * FROM oglasi WHERE oglasi_id = '$id'";
        $rezultat = $veza ->selectDB($sql);
        $veza->zatvoriDB();
        return $rezultat;
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
    if(isset($_GET['vrste_oglasa']))
    {
        $vrsta_oglasa = $_GET['vrste_oglasa'];
    }
   
    if(isset($_GET['id']))
        {
            $id = $_GET['id'];
        }
        
    $veza = new Baza();
    $veza->spojiDB();
    $sql = "UPDATE oglasi SET naziv='$naslov', opis='$opis', url='$url', slika = '$slika', vrste_oglasa_id = '$vrsta_oglasa' where oglasi_id = $id";
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
$rezultat = dohvatiPodatke();
while($row = mysqli_fetch_array($rezultat))
        {
            $naslov=$row["naziv"];
            $opis = $row['opis'];
            $url = $row["url"];
            $slika = $row["slika"];
            $vrsta = $row["vrste_oglasa_id"];            
        } 
?>
        <div>
        <h2 id="sadrzaj2" >Promjeni oglas</h2>
        <form id="formaRegistracije" action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="get">
      
            
            <label for="naslov" ><b>Naslov</b></label>
            <input  id="naslov"  type="text" placeholder="Unesite naslov" value="<?php echo $naslov ?>"   name="naziv"/>
            
            <br>
            
            <label for="opis" ><b>Opis</b></label>
            <input  id="opis"  type="textarea"  placeholder="Unesite opis" value="<?php echo $opis ?>"  name="opis"/>
            
            <br>
            

            <label for="url" ><b>URL</b></label>
            <input  id="url"  type="datetime" placeholder="Unesite url" value="<?php echo $url ?>"  name="url"/>
            <br>

            <select name="vrste_oglasa">
            <option selected="<?php $vrsta ?>">Izaberite vrstu</option>
                <?php
                        $vrste = dohvatiVrste();
                        foreach($vrste as $key => $value) 
                        { ?>
                          <option value="<?php echo $key ?>"><?= $value ?></option>
                <?php
                        } ?>
            </select>
            <br>

            <label for="slika" ><b>Slika</b></label>
            <input  id="slika"  type="text" placeholder="Unesite ime slike"  value="<?php echo $slika ?>"  name="slika"/>
            <br>
            <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
            }
            ?>

            <input  type="hidden" value="<?php echo $id ?>"  name="id"/>

            <button name="unos" type="submit">Izmjeni oglas</button>
            <br>
            <button type="reset"  value="Reset">Očisti sve</button>



<?php
if(isset($_GET["unos"]))
{

    if(unesiPodatke())
    {
        $potvrdaUnosa = "PHP: Korisnice, uspjesno ste unijeli podatke u bazu!";
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