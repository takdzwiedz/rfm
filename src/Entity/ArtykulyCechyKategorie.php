<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArtykulyCechyKategorie
 *
 * @ORM\Table(name="artykuly_cechy_kategorie", indexes={@ORM\Index(name="id_kategorii", columns={"id_kategorii"}), @ORM\Index(name="id_cechy", columns={"id_cechy"})})
 * @ORM\Entity
 */
class ArtykulyCechyKategorie
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
     * @var int|null
     *
     * @ORM\Column(name="id_kategorii", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idKategorii;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_cechy", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idCechy;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_filtrowanie", type="boolean", nullable=true, options={"default"="1"})
     */
    private $czyFiltrowanie = '1';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdKategorii(): ?int
    {
        return $this->idKategorii;
    }

    public function setIdKategorii(?int $idKategorii): self
    {
        $this->idKategorii = $idKategorii;

        return $this;
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

    public function getCzyFiltrowanie(): ?bool
    {
        return $this->czyFiltrowanie;
    }

    public function setCzyFiltrowanie(?bool $czyFiltrowanie): self
    {
        $this->czyFiltrowanie = $czyFiltrowanie;

        return $this;
    }


}
