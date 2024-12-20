<?php
declare(strict_types=1);

namespace Business;
use Data\KlantDAO;
use Data\PlaatsDAO;

class KlantService
{
    // KLANTEN
    public function createNewKlant()
    {
        $klantDAO = new KlantDAO();
        $klantId = $klantDAO->create();
        return $klantId;
    }

    public function loginKlant()
    {
        $klantDAO = new KlantDAO();
        $klantId = $klantDAO->login();
        return $klantId;
    }

    public function getKlantById($id)
    {
        $klantDAO = new KlantDAO();
        $klant = $klantDAO->klantById($id);
        return $klant;
    }

    public function updateKlant()
    {
        $klantDAO = new KlantDAO();
        $klantDAO->update();
    }

    // PLAATSEN
    public function getAllPlaces()
    {
        $plaatsDAO = new PlaatsDAO();
        $plaatsLijst = $plaatsDAO->getAll();

        return $plaatsLijst;
    }
}