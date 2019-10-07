<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArtykulyUlubione
 *
 * @ORM\Table(name="artykuly_ulubione", indexes={@ORM\Index(name="id_artykulu", columns={"id_artykulu"}), @ORM\Index(name="id_kontrahenta", columns={"id_kontrahenta"}), @ORM\Index(name="id_auth", columns={"id_auth"})})
 * @ORM\Entity
 */
class ArtykulyUlubione
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
     * @ORM\Column(name="id_artykulu", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idArtykulu;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_auth", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idAuth;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="data_utworzenia", type="date", nullable=true)
     */
    private $dataUtworzenia;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_kontrahenta", type="bigint", nullable=true, options={"unsigned"=true})
     */
    private $idKontrahenta;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdArtykulu(): ?int
    {
        return $this->idArtykulu;
    }

    public function setIdArtykulu(?int $idArtykulu): self
    {
        $this->idArtykulu = $idArtykulu;

        return $this;
    }

    public function getIdAuth(): ?int
    {
        return $this->idAuth;
    }

    public function setIdAuth(?int $idAuth): self
    {
        $this->idAuth = $idAuth;

        return $this;
    }

    public function getDataUtworzenia(): ?\DateTimeInterface
    {
        return $this->dataUtworzenia;
    }

    public function setDataUtworzenia(?\DateTimeInterface $dataUtworzenia): self
    {
        $this->dataUtworzenia = $dataUtworzenia;

        return $this;
    }

    public function getIdKontrahenta(): ?string
    {
        return $this->idKontrahenta;
    }

    public function setIdKontrahenta(?string $idKontrahenta): self
    {
        $this->idKontrahenta = $idKontrahenta;

        return $this;
    }


}
