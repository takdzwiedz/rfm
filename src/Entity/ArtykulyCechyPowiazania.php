<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArtykulyCechyPowiazania
 *
 * @ORM\Table(name="artykuly_cechy_powiazania", indexes={@ORM\Index(name="id_pozycji_slownika", columns={"id_pozycji_slownika"}), @ORM\Index(name="id_artykulu", columns={"id_artykulu"})})
 * @ORM\Entity
 */
class ArtykulyCechyPowiazania
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_powiazania", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPowiazania;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_pozycji_slownika", type="bigint", nullable=true, options={"unsigned"=true})
     */
    private $idPozycjiSlownika;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_artykulu", type="bigint", nullable=true, options={"unsigned"=true})
     */
    private $idArtykulu;

    public function getIdPowiazania(): ?string
    {
        return $this->idPowiazania;
    }

    public function getIdPozycjiSlownika(): ?string
    {
        return $this->idPozycjiSlownika;
    }

    public function setIdPozycjiSlownika(?string $idPozycjiSlownika): self
    {
        $this->idPozycjiSlownika = $idPozycjiSlownika;

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


}
