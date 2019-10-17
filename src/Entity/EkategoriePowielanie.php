<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EkategoriePowielanie
 *
 * @ORM\Table(name="ekategorie_powielanie", indexes={@ORM\Index(name="id_kategorii", columns={"id_kategorii"}), @ORM\Index(name="id_artykulu", columns={"id_artykulu"})})
 * @ORM\Entity
 */
class EkategoriePowielanie
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
     * @ORM\Column(name="id_artykulu", type="bigint", nullable=true, options={"unsigned"=true})
     */
    private $idArtykulu;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_kategorii", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idKategorii;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdKategorii(): ?int
    {
        return $this->idKategorii;
    }

    public function setIdKategorii(?int $idKategorii): self
    {
        $this->idKategorii = $idKategorii;

        return $this;
    }


}
