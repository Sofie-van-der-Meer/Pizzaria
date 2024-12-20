<?php
declare(strict_types=1);

namespace Entities;

use DateTime;

class Bestelling
{
    private static $idMap = array();

    private int $id;
    private Klant $klantId;
    private DateTime $bestelMoment;
    private DateTime $leveringsmoment;
    private string $extraInfo;

    public function __construct(
        int $id,
        Klant $klantId,
        DateTime $bestelMoment,
        DateTime $leveringsmoment,
        string $extraInfo)
    {
        $this->id = $id;
        $this->klantId = $klantId;
        $this->bestelMoment = $bestelMoment;
        $this->leveringsmoment = $leveringsmoment;
        $this->extraInfo = $extraInfo;
    }

    public function create(
        int $id,
        Klant $klantId,
        DateTime $bestelMoment,
        DateTime $leveringsmoment,
        string $extraInfo)
    {
        if (!isset(self::$idMap[$id]))
        {
            self::$idMap[$id] = new Bestelling(
                $id,
                $klantId,
                $bestelMoment,
                $leveringsmoment,
                $extraInfo);
        }
        return self::$idMap[$id];
    }
}
