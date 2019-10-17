<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArtykulyCechySlowniki
 *
 * @ORM\Table(name="artykuly_cechy_slowniki", indexes={@ORM\Index(name="id_cechy", columns={"id_cechy"}), @ORM\Index(name="id_artykulu", columns={"id_artykulu"})})
 * @ORM\Entity
 */
class ArtykulyCechySlowniki
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_pozycji_slownika", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPozycjiSlownika;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_cechy", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idCechy;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_artykulu", type="bigint", nullable=true, options={"unsigned"=true})
     */
    private $idArtykulu;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="kolejnosc", type="boolean", nullable=true)
     */
    private $kolejnosc;

    public function getIdPozycjiSlownika(): ?int
    {
        return $this->idPozycjiSlownika;
    }

    public function getIdCechy(): ?int
    {
        return $this->idCechy;
    }

    public function setIdCechy(?int $idCechy): self
    {
        $this->idCechy = $idCechy;

        return $this;
    }

    public function getIdArtykulu(): ?string
    {
        return $this->idArtykulu;
    }

    public function setIdArtykulu(?string $idArtykulu): self
    {
        $this->idArtykulu = $idArtykulu;

        return $this;
    }

    public function getKolejnosc(): ?bool
    {
        return $this->kolejnosc;
    }

    public function setKolejnosc(?bool $kolejnosc): self
    {
        $this->kolejnosc = $kolejnosc;

        return $this;
    }


}
