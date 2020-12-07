<?php

namespace IntVent\Transmission\Models;

use Exception;
use IntVent\Transmission\Contracts\Arrayable;
use IntVent\Transmission\Exceptions\TransmissionException;
use IntVent\Transmission\Traits\ProtectedFieldsToArrayTrait;

class Afhaalpunt implements Arrayable
{
    use ProtectedFieldsToArrayTrait;

    public string $id = '';
    public string $naam = '';
    public ?string $straat = null;
    public ?string $huisnummer = null;
    public ?string $postcode = null;
    public ?string $plaats = null;
    public ?string $land = null;

    public function __construct($input)
    {
        $fields = array_keys(get_object_vars($this));
        foreach ($fields as $field) {
            try {
                $method = 'set'.ucfirst($field);
                $this->$method($input->{$field});
            } catch (Exception $exception) {
                throw new TransmissionException($exception->getMessage());
            }
        }
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param  string  $id
     * @return Afhaalpunt
     */
    public function setId(string $id): Afhaalpunt
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getNaam(): string
    {
        return $this->naam;
    }

    /**
     * @param  string  $naam
     * @return Afhaalpunt
     */
    public function setNaam(string $naam): Afhaalpunt
    {
        $this->naam = $naam;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getStraat(): ?string
    {
        return $this->straat;
    }

    /**
     * @param  string|null  $straat
     * @return Afhaalpunt
     */
    public function setStraat(?string $straat): Afhaalpunt
    {
        $this->straat = $straat;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getHuisnummer(): ?string
    {
        return $this->huisnummer;
    }

    /**
     * @param  string|null  $huisnummer
     * @return Afhaalpunt
     */
    public function setHuisnummer(?string $huisnummer): Afhaalpunt
    {
        $this->huisnummer = $huisnummer;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    /**
     * @param  string|null  $postcode
     * @return Afhaalpunt
     */
    public function setPostcode(?string $postcode): Afhaalpunt
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getPlaats(): ?string
    {
        return $this->plaats;
    }

    /**
     * @param  string|null  $plaats
     * @return Afhaalpunt
     */
    public function setPlaats(?string $plaats): Afhaalpunt
    {
        $this->plaats = $plaats;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLand(): ?string
    {
        return $this->land;
    }

    /**
     * @param  string|null  $land
     * @return Afhaalpunt
     */
    public function setLand(?string $land): Afhaalpunt
    {
        $this->land = $land;

        return $this;
    }
}
