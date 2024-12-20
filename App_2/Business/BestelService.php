<?php
declare(strict_types=1);

namespace Business;
use Data\BestelLijnDAO;
use Data\BestellingDAO;

class BestelService
{
    // BESTELLINGEN
    public function createNewBestelling()
    {
        $bestellingDAO = new BestellingDAO();
        $bestellingDAO->create();
    }
    // BESTELLIJNEN
    public function createNewBestellijn(int $card_pizzaId, $qty_aantal)
    {
        $bestellijnDAO = new BestelLijnDAO();
        $bestellijnDAO->create($card_pizzaId, $qty_aantal);
    }
}