<?php
declare(strict_types=1);

namespace Entities;
use Exceptions\OngeldigEmailadresException;
use Exceptions\WachtwoordenKomenNietOvereenException;

class Klant
{
    private static $idMap = array();

    private int $id;
    private string $voornaam;
    private string $achternaam;
    private string $straatnaam;
    private string $huisnummer;
    private string $bus;
    private Plaats $plaats;
    private string $telefoonnummer;
    private string $email;
    private string $wachtwoord;

    public function __construct(
        // int $cid = null,
        // string $cvoornaam = null, string $cachternaam = null,
        // string $cstraatnaam = null, string $chuisnummer = null, string $cbus = null,
        // Plaats $cplaats = null,
        // int $ctelefoonnummer = null,
        // string $cemail = null, string $cwachtwoord = null

        int $cid,
        string $cvoornaam, string $cachternaam,
        string $cstraatnaam, string $chuisnummer, string $cbus,
        Plaats $cplaats,
        string $ctelefoonnummer,
        string $cemail, string $cwachtwoord
        )
    {
        $this->id = $cid;
        $this->voornaam = $cvoornaam;
        $this->achternaam = $cachternaam;
        $this->straatnaam = $cstraatnaam;
        $this->huisnummer = $chuisnummer;
        $this->bus = $cbus;
        $this->plaats = $cplaats;
        $this->telefoonnummer = $ctelefoonnummer;
        $this->email = $cemail;
        $this->wachtwoord = $cwachtwoord;
    }

    public static function create(
        int $cid,
        string $cvoornaam, string $cachternaam,
        string $cstraatnaam, string $chuisnummer, string $cbus,
        Plaats $cplaats,
        string $ctelefoonnummer,
        string $cemail, string $cwachtwoord
    )
    {
        if (!isset(self::$idMap[$cid]))
        {
            self::$idMap[$cid] = new Klant($cid,
            $cvoornaam, $cachternaam,
            $cstraatnaam, $chuisnummer, $cbus,
            $cplaats,
            $ctelefoonnummer,
            $cemail, $cwachtwoord);
        }
        return self::$idMap[$cid];
    }

    // GETTERS
    public function getId(): int 
    {
        return $this->id;
    }
    public function getNaam(): string
    {
        $naam = join(" ", [$this->voornaam, $this->achternaam]);
        return $naam;
    }
    public function getVoornaam(): string 
    {
        return $this->voornaam;
    }
    public function getAchternaam(): string 
    {
        return $this->achternaam;
    }
    public function getAdres(): string
    {
        $adres = join(" ", [$this->straatnaam, $this->huisnummer]);
        if (!empty($this->bus))
        {
            $adres = join("/", [$adres, $this->bus]);            
        }

        $plaats = $this->getPlaats();
        $plaats = join(" ", [$plaats->getPostcode(), $plaats->getPlaatsNaam()]);

        $adres = join(",<br>", [$adres, $plaats]);
        
        return $adres;
    }
    public function getStraatnaam(): string 
    {
        return $this->straatnaam;
    }
    public function getHuisnummer(): string 
    {
        return $this->huisnummer;
    }
    public function getBus(): string 
    {
        return $this->bus;
    }
    public function getPlaats(): Plaats 
    {
        return $this->plaats;
    }
    public function getTelefoonnummer(): string 
    {
        return $this->telefoonnummer;
    }
    public function getEmail(): string 
    {
        return $this->email;
    }
    public function getWachtwoord(): string 
    {
        return $this->wachtwoord;
    }

    // SETTERS
    public function setId($id) 
    {
        $this->id = $id;
    }
    public function setVoornaam($voornaam) 
    {
        $this->voornaam = $voornaam;
    }
    public function setAchternaam($achternaam) 
    {
        $this->achternaam = $achternaam;
    }
    public function setStraatnaam($straatnaam) 
    {
        $this->straatnaam = $straatnaam;
    }
    public function setHuisnummer($huisnummer) 
    {
        $this->huisnummer = $huisnummer;
    }
    public function setBus($bus) 
    {
        $this->bus = $bus;
    }
    public function setPlaats($plaats) 
    {
        $this->plaats = $plaats;
    }
    public function setTelefoonnummer($telefoonnummer) 
    {
        $this->telefoonnummer = $telefoonnummer;
    }
    public function setEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            throw new OngeldigEmailadresException();
        }
        $this->email = $email;
    }
    public function setWachtwoord($wachtwoord, $herhaalwachtwoord)
    {
        if ($wachtwoord !== $herhaalwachtwoord) 
        {
            throw new WachtwoordenKomenNietOvereenException();
        }
        $this->wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
    }
}
