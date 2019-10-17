<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArtykulyCechySlownikiJezyki
 *
 * @ORM\Table(name="artykuly_cechy_slowniki_jezyki", indexes={@ORM\Index(name="id_pozycji_slownika", columns={"id_pozycji_slownika"}), @ORM\Index(name="id_jezyka", columns={"id_jezyka"})})
 * @ORM\Entity
 */
class ArtykulyCechySlownikiJezyki
{
    /**
     * @var int
     *
     * @ORM\Column(name="idpcs", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpcs;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_pozycji_slownika", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idPozycjiSlownika;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="id_jezyka", type="boolean", nullable=true)
     */
    private $idJezyka;

    /**
     * @var string|null
     *
     * @ORM\Column(name="wartosc_cechy", type="string", length=255, nullable=true)
     */
    private $wartoscCechy;

    public function getIdpcs(): ?string
    {
        return $this->idpcs;
    }

    public function getIdPozycjiSlownika(): ?int
    {
        return $this->idPozycjiSlownika;
    }

    public function setIdPozycjiSlownika(?int $idPozycjiSlownika): self
    {
        $this->idPozycjiSlownika = $idPozycjiSlownika;

        return $this;
    }

    public function getIdJezyka(): ?bool
    {
        return $this->idJezyka;
    }

    public function setIdJezyka(?bool $idJezyka): self
    {
        $this->idJezyka = $idJezyka;

        return $this;
    }

    public function getWartoscCechy(): ?string
    {
        return $this->wartoscCechy;
    }

    public function setWartoscCechy(?string $wartoscCechy): self
    {
        $this->wartoscCechy = $wartoscCechy;

        return $this;
    }


}
