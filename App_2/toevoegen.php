<?php
declare(strict_types=1);
session_start();

spl_autoload_register();
use Business\PizzaService;
use Business\BestelService;

$pizzaSrv = new PizzaService();
$bestellingSrv = new BestelService();

// controleer of de pizza nog niet in de lijst staat
if (!in_array($_GET["id"], $_SESSION["card"]))
{
    array_push($_SESSION["card"], $_GET["id"]);
    array_push($_SESSION["qty_array"], 1);
} else
{
    $key = array_search($_GET["id"], $_SESSION["card"]);
    $_SESSION["qty_array"][$key] += 1;
}

if (isset($_SESSION["afrekenen"]) && $_SESSION["afrekenen"] === 'ja')
{
    header("location: afrekenen.php");
    exit;
}
header("location: index.php");
exit;

