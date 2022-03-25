<?php
define('ADMINISTRATOR', '0');
define('KORISNIK', '1');


include_once('korisnik.php');
include_once('baza.class.php');
include_once('sesija.class.php');
include_once('autentikacija.php');
include_once('provjeraKorisnika.php');
include_once('dnevnik.php');

$dbc = new Baza();
$dbc->spojiDB();
?>