<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArtykulyCechyJezyki
 *
 * @ORM\Table(name="artykuly_cechy_jezyki", indexes={@ORM\Index(name="id_jezyka", columns={"id_jezyka"}), @ORM\Index(name="id_cechy", columns={"id_cechy"})})
 * @ORM\Entity
 */
class ArtykulyCechyJezyki
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_cechy_jezyki", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCechyJezyki;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_cechy", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idCechy;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="id_jezyka", type="boolean", nullable=true)
     */
    private $idJezyka;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nazwa_cechy", type="string", length=255, nullable=true)
     */
    private $nazwaCechy;

    public function getIdCechyJezyki(): ?int
    {
        return $this->idCechyJezyki;
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

    public function getIdJezyka(): ?bool
    {
        return $this->idJezyka;
    }

    public function setIdJezyka(?bool $idJezyka): self
    {
        $this->idJezyka = $idJezyka;

        return $this;
    }

    public function getNazwaCechy(): ?string
    {
        return $this->nazwaCechy;
    }

    public function setNazwaCechy(?string $nazwaCechy): self
    {
        $this->nazwaCechy = $nazwaCechy;

        return $this;
    }


}
