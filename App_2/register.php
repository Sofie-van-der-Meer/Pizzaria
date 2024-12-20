<?php
declare(strict_types=1);
session_start();

spl_autoload_register();
use Business\KlantService;
use Exceptions\OngeldigEmailadresException;
use Exceptions\WachtwoordenKomenNietOvereenException;
use Exceptions\GebruikerBestaatAlException;

$service = new KlantService();
$plaatsLijst = $service->getAllPlaces();
$error = "";

if (isset($_POST["btnRegistreer"])) 
{
    // KLANTGEGEVENS CONTROLEREN
    $voornaam = "";
    $achternaam = "";
    $straatnaam = "";
    $huisnummer = "";
    $bus = "";
    $plaatsId = "";
    $telefoonnummer = "";
    
    $email = "";
    $wachtwoord = "";
    $wachtwoordHerhaal = "";

    if (!empty($_POST["txtVoornaam"]))
    {
        $voornaam = $_POST["txtVoornaam"];
    } else
    {
        $error .= "De voornaam moet ingevuld worden.<br>";
    }

    if (!empty($_POST["txtAchternaam"]))
    {
        $achternaam = $_POST["txtAchternaam"];
    } else
    {
        $error .= "De achternaam moet ingevuld worden.<br>";
    }

    if (!empty($_POST["txtStraatnaam"]))
    {
        $straatnaam = $_POST["txtStraatnaam"];
    } else
    {
        $error .= "De straatnaam moet ingevuld worden.<br>";
    }

    if (!empty($_POST["txtHuisnummer"]))
    {
        $huisnummer = $_POST["txtHuisnummer"];
    } else
    {
        $error .= "Het huisnummer moet ingevuld worden.<br>";
    }

    if (!empty($_POST["txtBus"]))
    {
        $bus = $_POST["txtBus"];
    }

    if (!empty($_POST["idPlaats"]))
    {
        $plaatsId = $_POST["idPlaats"];
    } else
    {
        $error .= "Een plaatsnaam moet aangeduid worden.<br>";
    }

    if (!empty($_POST["nrTelefoonnummer"]))
    {
        $telefoonnummer = $_POST["nrTelefoonnummer"];
    } else
    {
        $error .= "Het telefoonnummer moet ingevuld worden.<br>";
    }
    
    if (!empty($_POST["txtEmail"])) 
    {
        $email = $_POST["txtEmail"];
    } else 
    {
        $error .= "Het e-mailadres moet ingevuld worden.<br>";
    }
    if (!empty($_POST["txtWachtwoord"]) && 
    !empty($_POST["txtWachtwoordHerhaal"])) 
    {
        $wachtwoord = $_POST["txtWachtwoord"];
        $wachtwoordHerhaal = $_POST["txtWachtwoordHerhaal"];
    } else 
    {
        $error .= "Beide wachtwoordvelden moeten ingevuld worden.<br>";
    }
    if ($error == "") 
    {
        try 
        {
            $klantService = new KlantService();
            $gebruiker = $klantService->createNewKlant();
            $_SESSION["gebruiker"] = $gebruiker;
        } catch (OngeldigEmailadresException $e) 
        {
            $error .= "Het ingevulde e-mailadres is geen geldig e-mailadres.<br>";
        } catch (GebruikerBestaatAlException $e)
        {
            $error .= "Er is al een acount op dit e-mailadres.<br>";
        } catch (WachtwoordenKomenNietOvereenException $e) 
        {
            $error .= "De ingevulde wachtwoorden komen niet overeen.<br>";
        } catch (GebruikerBestaatAlException $e) 
        {
            $error .= "Er bestaat al een gebruiker met dit e-mailadres.<br>";
        }
    }
}

$echo = "";
if ($error == "" && isset($_SESSION["gebruiker"])) {
    $echo = "U bent succesvol geregistreerd.";
    header('location: afrekenen.php');
    exit;
} else if ($error != "") {
    $echo = "<span style=\"color:red;\">" . $error . "</span>";
}



include("Presentation/registerForm.php");
?>