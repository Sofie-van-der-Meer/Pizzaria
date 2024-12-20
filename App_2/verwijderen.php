<?php
declare(strict_types=1);
session_start();

spl_autoload_register();
use Business\PizzaService;
use Business\BestelService;

$pizzaSrv = new PizzaService();
$bestellingSrv = new BestelService();

// bestaat get id, verwijder array element met die id
if (isset($_GET["index"]))
{
    $key = $_GET["index"];
    if ($_SESSION["qty_array"][$key] > 1)
    {
        $_SESSION["qty_array"][$key] -= 1;
    } else
    {
        unset($_SESSION["card"][$key]);
        unset($_SESSION["qty_array"][$key]);
    }
    if (empty($_SESSION["card"]))
    {
        unset($_SESSION["card"]);
        unset($_SESSION["qty_array"]); 
        unset($_SESSION["afrekenen"]);
        header("location: index.php");
        exit;  
    }
}

if (isset($_GET["all"]) && $_GET["all"] === 'card')
{
    unset($_SESSION["card"]);
    unset($_SESSION["qty_array"]); 
    unset($_SESSION["afrekenen"]);
    header("location: index.php");
    exit;  
}

if (isset($_SESSION["afrekenen"]) && $_SESSION["afrekenen"] === 'ja')
{
    header("location: afrekenen.php");
    exit;
}
header("location: index.php");
exit;