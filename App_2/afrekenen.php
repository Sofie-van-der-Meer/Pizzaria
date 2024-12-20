<?php 
declare(strict_types=1);
session_start();

spl_autoload_register();
use Business\KlantService;
use Data\KlantDAO;
use Business\PizzaService;
use Business\BestelService;

$klantService = new KlantService();
$klantDAO = new KlantDAO();
$pizzaService = new PizzaService();
$plaatsLijst = $klantService->getAllPlaces();
$bestelService = new BestelService();

if (!isset($_SESSION["card"]))
{
    header("Location: index.php");
    exit;    
}

$_SESSION["afrekenen"] = 'ja';

if (!isset($_SESSION["gebruiker"])) {
    header("Location: login.php");
    exit;
}

if (isset($_SESSION["gebruiker"]) &&
    isset($_SESSION["card"]) &&
    isset($_SESSION["qty_array"])
)
{
    if (isset($_POST["changeKlantgegevens"]))
    {
        $klantService->updateKlant();
    }
    $gebruikerId = $_SESSION["gebruiker"];
    $gebruiker = $klantService->getKlantById($gebruikerId);
    $plaatsGebruiker = $gebruiker->getPlaats();
    $card = $_SESSION["card"];
    $qty = $_SESSION["qty_array"];


    if (isset($_POST["bestellingAfronden"]))
    {
        $bestelService->createNewBestelling();
        foreach ($card as $row)
        {
            $index = array_search($row, $card);
            $row = intval($row);
            $bestelService->createNewBestellijn($row, $qty[$index]);
        }
        unset($_SESSION["card"]);
        unset($_SESSION["qty_array"]); 
        unset($_SESSION["afrekenen"]);
        header("location: bestelling.php");
        exit;
    } else 
    {
        include("Presentation/privatePage.php");
        include('Presentation/card.php');        
    }
}


