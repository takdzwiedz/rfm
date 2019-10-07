<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArtykulyObserwowane
 *
 * @ORM\Table(name="artykuly_obserwowane")
 * @ORM\Entity
 */
class ArtykulyObserwowane
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
     * @var bool|null
     *
     * @ORM\Column(name="id_zdarzenia", type="boolean", nullable=true)
     */
    private $idZdarzenia;

    /**
     * @var string|null
     *
     * @ORM\Column(name="wartosc", type="string", length=255, nullable=true)
     */
    private $wartosc;

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

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_wyslano", type="boolean", nullable=true)
     */
    private $czyWyslano = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="data_wyslania", type="datetime", nullable=true)
     */
    private $dataWyslania;

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

    public function getIdZdarzenia(): ?bool
    {
        return $this->idZdarzenia;
    }

    public function setIdZdarzenia(?bool $idZdarzenia): self
    {
        $this->idZdarzenia = $idZdarzenia;

        return $this;
    }

    public function getWartosc(): ?string
    {
        return $this->wartosc;
    }

    public function setWartosc(?string $wartosc): self
    {
        $this->wartosc = $wartosc;

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

    public function getCzyWyslano(): ?bool
    {
        return $this->czyWyslano;
    }

    public function setCzyWyslano(?bool $czyWyslano): self
    {
        $this->czyWyslano = $czyWyslano;

        return $this;
    }

    public function getDataWyslania(): ?\DateTimeInterface
    {
        return $this->dataWyslania;
    }

    public function setDataWyslania(?\DateTimeInterface $dataWyslania): self
    {
        $this->dataWyslania = $dataWyslania;

        return $this;
    }


}
