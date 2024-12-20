<?php
declare(strict_types=1);

namespace Entities;

class Pizza 
{
    private static $idMap = array();
    
    private int $id;
    private string $pizzaNaam;
    private float $prijs;

    public function __construct(
        int $id,
        string $pizzaNaam,
        float $prijs)
    {
        $this->id = $id;
        $this->pizzaNaam = $pizzaNaam;
        $this->prijs = $prijs;
    }

    public static function create(
        int $id,
        string $pizzaNaam,
        float $prijs)
    {
        if (!isset(self::$idMap[$id]))
        {
            self::$idMap[$id] = new Pizza($id, $pizzaNaam, $prijs);
        }
        return self::$idMap[$id];
    }
    

    // GETTERS
    public function getId() :int 
    {
        return $this->id;
    }
    public function getPizzaNaam() :string 
    {
        return $this->pizzaNaam;
    }
    public function getPrijs() :float 
    {
        return $this->prijs;
    }

    // SETTERS

    public function setId($id) 
    {
        $this->id = $id;
    }
    public function setPizzaNaam($pizzaNaam) 
    {
        $this->pizzaNaam = $pizzaNaam;
    }
    public function setPrijs($prijs) 
    {
        $this->prijs = $prijs;
    }
}