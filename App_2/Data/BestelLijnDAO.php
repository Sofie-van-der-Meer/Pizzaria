<?php
declare(strict_types=1);

namespace Data;
use PDO;
use Data\DBConfig;
use Entities\BestelLijn;
use Data\PizzaDAO;
use Exceptions\PizzaBestaatNietException;

class BestelLijnDAO
{
    /** LIST VARIABLES
     * private int $id;
     * private Bestelling $bestelId;
     * private Pizza $pizzaId;
     * private int $aantal;
     * private float $verkoopprijs;
     */

    // CREATE
    public function create(int $card_pizzaId, $qty_aantal)
    {
        $bestelId       = $_SESSION["bestelling"];
        $pizzaId        = $card_pizzaId;
        $aantal         = $qty_aantal;
        $verkoopprijs   = "";

        if ($pizzaId > 0)
        {
            $pizzaDAO = new PizzaDAO;
            $pizza = $pizzaDAO->getById($pizzaId);
            $verkoopprijs = $pizza->getPrijs();
        } else
        {
            throw new PizzaBestaatNietException();
        }

        // CREATE NEW BESTELLIJN
        $sql = "INSERT INTO bestellijnen
        (bestelId, pizzaId, aantal, verkoopprijs)
        VALUES
        (:bestelId, :pizzaId, :aantal, :verkoopprijs)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, 
        DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            ':bestelId' => $bestelId,
            ':pizzaId' => $pizzaId,
            ':aantal' => $aantal,
            ':verkoopprijs' => $verkoopprijs,
        ]);
        $dbh = null;
    }
    // READ
    // UPDATE
    // DELETE
}