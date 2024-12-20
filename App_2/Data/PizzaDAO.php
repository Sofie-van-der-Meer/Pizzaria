<?php
declare(strict_types=1);

namespace Data;
use PDO;
use Exceptions\PizzaNaamBestaatAlException;
use Data\DBConfig;
use Entities\Pizza;

class PizzaDAO 
{
    // CREATE
    public function create()
    {
        $bestaandePizza = $this->getByPizzaNaam();
        if (!is_null($bestaandePizza))
        {
            throw new PizzaNaamBestaatAlException();
        }
        $sql = "INSERT INTO pizzas (pizzaNaam, prijs)
            VALUES (:pizzaNaam, :prijs)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING,
        DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            ':pizzaNaam' => $_POST["pizzaNaam"],
            ':prijs' => $_POST["prijs"],
        ]);
    }
    // READ
    public function getAll()
    {
        $sql = "SELECT pizzaId, pizzaNaam, prijs
            FROM pizzas";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING,
        DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $row)
        {
            $pizza = Pizza::create(
                (int)$row["pizzaId"],
                $row["pizzaNaam"],
                (float)$row["prijs"]);
            array_push($lijst, $pizza);
        }
        $dbh = null;
        return $lijst;
    }

    public function getById(int $id) : Pizza
    {
        $sql = "SELECT pizzaId, pizzaNaam, prijs
            FROM pizzas
            WHERE pizzaId = :pizzaId";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING,
        DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            ':pizzaId' => $id,
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $pizza = Pizza::create(
            (int)$row["pizzaId"],
            $row["pizzaNaam"],
            (float)$row["prijs"]);
        $dbh = null;
        return $pizza;
    }

    public function getByPizzaNaam() : ?Pizza
    {
        $sql = "SELECT pizzaId, prijs, pizzaNaam
            FROM pizzas
            WHERE pizzaNaam = :pizzaNaam";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING,
        DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            ':pizzaNaam' => $_POST["pizzaNaam"],
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);   
        if (!$row) 
        {
            return null;
        } else
        {
            $pizza = Pizza::create(
                (int)$row["pizzaId"],
                $row["pizzaNaam"],
                (float)$row["prijs"]);
            $dbh = null;
            return $pizza;
        }
    }

    // UPDATE
    // DELETE
    public function delete()
    {
        $sql = "DELETE FROM pizzas
            WHERE pizzaId = :pizzaId";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING,
        DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            ':pizzaId' => (int)$_GET["id"],
        ]);
    }
}