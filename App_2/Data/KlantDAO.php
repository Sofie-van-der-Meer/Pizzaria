<?php
declare(strict_types=1);

namespace Data;
use PDO;
use Entities\Klant;
use Entities\Plaats;
use Exceptions\GebruikerBestaatAlException;
use Exceptions\OngeldigEmailadresException;
use Exceptions\WachtwoordenKomenNietOvereenException;
use Exceptions\GebruikerBestaatNietException;
use Exceptions\WachtwoordIncorrectException;

class KlantDAO
{
    // CREATE
    public function create()
    {
        $voornaam   = $_POST["txtVoornaam"];
        $achternaam = $_POST["txtAchternaam"];
        $straatnaam = $_POST["txtStraatnaam"];
        $huisnummer = $_POST["txtHuisnummer"];
        $bus        = $_POST["txtBus"];
        $plaats     = (int)$_POST["idPlaats"];
        $telefoonnummer = $_POST["nrTelefoonnummer"];
        $email      = "";
        $wachtwoord = "";

        // CONTROLEER EMAIL
        if (!filter_var($_POST["txtEmail"], FILTER_VALIDATE_EMAIL)) 
        {
            throw new OngeldigEmailadresException();
        }
        $email = $_POST["txtEmail"];

        // CONTROLEER WACHTWOORD
        if ($_POST["txtWachtwoord"] !== $_POST["txtWachtwoordHerhaal"]) 
        {
            throw new WachtwoordenKomenNietOvereenException();
        }
        $wachtwoord = password_hash($_POST["txtWachtwoord"], PASSWORD_DEFAULT);

        // CONTROLEER DUPLICAAT
        $rowCount = $this->emailReedsInGebruik($email);
        if ($rowCount > 0) 
        {
            throw new GebruikerBestaatAlException();
        }

        // CREATE NEW USER
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, 
        DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare("INSERT INTO klanten (
            voornaam, achternaam,
            straatnaam, huisnummer, bus, plaatsId,
            telefoonnummer,
            email, wachtwoord
            ) 
            VALUES (
            :voornaam, :achternaam,
            :straatnaam, :huisnummer, :bus, :plaats,
            :telefoonnummer,
            :email, :wachtwoord
            )");
        $stmt->execute(
            [
                ':voornaam'   => $voornaam,
                ':achternaam' => $achternaam,
                ':straatnaam' => $straatnaam,
                ':huisnummer' => $huisnummer,
                ':bus'        => $bus,
                ':plaats'     => $plaats,
                ':telefoonnummer' => $telefoonnummer,
                ':email'      => $email,
                ':wachtwoord' => $wachtwoord,
            ]
        );
        // $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $userId = $dbh->lastInsertId();
        // $resultSet["klantId"];
        $dbh = null;
        return (int)$userId;
    }
    // READ
    public function emailReedsInGebruik($email)
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, 
        DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare("SELECT * FROM klanten WHERE email = :email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $rowCount = $stmt->rowCount();
        $dbh = null;
        return $rowCount;
    }

    public function login()
    {
        $email = $_POST["txtEmail"];
        $wachtwoord = $_POST["txtWachtwoord"];

        // CONTROLEER DUPLICAAT
        $rowCount = $this->emailReedsInGebruik($email);
        if ($rowCount == 0) 
        {
            throw new GebruikerBestaatNietException();
        }

        // LOGIN
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, 
        DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare("SELECT * FROM klanten WHERE email = :email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);
        $isWachtwoordCorrect = password_verify($wachtwoord, $resultSet["wachtwoord"]);
        if (!$isWachtwoordCorrect)
        {
            throw new WachtwoordIncorrectException();
        }
        $userId = $resultSet["klantId"];
        $dbh = null;
        return $userId;
    }

    public function klantById(int $klantId) : Klant
    {
        $sql = "SELECT klantId, voornaam, achternaam, 
                straatnaam, huisnummer, bus, 
                plaatsen.plaatsId, postcode, plaatsnaam, 
                telefoonnummer, email, wachtwoord
                FROM klanten, plaatsen
                WHERE klantId = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING,
        DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            ':id' => $klantId,
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $plaats = Plaats::create((int)$row["plaatsId"], $row["postcode"], $row["plaatsnaam"]);
        $klant = new Klant((int)$row["klantId"], $row["voornaam"], $row["achternaam"], 
            $row["straatnaam"], $row["huisnummer"], $row["bus"], $plaats, 
            $row["telefoonnummer"], $row["email"], $row["wachtwoord"]);
        $dbh = null;
        return $klant;
    }

    public function klantBestaatAl($id)
    {
        $sql = "SELECT * FROM klanten WHERE klantId = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, 
        DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $rowCount = $stmt->rowCount();
        $dbh = null;
        return $rowCount;
    }
    // UPDATE
    public function update()
    {
        $sql = "UPDATE klanten SET 
            voornaam = :voornaam, 
            achternaam = :achternaam, 
            straatnaam = :straatnaam, 
            huisnummer = :huisnummer, 
            bus = :bus, 
            plaatsId = :plaatsId,
            telefoonnummer = :telefoonnummer
            WHERE klantId = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, 
        DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            ':voornaam' => $_POST["txtVoornaam"],
            ':achternaam' => $_POST["txtAchternaam"],
            ':straatnaam' => $_POST["txtStraatnaam"],
            ':huisnummer' => $_POST["txtHuisnummer"],
            ':bus' => $_POST["txtBus"],
            ':plaatsId' => $_POST["idPlaats"],
            ':telefoonnummer' => $_POST["nrTelefoonnummer"],
            ':id' => $_SESSION["gebruiker"],
        ]);
        $dbh = null;
    }
    // DELETE
}