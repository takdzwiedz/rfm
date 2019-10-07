<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArtykulyWyroznione
 *
 * @ORM\Table(name="artykuly_wyroznione")
 * @ORM\Entity
 */
class ArtykulyWyroznione
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="id_odbiorcy", type="bigint", nullable=false, options={"unsigned"=true})
     */
    private $idOdbiorcy;

    /**
     * @var bool
     *
     * @ORM\Column(name="grupa_artykul", type="boolean", nullable=false)
     */
    private $grupaArtykul;

    /**
     * @var int
     *
     * @ORM\Column(name="id_artykulu", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $idArtykulu;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="rodzaj_wyroznienia", type="boolean", nullable=true)
     */
    private $rodzajWyroznienia;

    /**
     * @var int|null
     *
     * @ORM\Column(name="kolejnosc", type="bigint", nullable=true, options={"unsigned"=true})
     */
    private $kolejnosc;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="rodzaj_odbiorcy", type="boolean", nullable=true)
     */
    private $rodzajOdbiorcy;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_glowna", type="boolean", nullable=true)
     */
    private $czyGlowna = '0';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdOdbiorcy(): ?string
    {
        return $this->idOdbiorcy;
    }

    public function setIdOdbiorcy(string $idOdbiorcy): self
    {
        $this->idOdbiorcy = $idOdbiorcy;

        return $this;
    }

    public function getGrupaArtykul(): ?bool
    {
        return $this->grupaArtykul;
    }

    public function setGrupaArtykul(bool $grupaArtykul): self
    {
        $this->grupaArtykul = $grupaArtykul;

        return $this;
    }

    public function getIdArtykulu(): ?int
    {
        return $this->idArtykulu;
    }

    public function setIdArtykulu(int $idArtykulu): self
    {
        $this->idArtykulu = $idArtykulu;

        return $this;
    }

    public function getRodzajWyroznienia(): ?bool
    {
        return $this->rodzajWyroznienia;
    }

    public function setRodzajWyroznienia(?bool $rodzajWyroznienia): self
    {
        $this->rodzajWyroznienia = $rodzajWyroznienia;

        return $this;
    }

    public function getKolejnosc(): ?string
    {
        return $this->kolejnosc;
    }

    public function setKolejnosc(?string $kolejnosc): self
    {
        $this->kolejnosc = $kolejnosc;

        return $this;
    }

    public function getRodzajOdbiorcy(): ?bool
    {
        return $this->rodzajOdbiorcy;
    }

    public function setRodzajOdbiorcy(?bool $rodzajOdbiorcy): self
    {
        $this->rodzajOdbiorcy = $rodzajOdbiorcy;

        return $this;
    }

    public function getCzyGlowna(): ?bool
    {
        return $this->czyGlowna;
    }

    public function setCzyGlowna(?bool $czyGlowna): self
    {
        $this->czyGlowna = $czyGlowna;

        return $this;
    }


}
