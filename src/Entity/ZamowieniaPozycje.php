<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZamowieniaPozycje
 *
 * @ORM\Table(name="zamowienia_pozycje", indexes={@ORM\Index(name="id_ezamowienia", columns={"id_ezamowienia"}), @ORM\Index(name="id_artykulu", columns={"id_artykulu"})})
 * @ORM\Entity
 */
class ZamowieniaPozycje
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_ezamowienia_pozycje", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEzamowieniaPozycje;

    /**
     * @var int
     *
     * @ORM\Column(name="id_zamowienia_pozycje", type="bigint", nullable=false, options={"unsigned"=true})
     */
    private $idZamowieniaPozycje;

    /**
     * @var int
     *
     * @ORM\Column(name="id_ezamowienia", type="bigint", nullable=false, options={"unsigned"=true})
     */
    private $idEzamowienia;

    /**
     * @var int
     *
     * @ORM\Column(name="id_zamowienia", type="bigint", nullable=false, options={"unsigned"=true})
     */
    private $idZamowienia;

    /**
     * @var int
     *
     * @ORM\Column(name="id_artykulu", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $idArtykulu;

    /**
     * @var int
     *
     * @ORM\Column(name="ilosc", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $ilosc;

    /**
     * @var float
     *
     * @ORM\Column(name="cena_netto", type="float", precision=8, scale=2, nullable=false)
     */
    private $cenaNetto;

    /**
     * @var float
     *
     * @ORM\Column(name="cena_brutto", type="float", precision=8, scale=2, nullable=false)
     */
    private $cenaBrutto;

    /**
     * @var float
     *
     * @ORM\Column(name="narzut", type="float", precision=10, scale=0, nullable=false)
     */
    private $narzut;

    /**
     * @var int|null
     *
     * @ORM\Column(name="zarezerwuj", type="integer", nullable=true)
     */
    private $zarezerwuj;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="znak_rabat", type="boolean", nullable=true)
     */
    private $znakRabat;

    /**
     * @var int|null
     *
     * @ORM\Column(name="zrealizowano", type="integer", nullable=true)
     */
    private $zrealizowano = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="dodano_wfmag", type="boolean", nullable=true)
     */
    private $dodanoWfmag = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_promocja_wersja", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idPromocjaWersja = '0';

    public function getIdEzamowieniaPozycje(): ?string
    {
        return $this->idEzamowieniaPozycje;
    }

    public function getIdZamowieniaPozycje(): ?string
    {
        return $this->idZamowieniaPozycje;
    }

    public function setIdZamowieniaPozycje(string $idZamowieniaPozycje): self
    {
        $this->idZamowieniaPozycje = $idZamowieniaPozycje;

        return $this;
    }

    public function getIdEzamowienia(): ?string
    {
        return $this->idEzamowienia;
    }

    public function setIdEzamowienia(string $idEzamowienia): self
    {
        $this->idEzamowienia = $idEzamowienia;

        return $this;
    }

    public function getIdZamowienia(): ?string
    {
        return $this->idZamowienia;
    }

    public function setIdZamowienia(string $idZamowienia): self
    {
        $this->idZamowienia = $idZamowienia;

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

    public function getIlosc(): ?int
    {
        return $this->ilosc;
    }

    public function setIlosc(int $ilosc): self
    {
        $this->ilosc = $ilosc;

        return $this;
    }

    public function getCenaNetto(): ?float
    {
        return $this->cenaNetto;
    }

    public function setCenaNetto(float $cenaNetto): self
    {
        $this->cenaNetto = $cenaNetto;

        return $this;
    }

    public function getCenaBrutto(): ?float
    {
        return $this->cenaBrutto;
    }

    public function setCenaBrutto(float $cenaBrutto): self
    {
        $this->cenaBrutto = $cenaBrutto;

        return $this;
    }

    public function getNarzut(): ?float
    {
        return $this->narzut;
    }

    public function setNarzut(float $narzut): self
    {
        $this->narzut = $narzut;

        return $this;
    }

    public function getZarezerwuj(): ?int
    {
        return $this->zarezerwuj;
    }

    public function setZarezerwuj(?int $zarezerwuj): self
    {
        $this->zarezerwuj = $zarezerwuj;

        return $this;
    }

    public function getZnakRabat(): ?bool
    {
        return $this->znakRabat;
    }

    public function setZnakRabat(?bool $znakRabat): self
    {
        $this->znakRabat = $znakRabat;

        return $this;
    }

    public function getZrealizowano(): ?int
    {
        return $this->zrealizowano;
    }

    public function setZrealizowano(?int $zrealizowano): self
    {
        $this->zrealizowano = $zrealizowano;

        return $this;
    }

    public function getDodanoWfmag(): ?bool
    {
        return $this->dodanoWfmag;
    }

    public function setDodanoWfmag(?bool $dodanoWfmag): self
    {
        $this->dodanoWfmag = $dodanoWfmag;

        return $this;
    }

    public function getIdPromocjaWersja(): ?int
    {
        return $this->idPromocjaWersja;
    }

    public function setIdPromocjaWersja(?int $idPromocjaWersja): self
    {
        $this->idPromocjaWersja = $idPromocjaWersja;

        return $this;
    }


}
