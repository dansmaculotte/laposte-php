<?php

namespace DansMaCulotte\LaPoste\Resources;

class Address
{
    /** @var string */
    public $recipient;

    /** @var string */
    public $premise;

    /** @var string */
    public $streetNumber;

    /** @var string */
    public $streetName;

    /** @var string */
    public $locality;

    /** @var string */
    public $postalCode;

    /** @var string */
    public $cedexCode;

    /** @var string */
    public $city;

    /** @var array */
    public $blockAddress;

    public function __construct(
        string $destinataire,
        string $pointRemise,
        string $numeroVoie,
        string $libelleVoie,
        string $lieuDit,
        string $codePostal,
        string $codeCedex,
        string $commune,
        array $blocAdresse
    )
    {
        $this->recipient = $destinataire;
        $this->streetNumber = $numeroVoie;
        $this->streetName = $libelleVoie;
        $this->premise = $pointRemise;
        $this->locality = $lieuDit;
        $this->postalCode = $codePostal;
        $this->cedexCode = $codeCedex;
        $this->city = $commune;
        $this->blockAddress = $blocAdresse;
    }
}
