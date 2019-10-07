<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArtykulyCechy
 *
 * @ORM\Table(name="artykuly_cechy", indexes={@ORM\Index(name="czy_widoczna", columns={"czy_widoczna"})})
 * @ORM\Entity
 */
class ArtykulyCechy
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_cechy", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCechy;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pole_wfmag", type="string", length=100, nullable=true)
     */
    private $poleWfmag;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nazwa_cechy_wfmag", type="string", length=100, nullable=true)
     */
    private $nazwaCechyWfmag;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_widoczna", type="boolean", nullable=true, options={"default"="1"})
     */
    private $czyWidoczna = '1';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="kolejnosc", type="boolean", nullable=true)
     */
    private $kolejnosc;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_wfmag", type="boolean", nullable=true)
     */
    private $czyWfmag = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_kategorii", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idKategorii = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_filtering_bak", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idFilteringBak;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nazwa_cechy_temp", type="string", length=255, nullable=true)
     */
    private $nazwaCechyTemp;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_filtrowanie", type="boolean", nullable=true)
     */
    private $czyFiltrowanie = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="pochodzenie", type="boolean", nullable=true, options={"default"="1","comment"="1 - wfmag, 2 - honeti, 3 - ręcznie"})
     */
    private $pochodzenie = '1';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="typ_cechy", type="boolean", nullable=true, options={"default"="1"})
     */
    private $typCechy = '1';

    public function getIdCechy(): ?int
    {
        return $this->idCechy;
    }

    public function getPoleWfmag(): ?string
    {
        return $this->poleWfmag;
    }

    public function setPoleWfmag(?string $poleWfmag): self
    {
        $this->poleWfmag = $poleWfmag;

        return $this;
    }

    public function getNazwaCechyWfmag(): ?string
    {
        return $this->nazwaCechyWfmag;
    }

    public function setNazwaCechyWfmag(?string $nazwaCechyWfmag): self
    {
        $this->nazwaCechyWfmag = $nazwaCechyWfmag;

        return $this;
    }

    public function getCzyWidoczna(): ?bool
    {
        return $this->czyWidoczna;
    }

    public function setCzyWidoczna(?bool $czyWidoczna): self
    {
        $this->czyWidoczna = $czyWidoczna;

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

    public function getCzyWfmag(): ?bool
    {
        return $this->czyWfmag;
    }

    public function setCzyWfmag(?bool $czyWfmag): self
    {
        $this->czyWfmag = $czyWfmag;

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

    public function getIdFilteringBak(): ?int
    {
        return $this->idFilteringBak;
    }

    public function setIdFilteringBak(?int $idFilteringBak): self
    {
        $this->idFilteringBak = $idFilteringBak;

        return $this;
    }

    public function getNazwaCechyTemp(): ?string
    {
        return $this->nazwaCechyTemp;
    }

    public function setNazwaCechyTemp(?string $nazwaCechyTemp): self
    {
        $this->nazwaCechyTemp = $nazwaCechyTemp;

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

    public function getPochodzenie(): ?bool
    {
        return $this->pochodzenie;
    }

    public function setPochodzenie(?bool $pochodzenie): self
    {
        $this->pochodzenie = $pochodzenie;

        return $this;
    }

    public function getTypCechy(): ?bool
    {
        return $this->typCechy;
    }

    public function setTypCechy(?bool $typCechy): self
    {
        $this->typCechy = $typCechy;

        return $this;
    }


}
