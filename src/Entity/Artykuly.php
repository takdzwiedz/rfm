<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Artykuly
 *
 * @ORM\Table(name="artykuly", indexes={@ORM\Index(name="indeks_artykulu", columns={"indeks_artykulu"}), @ORM\Index(name="id_ekategorii", columns={"id_ekategorii"}), @ORM\Index(name="czy_widoczny", columns={"czy_widoczny"}), @ORM\Index(name="nazwa_artykulu", columns={"nazwa_artykulu"}), @ORM\Index(name="id_kategorii", columns={"id_kategorii"}), @ORM\Index(name="id_artykulu_wfmag", columns={"id_artykulu_wfmag"})})
 * @ORM\Entity
 */
class Artykuly
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_artykulu", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idArtykulu;

    /**
     * @var string
     *
     * @ORM\Column(name="indeks_artykulu", type="string", length=20, nullable=false)
     */
    private $indeksArtykulu;

    /**
     * @var string
     *
     * @ORM\Column(name="indeks_katalogowy", type="string", length=50, nullable=false)
     */
    private $indeksKatalogowy;

    /**
     * @var string
     *
     * @ORM\Column(name="nazwa_artykulu", type="string", length=255, nullable=false)
     */
    private $nazwaArtykulu;

    /**
     * @var int
     *
     * @ORM\Column(name="id_ekategorii", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $idEkategorii;

    /**
     * @var bool
     *
     * @ORM\Column(name="stawka_vat", type="boolean", nullable=false)
     */
    private $stawkaVat;

    /**
     * @var string|null
     *
     * @ORM\Column(name="jednostka", type="string", length=10, nullable=true)
     */
    private $jednostka;

    /**
     * @var string|null
     *
     * @ORM\Column(name="jednostka_oryg", type="string", length=10, nullable=true)
     */
    private $jednostkaOryg;

    /**
     * @var string|null
     *
     * @ORM\Column(name="jednostka_wfmag", type="string", length=10, nullable=true)
     */
    private $jednostkaWfmag;

    /**
     * @var int
     *
     * @ORM\Column(name="stan", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $stan;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_widoczny", type="boolean", nullable=true, options={"default"="1"})
     */
    private $czyWidoczny = '1';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_dostepny", type="boolean", nullable=true, options={"default"="1"})
     */
    private $czyDostepny = '1';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_usuniety", type="boolean", nullable=true)
     */
    private $czyUsuniety;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_gratis", type="boolean", nullable=true)
     */
    private $czyGratis;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_nagroda", type="boolean", nullable=true)
     */
    private $czyNagroda;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_artykulu_wfmag", type="bigint", nullable=true, options={"unsigned"=true})
     */
    private $idArtykuluWfmag;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_artykulu_prod", type="bigint", nullable=true, options={"unsigned"=true})
     */
    private $idArtykuluProd;

    /**
     * @var int
     *
     * @ORM\Column(name="id_kategorii", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $idKategorii;

    /**
     * @var int|null
     *
     * @ORM\Column(name="minimalna_ilosc", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $minimalnaIlosc;

    /**
     * @var int|null
     *
     * @ORM\Column(name="opakowanie_zbiorcze", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $opakowanieZbiorcze;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_usluga", type="boolean", nullable=true)
     */
    private $czyUsluga;

    /**
     * @var int|null
     *
     * @ORM\Column(name="kolejnosc", type="bigint", nullable=true, options={"unsigned"=true})
     */
    private $kolejnosc;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_ceny_domyslnej", type="bigint", nullable=true, options={"unsigned"=true})
     */
    private $idCenyDomyslnej;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="id_magazynu", type="boolean", nullable=true)
     */
    private $idMagazynu;

    /**
     * @var int
     *
     * @ORM\Column(name="id_zamiennika", type="bigint", nullable=false, options={"unsigned"=true})
     */
    private $idZamiennika;

    /**
     * @var float|null
     *
     * @ORM\Column(name="cena_zakupu_netto", type="float", precision=8, scale=2, nullable=true)
     */
    private $cenaZakupuNetto;

    /**
     * @var string|null
     *
     * @ORM\Column(name="kod_ean", type="string", length=50, nullable=true)
     */
    private $kodEan;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="ost_aktualizacja", type="datetime", nullable=true)
     */
    private $ostAktualizacja;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_zaktualizowano_temp", type="boolean", nullable=true)
     */
    private $czyZaktualizowanoTemp;

    /**
     * @var float|null
     *
     * @ORM\Column(name="cena_zakupu_brutto", type="float", precision=8, scale=2, nullable=true)
     */
    private $cenaZakupuBrutto;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="data_dodania", type="date", nullable=true)
     */
    private $dataDodania;

    /**
     * @var int|null
     *
     * @ORM\Column(name="wyswietlen", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $wyswietlen;

    /**
     * @var int|null
     *
     * @ORM\Column(name="stan_minimalny", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $stanMinimalny;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_zdjecie", type="boolean", nullable=true)
     */
    private $czyZdjecie;

    /**
     * @var int|null
     *
     * @ORM\Column(name="punkty_nagroda", type="integer", nullable=true)
     */
    private $punktyNagroda;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="pochodzenie", type="boolean", nullable=true, options={"default"="1"})
     */
    private $pochodzenie = '1';

    /**
     * @var string|null
     *
     * @ORM\Column(name="indeks_obcy", type="string", length=20, nullable=true)
     */
    private $indeksObcy;

    /**
     * @var string|null
     *
     * @ORM\Column(name="indeks_wfmag", type="string", length=20, nullable=true)
     */
    private $indeksWfmag;

    /**
     * @var int|null
     *
     * @ORM\Column(name="podziel_cene_import", type="integer", nullable=true, options={"default"="1","unsigned"=true})
     */
    private $podzielCeneImport = '1';

    /**
     * @var float|null
     *
     * @ORM\Column(name="cena_import", type="float", precision=10, scale=0, nullable=true)
     */
    private $cenaImport;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_cena_wfmag", type="boolean", nullable=true)
     */
    private $czyCenaWfmag;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_jedn_wfmag", type="boolean", nullable=true)
     */
    private $czyJednWfmag;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="id_kategorii_program", type="boolean", nullable=true)
     */
    private $idKategoriiProgram;

    /**
     * @var int|null
     *
     * @ORM\Column(name="p_core_id", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $pCoreId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_artykulu_honeti", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idArtykuluHoneti;

    /**
     * @var string|null
     *
     * @ORM\Column(name="data_dostawy", type="string", length=50, nullable=true)
     */
    private $dataDostawy;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nazwa_pelna", type="string", length=255, nullable=true)
     */
    private $nazwaPelna;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="cykl_zycia", type="boolean", nullable=true)
     */
    private $cyklZycia;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_artykulu_grupuj", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idArtykuluGrupuj;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nazwa_artykulu_grupuj", type="string", length=255, nullable=true)
     */
    private $nazwaArtykuluGrupuj;

    public function getIdArtykulu(): ?string
    {
        return $this->idArtykulu;
    }

    public function getIndeksArtykulu(): ?string
    {
        return $this->indeksArtykulu;
    }

    public function setIndeksArtykulu(string $indeksArtykulu): self
    {
        $this->indeksArtykulu = $indeksArtykulu;

        return $this;
    }

    public function getIndeksKatalogowy(): ?string
    {
        return $this->indeksKatalogowy;
    }

    public function setIndeksKatalogowy(string $indeksKatalogowy): self
    {
        $this->indeksKatalogowy = $indeksKatalogowy;

        return $this;
    }

    public function getNazwaArtykulu(): ?string
    {
        return $this->nazwaArtykulu;
    }

    public function setNazwaArtykulu(string $nazwaArtykulu): self
    {
        $this->nazwaArtykulu = $nazwaArtykulu;

        return $this;
    }

    public function getIdEkategorii(): ?int
    {
        return $this->idEkategorii;
    }

    public function setIdEkategorii(int $idEkategorii): self
    {
        $this->idEkategorii = $idEkategorii;

        return $this;
    }

    public function getStawkaVat(): ?bool
    {
        return $this->stawkaVat;
    }

    public function setStawkaVat(bool $stawkaVat): self
    {
        $this->stawkaVat = $stawkaVat;

        return $this;
    }

    public function getJednostka(): ?string
    {
        return $this->jednostka;
    }

    public function setJednostka(?string $jednostka): self
    {
        $this->jednostka = $jednostka;

        return $this;
    }

    public function getJednostkaOryg(): ?string
    {
        return $this->jednostkaOryg;
    }

    public function setJednostkaOryg(?string $jednostkaOryg): self
    {
        $this->jednostkaOryg = $jednostkaOryg;

        return $this;
    }

    public function getJednostkaWfmag(): ?string
    {
        return $this->jednostkaWfmag;
    }

    public function setJednostkaWfmag(?string $jednostkaWfmag): self
    {
        $this->jednostkaWfmag = $jednostkaWfmag;

        return $this;
    }

    public function getStan(): ?int
    {
        return $this->stan;
    }

    public function setStan(int $stan): self
    {
        $this->stan = $stan;

        return $this;
    }

    public function getCzyWidoczny(): ?bool
    {
        return $this->czyWidoczny;
    }

    public function setCzyWidoczny(?bool $czyWidoczny): self
    {
        $this->czyWidoczny = $czyWidoczny;

        return $this;
    }

    public function getCzyDostepny(): ?bool
    {
        return $this->czyDostepny;
    }

    public function setCzyDostepny(?bool $czyDostepny): self
    {
        $this->czyDostepny = $czyDostepny;

        return $this;
    }

    public function getCzyUsuniety(): ?bool
    {
        return $this->czyUsuniety;
    }

    public function setCzyUsuniety(?bool $czyUsuniety): self
    {
        $this->czyUsuniety = $czyUsuniety;

        return $this;
    }

    public function getCzyGratis(): ?bool
    {
        return $this->czyGratis;
    }

    public function setCzyGratis(?bool $czyGratis): self
    {
        $this->czyGratis = $czyGratis;

        return $this;
    }

    public function getCzyNagroda(): ?bool
    {
        return $this->czyNagroda;
    }

    public function setCzyNagroda(?bool $czyNagroda): self
    {
        $this->czyNagroda = $czyNagroda;

        return $this;
    }

    public function getIdArtykuluWfmag(): ?string
    {
        return $this->idArtykuluWfmag;
    }

    public function setIdArtykuluWfmag(?string $idArtykuluWfmag): self
    {
        $this->idArtykuluWfmag = $idArtykuluWfmag;

        return $this;
    }

    public function getIdArtykuluProd(): ?string
    {
        return $this->idArtykuluProd;
    }

    public function setIdArtykuluProd(?string $idArtykuluProd): self
    {
        $this->idArtykuluProd = $idArtykuluProd;

        return $this;
    }

    public function getIdKategorii(): ?int
    {
        return $this->idKategorii;
    }

    public function setIdKategorii(int $idKategorii): self
    {
        $this->idKategorii = $idKategorii;

        return $this;
    }

    public function getMinimalnaIlosc(): ?int
    {
        return $this->minimalnaIlosc;
    }

    public function setMinimalnaIlosc(?int $minimalnaIlosc): self
    {
        $this->minimalnaIlosc = $minimalnaIlosc;

        return $this;
    }

    public function getOpakowanieZbiorcze(): ?int
    {
        return $this->opakowanieZbiorcze;
    }

    public function setOpakowanieZbiorcze(?int $opakowanieZbiorcze): self
    {
        $this->opakowanieZbiorcze = $opakowanieZbiorcze;

        return $this;
    }

    public function getCzyUsluga(): ?bool
    {
        return $this->czyUsluga;
    }

    public function setCzyUsluga(?bool $czyUsluga): self
    {
        $this->czyUsluga = $czyUsluga;

        return $this;
    }

    public function getKolejnosc(): ?string
    {
        return $this->kolejnosc;
    }

    public function setKolejnosc(?string $kolejnosc): self
    {
        $this->kolejnosc = $kolejnosc;

        return $this;
    }

    public function getIdCenyDomyslnej(): ?string
    {
        return $this->idCenyDomyslnej;
    }

    public function setIdCenyDomyslnej(?string $idCenyDomyslnej): self
    {
        $this->idCenyDomyslnej = $idCenyDomyslnej;

        return $this;
    }

    public function getIdMagazynu(): ?bool
    {
        return $this->idMagazynu;
    }

    public function setIdMagazynu(?bool $idMagazynu): self
    {
        $this->idMagazynu = $idMagazynu;

        return $this;
    }

    public function getIdZamiennika(): ?string
    {
        return $this->idZamiennika;
    }

    public function setIdZamiennika(string $idZamiennika): self
    {
        $this->idZamiennika = $idZamiennika;

        return $this;
    }

    public function getCenaZakupuNetto(): ?float
    {
        return $this->cenaZakupuNetto;
    }

    public function setCenaZakupuNetto(?float $cenaZakupuNetto): self
    {
        $this->cenaZakupuNetto = $cenaZakupuNetto;

        return $this;
    }

    public function getKodEan(): ?string
    {
        return $this->kodEan;
    }

    public function setKodEan(?string $kodEan): self
    {
        $this->kodEan = $kodEan;

        return $this;
    }

    public function getOstAktualizacja(): ?\DateTimeInterface
    {
        return $this->ostAktualizacja;
    }

    public function setOstAktualizacja(?\DateTimeInterface $ostAktualizacja): self
    {
        $this->ostAktualizacja = $ostAktualizacja;

        return $this;
    }

    public function getCzyZaktualizowanoTemp(): ?bool
    {
        return $this->czyZaktualizowanoTemp;
    }

    public function setCzyZaktualizowanoTemp(?bool $czyZaktualizowanoTemp): self
    {
        $this->czyZaktualizowanoTemp = $czyZaktualizowanoTemp;

        return $this;
    }

    public function getCenaZakupuBrutto(): ?float
    {
        return $this->cenaZakupuBrutto;
    }

    public function setCenaZakupuBrutto(?float $cenaZakupuBrutto): self
    {
        $this->cenaZakupuBrutto = $cenaZakupuBrutto;

        return $this;
    }

    public function getDataDodania(): ?\DateTimeInterface
    {
        return $this->dataDodania;
    }

    public function setDataDodania(?\DateTimeInterface $dataDodania): self
    {
        $this->dataDodania = $dataDodania;

        return $this;
    }

    public function getWyswietlen(): ?int
    {
        return $this->wyswietlen;
    }

    public function setWyswietlen(?int $wyswietlen): self
    {
        $this->wyswietlen = $wyswietlen;

        return $this;
    }

    public function getStanMinimalny(): ?int
    {
        return $this->stanMinimalny;
    }

    public function setStanMinimalny(?int $stanMinimalny): self
    {
        $this->stanMinimalny = $stanMinimalny;

        return $this;
    }

    public function getCzyZdjecie(): ?bool
    {
        return $this->czyZdjecie;
    }

    public function setCzyZdjecie(?bool $czyZdjecie): self
    {
        $this->czyZdjecie = $czyZdjecie;

        return $this;
    }

    public function getPunktyNagroda(): ?int
    {
        return $this->punktyNagroda;
    }

    public function setPunktyNagroda(?int $punktyNagroda): self
    {
        $this->punktyNagroda = $punktyNagroda;

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

    public function getIndeksObcy(): ?string
    {
        return $this->indeksObcy;
    }

    public function setIndeksObcy(?string $indeksObcy): self
    {
        $this->indeksObcy = $indeksObcy;

        return $this;
    }

    public function getIndeksWfmag(): ?string
    {
        return $this->indeksWfmag;
    }

    public function setIndeksWfmag(?string $indeksWfmag): self
    {
        $this->indeksWfmag = $indeksWfmag;

        return $this;
    }

    public function getPodzielCeneImport(): ?int
    {
        return $this->podzielCeneImport;
    }

    public function setPodzielCeneImport(?int $podzielCeneImport): self
    {
        $this->podzielCeneImport = $podzielCeneImport;

        return $this;
    }

    public function getCenaImport(): ?float
    {
        return $this->cenaImport;
    }

    public function setCenaImport(?float $cenaImport): self
    {
        $this->cenaImport = $cenaImport;

        return $this;
    }

    public function getCzyCenaWfmag(): ?bool
    {
        return $this->czyCenaWfmag;
    }

    public function setCzyCenaWfmag(?bool $czyCenaWfmag): self
    {
        $this->czyCenaWfmag = $czyCenaWfmag;

        return $this;
    }

    public function getCzyJednWfmag(): ?bool
    {
        return $this->czyJednWfmag;
    }

    public function setCzyJednWfmag(?bool $czyJednWfmag): self
    {
        $this->czyJednWfmag = $czyJednWfmag;

        return $this;
    }

    public function getIdKategoriiProgram(): ?bool
    {
        return $this->idKategoriiProgram;
    }

    public function setIdKategoriiProgram(?bool $idKategoriiProgram): self
    {
        $this->idKategoriiProgram = $idKategoriiProgram;

        return $this;
    }

    public function getPCoreId(): ?int
    {
        return $this->pCoreId;
    }

    public function setPCoreId(?int $pCoreId): self
    {
        $this->pCoreId = $pCoreId;

        return $this;
    }

    public function getIdArtykuluHoneti(): ?int
    {
        return $this->idArtykuluHoneti;
    }

    public function setIdArtykuluHoneti(?int $idArtykuluHoneti): self
    {
        $this->idArtykuluHoneti = $idArtykuluHoneti;

        return $this;
    }

    public function getDataDostawy(): ?string
    {
        return $this->dataDostawy;
    }

    public function setDataDostawy(?string $dataDostawy): self
    {
        $this->dataDostawy = $dataDostawy;

        return $this;
    }

    public function getNazwaPelna(): ?string
    {
        return $this->nazwaPelna;
    }

    public function setNazwaPelna(?string $nazwaPelna): self
    {
        $this->nazwaPelna = $nazwaPelna;

        return $this;
    }

    public function getCyklZycia(): ?bool
    {
        return $this->cyklZycia;
    }

    public function setCyklZycia(?bool $cyklZycia): self
    {
        $this->cyklZycia = $cyklZycia;

        return $this;
    }

    public function getIdArtykuluGrupuj(): ?int
    {
        return $this->idArtykuluGrupuj;
    }

    public function setIdArtykuluGrupuj(?int $idArtykuluGrupuj): self
    {
        $this->idArtykuluGrupuj = $idArtykuluGrupuj;

        return $this;
    }

    public function getNazwaArtykuluGrupuj(): ?string
    {
        return $this->nazwaArtykuluGrupuj;
    }

    public function setNazwaArtykuluGrupuj(?string $nazwaArtykuluGrupuj): self
    {
        $this->nazwaArtykuluGrupuj = $nazwaArtykuluGrupuj;

        return $this;
    }


}
