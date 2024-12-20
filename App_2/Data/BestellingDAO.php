<?php
declare(strict_types=1);

namespace Data;
use PDO;
use Data\DBConfig;
use Entities\Bestelling;
use Exceptions\LeveringsMomentKloptNietException;
use Data\KlantDAO;
use Exceptions\GebruikerBestaatNietException;

class BestellingDAO
{
    /**
     * private int $id;
     * private Klant $klantId;
     * private DateTime $bestelMoment;
     * private DateTime $leveringsmoment;
     * private string $extraInfo;
     */
    // CREATE
    public function create()
    {
        $t = $_SERVER['REQUEST_TIME'];
        // $id              
        $klantId         = $_SESSION["gebruiker"];
        $bestelMoment    = $t;
        $leveringsMoment = $t - ($t % 600) + 600 + ($_POST["extraTime"] * 60);
        $extraInfo       = $_POST["txtExtraInfo"];

        // CONTROLEER OF KLANT BESTAAT
        $klantDAO = new KlantDAO();
        $rowCount = $klantDAO->klantBestaatAl($klantId);
        if ($rowCount = 0)
        {
            throw new GebruikerBestaatNietException();
        }
        // CONTROLEER OF LEVERINGSMOMENT NA BESTELMOMENT KOMT
        if ($leveringsMoment < $bestelMoment)
        {
            echo 'tijden: ' . $bestelMoment . '<br>' . $leveringsMoment;
            throw new LeveringsMomentKloptNietException();
        }

        // CREATE NEW BESTELLING
        $sql = "INSERT INTO bestellingen 
            (klantId, bestelMoment, leverMoment, extraInfo)
            VALUES 
            (:klantId, :bestelMoment, :leverMoment, :extraInfo)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, 
        DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            ':klantId' => $klantId,
            ':bestelMoment' => date('Y-m-d H:i:s', $bestelMoment),
            ':leverMoment' => date('Y-m-d H:i:s', $leveringsMoment),
            ':extraInfo' => $extraInfo,
        ]);
        
        $bestellingId = $dbh->lastInsertId();
        $_SESSION["bestelling"] = $bestellingId;
        $dbh = null;
    }
    // READ
    // UPDATE
    // DELETE
}
