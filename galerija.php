
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
    </head>

    <body>      
            <header>
			<h1  id="zadaca" class="zaglavlje">Zadaća 4 </h1>	
			<h2 class="trenutna">Datum: 16.03.2018.</h2>
			<p style="padding-top:30px" >
			<a  href="prijavaRegistracija.php?mod=prijava" class="prijava">Prijava</a><br></p>			
            </header>
            <nav >
			<ul>
                            <li><a href="index.html">Početna</a></li>
                            <li><a href="galerija.php">Galerija</a></li>
                            <li><a href="prijavaRegistracija.php?mod=prijava">Prijava</a></li>
                            <li>
                            <a href="prijavaRegistracija.php?mod=registracija">Registracija</a>
                            </li>
                            <li><a href="obrazac.php">Obrazac</a></li>
                            <li><a href="tablica.php">Tablica</a>
                            
			</ul>
				</nav>
                                 
            <section  style= "padding-top: 20px; ">
                
                <?php
                    require './baza.class.php';
                    $veza = new Baza();
                    $veza->spojiDB();
                    $upit="SELECT * FROM obrazac";
                    $rezultat = $veza->selectDB($upit);
                    while($red = mysqli_fetch_array($rezultat)){
                        echo '<figure syle="float:left"><img src="slike/' . $red["naziv_slike"] . '" alt="' . $red["naziv_slike"] . '" class="zoom"><figcaption>' . $red["naziv_slike"] . '</figcaption></figure>';
                        
                    }
                    $veza->zatvoriDB();
                ?>
				
                    <p style="padding-top:150px;">
                        <article style="float:left" >
                            <iframe src="https://www.youtube.com/embed/LqGMEN8XBWY"></iframe>
                            <p> Najbolji golovi PL 2016/17</p>
			</article>
			<article style="float:left" >
                            <iframe src="https://www.youtube.com/embed/bIVastezmk8"></iframe>
                            <p> Najbolji golovi PL opcenito </p>
			</article>
			<article style="float:left" >
				<iframe src="https://www.youtube.com/embed/XjY5iJXAv9I"></iframe>
				<p> Najbolji domaci golovi </p>m/embed/9fk7Fowv9G8"></iframe>
				<p> Najbolje obrane </p>
			</article>
			<article style="padding-left:500px;">
			</article>
			<article style="float:left" >
				<iframe src="https://www.youtube.com/embed/9fk7Fowv9G8"></iframe>
				<p> Najbolje obrane </p>
			</article>
			<article style="padding-left:500px;">>
			</article>				         
            </section>
			
            <footer style=" padding-top:50px;">
		<figure style="float:left">
                    <a href="http://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2017/zadaca_01/nbekavac/galerija.html">
                     <img src="multimedija/HTML5.png"  width="70" height="50" />
                    </a>
                    <figcaption>HTML</figcaption>
                </figure>
                <figure style="float:left">
                    <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2017/zadaca_01/nbekavac/galerija.html">
                        <img src="multimedija/CSS3.png"  width="70" height="50"  />
                    </a>
                    <figcaption>CSS3</figcaption>
                </figure>
		<h3 class="footer" > Vrijeme rjesavanja: 6 sati </h3>
		</footer>          
            
       
    </body>
</html>
