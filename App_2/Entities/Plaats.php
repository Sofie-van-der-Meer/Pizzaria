<?php
declare(strict_types=1);

namespace Entities;

class Plaats
{
    private static $idMap = array();

    private int $id;
    private int $postcode;
    private string $plaatsNaam;

    private function __construct(int $id, int $postcode, string $plaatsNaam)
    {
        $this->id = $id;
        $this->postcode = $postcode;
        $this->plaatsNaam = $plaatsNaam;
    }

    public static function create(int $id, int $postcode, string $plaatsNaam)
    {
        if (!isset(self::$idMap[$id]))
        {
            self::$idMap[$id] = new Plaats($id, $postcode, $plaatsNaam);
        }
        return self::$idMap[$id];
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function getPostcode(): int 
    {
        return $this->postcode;
    }

    public function getPlaatsNaam(): string 
    {
        return $this->plaatsNaam;
    }

    public function setPostcode(string $postcode)
    {
        $this->postcode = $postcode;
    }

    public function setPlaatsNaam(string $plaatsNaam)
    {
        $this->plaatsNaam = $plaatsNaam;
    }

}
