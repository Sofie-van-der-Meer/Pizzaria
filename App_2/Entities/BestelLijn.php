<?php
declare(strict_types=1);

namespace Entities;
use Entities\Pizza;
use Entities\Bestelling;

class BestelLijn
{
    // private static $idMapBestelling = array();
    // private static $idMapPizza = array();

    private int $id;
    private Bestelling $bestelId;
    private Pizza $pizzaId;
    private int $aantal;
    private float $verkoopprijs; 
    
    public function __construct(
        int $id, int $aantal, float $verkoopprijs
    )
    {
        $this->id = $id;
        $this->aantal = $aantal;
        $this->verkoopprijs = $verkoopprijs; 
    }

    // GETTERS
    public function getId(): int
    {
        return $this->id;
    }
    public function getBestelId(): Bestelling
    {
        return $this->bestelId;
    }
    public function getPizzaId(): Pizza
    {
        return $this->pizzaId;
    }
    public function getAantal(): int
    {
        return $this->aantal;
    }
    public function getVerkoopprijs(): float
    {
        return $this->verkoopprijs;
    }
    // SETTERS
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setBestelId($bestelId)
    {
        $this->bestelId = $bestelId;
    }
    public function setPizzaId($pizzaId)
    {
        $this->pizzaId = $pizzaId;
    }
    public function setAantal($aantal)
    {
        $this->aantal = $aantal;
    }
    public function setVerkoopprijs($verkoopprijs)
    {
        $this->verkoopprijs = $verkoopprijs;
    }

}