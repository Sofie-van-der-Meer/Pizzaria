<?php
declare(strict_types=1);
session_start();

spl_autoload_register();
use Business\PizzaService;

$pizzaService = new PizzaService();
$pizzaLijst = $pizzaService->getAllPizza();


include("Presentation/home.php");

if(!isset($_SESSION["card"]))
{
    $_SESSION["card"] = array();
    if (!isset($_SESSION["qty_array"]))
    {
        $_SESSION["qty_array"] = array();
    }
} else
{
    if (!isset($_SESSION["qty_array"]))
    {
        $_SESSION["qty_array"] = array();
    }
    $card = $_SESSION["card"];
    $qty = $_SESSION["qty_array"];
    if (!empty($card))
    {
        include("Presentation/card.php");
    }
}