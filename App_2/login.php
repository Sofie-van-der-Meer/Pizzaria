<?php
declare(strict_types=1);
session_start();
spl_autoload_register();
use Business\KlantService;
use Exceptions\WachtwoordIncorrectException;
use Exceptions\GebruikerBestaatNietException;

$error = "";

if (isset($_POST["btnLogin"])) 
{
    $email = "";
    $wachtwoord = "";
    
    if (!empty($_POST["txtEmail"])) 
    {
        $email = $_POST["txtEmail"];
    } else 
    {
        $error .= "Het e-mailadres moet ingevuld worden.<br>";
    }
    if (!empty($_POST["txtWachtwoord"])) 
    {
        $wachtwoord = $_POST["txtWachtwoord"];
    } else 
    {
        $error .= "Het wachtwoord moeten ingevuld worden.<br>";
    }
    if ($error == "") 
    {
        try 
        {
            $klantService = new KlantService();
            $klantId = $klantService->loginKlant();
            $_SESSION["gebruiker"] = $klantId;


        } catch (WachtwoordIncorrectException $e) 
        {
            $error .= "Het wachtwoord is niet correct.<br>";
        } catch (GebruikerBestaatNietException $e) 
        {
            $error .= "Er bestaat geen gebruiker met dit e-mailadres.<br>";
        }
    }
}

$echo = "";
if ($error == "" && isset($_SESSION["gebruiker"])) {
    $echo = "U bent succesvol ingelogd.";
    header('location: afrekenen.php');
    exit;
} else if ($error != "") {
    $echo = "<span style=\"color:red;\">" . $error . "</span>";
}

include("Presentation/inlogForm.php");
?>