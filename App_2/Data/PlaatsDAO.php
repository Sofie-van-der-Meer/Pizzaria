<?php
declare(strict_types=1);

namespace Data;
use PDO;
use Exceptions\PlaatsnaamBestaatAlException;
use Data\DBConfig;
use Entities\Plaats;

class PlaatsDAO 
{
    // CREATE
    public function create()
    {
        $bestaandePlaats = $this->getByPlaatsnaam();
        if (!is_null($bestaandePlaats))
        {
            throw new PlaatsnaamBestaatAlException();
        }
        $sql = "INSERT INTO plaatsen (postcode, plaatsnaam)
            VALUES (:postcode, :plaatsnaam)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING,
        DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            ':postcode' => $_POST["postcode"],
            ':plaatsnaam' => $_POST["plaatsnaam"],
        ]);
    }
    // READ
    public function getAll()
    {
        $sql = "SELECT plaatsId, postcode, plaatsnaam
            FROM plaatsen";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING,
        DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $row)
        {
            $plaats = Plaats::create(
                (int)$row["plaatsId"],
                $row["postcode"],
                $row["plaatsnaam"]);
            array_push($lijst, $plaats);
        }
        $dbh = null;
        return $lijst;
    }

    public function getById(int $id) : Plaats
    {
        $sql = "SELECT plaatsId, postcode, plaatsnaam
            FROM plaatsen
            WHERE plaatsId = :plaatsId";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING,
        DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            ':plaatsId' => $id,
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $plaats = Plaats::create(
            (int)$row["plaatsId"],
            $row["postcode"],
            $row["plaatsnaam"]);
        $dbh = null;
        return $plaats;
    }

    public function getByPlaatsnaam() : ?Plaats
    {
        $sql = "SELECT plaatsId, postcode, plaatsnaam
            FROM plaatsen
            WHERE plaatsnaam = :plaatsnaam";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING,
        DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            ':plaatsnaam' => $_POST["plaatsnaam"],
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);   
        if (!$row) 
        {
            return null;
        } else
        {
            $plaats = Plaats::create(
                (int)$row["plaatsId"],
                $row["postcode"],
                $row["plaatsnaam"]);
            $dbh = null;
            return $plaats;
        }
    }

    // UPDATE
    // DELETE
    public function delete()
    {
        $sql = "DELETE FROM plaatsen
            WHERE plaatsId = :plaatsId";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING,
        DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            ':plaatsId' => (int)$_GET["id"],
        ]);
    }
}