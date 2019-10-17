<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kontrahenci
 *
 * @ORM\Table(name="kontrahenci", indexes={@ORM\Index(name="id_grupy", columns={"id_grupy"})})
 * @ORM\Entity
 */
class Kontrahenci
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
     * @var int
     *
     * @ORM\Column(name="id_grupy", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\ManyToOne(targetEntity="App\Entity\KontrahenciGrupy")
     * @ORM\JoinColumn(referencedColumnName="id_grupy")
     */
    private $idGrupy;

    /**
     * @var int
     *
     * @ORM\Column(name="id_egrupy", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $idEgrupy;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nazwa_skrocona", type="string", length=255, nullable=true)
     */
    private $nazwaSkrocona;

    /**
     * @var string
     *
     * @ORM\Column(name="nazwa_kontrahenta", type="string", length=255, nullable=false)
     */
    private $nazwaKontrahenta;

    /**
     * @var string|null
     *
     * @ORM\Column(name="kod_kontrahenta", type="string", length=15, nullable=true)
     */
    private $kodKontrahenta;

    /**
     * @var string
     *
     * @ORM\Column(name="kod", type="string", length=6, nullable=false)
     */
    private $kod;

    /**
     * @var string
     *
     * @ORM\Column(name="miasto", type="string", length=255, nullable=false)
     */
    private $miasto;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_platnika", type="bigint", nullable=true, options={"unsigned"=true})
     */
    private $idPlatnika;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_klasyfikacji", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idKlasyfikacji;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_handlowca", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idHandlowca;

    /**
     * @var bool
     *
     * @ORM\Column(name="id_opiekuna", type="boolean", nullable=false)
     */
    private $idOpiekuna;

    /**
     * @var bool
     *
     * @ORM\Column(name="czy_tylko_bufor", type="boolean", nullable=false)
     */
    private $czyTylkoBufor;

    /**
     * @var float
     *
     * @ORM\Column(name="limit_kupiecki", type="float", precision=10, scale=0, nullable=false)
     */
    private $limitKupiecki;

    /**
     * @var float
     *
     * @ORM\Column(name="minimum_logistyczne", type="float", precision=8, scale=2, nullable=false)
     */
    private $minimumLogistyczne;

    /**
     * @var float
     *
     * @ORM\Column(name="domyslny_rabat", type="float", precision=10, scale=0, nullable=false)
     */
    private $domyslnyRabat;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_zablokowany", type="boolean", nullable=true)
     */
    private $czyZablokowany = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_usuniety", type="boolean", nullable=true)
     */
    private $czyUsuniety = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_aktywny", type="boolean", nullable=true)
     */
    private $czyAktywny = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_kontrahenta", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idKontrahenta = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="companies_id", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $companiesId;

    /**
     * @var string
     *
     * @ORM\Column(name="nip", type="string", length=20, nullable=false)
     */
    private $nip;

    /**
     * @var string|null
     *
     * @ORM\Column(name="regon", type="string", length=15, nullable=true)
     */
    private $regon;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ulica", type="string", length=255, nullable=true)
     */
    private $ulica;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="aktualizuj_wfmag", type="boolean", nullable=true)
     */
    private $aktualizujWfmag = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="uwagi", type="string", length=255, nullable=true)
     */
    private $uwagi;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="data_rejestracji", type="datetime", nullable=true)
     */
    private $dataRejestracji;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="ogranicz_cennik", type="boolean", nullable=true)
     */
    private $ograniczCennik = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_program_lojalnosciowy", type="boolean", nullable=true)
     */
    private $czyProgramLojalnosciowy = '0';

    /**
     * @var float|null
     *
     * @ORM\Column(name="przelicznik_program", type="float", precision=6, scale=2, nullable=true)
     */
    private $przelicznikProgram;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="darmowa_dostawa", type="boolean", nullable=true)
     */
    private $darmowaDostawa = '0';

    /**
     * @var float|null
     *
     * @ORM\Column(name="koszt_dostawa", type="float", precision=6, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $kosztDostawa = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="pole4", type="string", length=255, nullable=true)
     */
    private $pole4;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdGrupy(): ?int
    {
        return $this->idGrupy;
    }

    public function setIdGrupy(int $idGrupy): self
    {
        $this->idGrupy = $idGrupy;

        return $this;
    }

    public function getIdEgrupy(): ?int
    {
        return $this->idEgrupy;
    }

    public function setIdEgrupy(int $idEgrupy): self
    {
        $this->idEgrupy = $idEgrupy;

        return $this;
    }

    public function getNazwaSkrocona(): ?string
    {
        return $this->nazwaSkrocona;
    }

    public function setNazwaSkrocona(?string $nazwaSkrocona): self
    {
        $this->nazwaSkrocona = $nazwaSkrocona;

        return $this;
    }

    public function getNazwaKontrahenta(): ?string
    {
        return $this->nazwaKontrahenta;
    }

    public function setNazwaKontrahenta(string $nazwaKontrahenta): self
    {
        $this->nazwaKontrahenta = $nazwaKontrahenta;

        return $this;
    }

    public function getKodKontrahenta(): ?string
    {
        return $this->kodKontrahenta;
    }

    public function setKodKontrahenta(?string $kodKontrahenta): self
    {
        $this->kodKontrahenta = $kodKontrahenta;

        return $this;
    }

    public function getKod(): ?string
    {
        return $this->kod;
    }

    public function setKod(string $kod): self
    {
        $this->kod = $kod;

        return $this;
    }

    public function getMiasto(): ?string
    {
        return $this->miasto;
    }

    public function setMiasto(string $miasto): self
    {
        $this->miasto = $miasto;

        return $this;
    }

    public function getIdPlatnika(): ?string
    {
        return $this->idPlatnika;
    }

    public function setIdPlatnika(?string $idPlatnika): self
    {
        $this->idPlatnika = $idPlatnika;

        return $this;
    }

    public function getIdKlasyfikacji(): ?int
    {
        return $this->idKlasyfikacji;
    }

    public function setIdKlasyfikacji(?int $idKlasyfikacji): self
    {
        $this->idKlasyfikacji = $idKlasyfikacji;

        return $this;
    }

    public function getIdHandlowca(): ?int
    {
        return $this->idHandlowca;
    }

    public function setIdHandlowca(?int $idHandlowca): self
    {
        $this->idHandlowca = $idHandlowca;

        return $this;
    }

    public function getIdOpiekuna(): ?bool
    {
        return $this->idOpiekuna;
    }

    public function setIdOpiekuna(bool $idOpiekuna): self
    {
        $this->idOpiekuna = $idOpiekuna;

        return $this;
    }

    public function getCzyTylkoBufor(): ?bool
    {
        return $this->czyTylkoBufor;
    }

    public function setCzyTylkoBufor(bool $czyTylkoBufor): self
    {
        $this->czyTylkoBufor = $czyTylkoBufor;

        return $this;
    }

    public function getLimitKupiecki(): ?float
    {
        return $this->limitKupiecki;
    }

    public function setLimitKupiecki(float $limitKupiecki): self
    {
        $this->limitKupiecki = $limitKupiecki;

        return $this;
    }

    public function getMinimumLogistyczne(): ?float
    {
        return $this->minimumLogistyczne;
    }

    public function setMinimumLogistyczne(float $minimumLogistyczne): self
    {
        $this->minimumLogistyczne = $minimumLogistyczne;

        return $this;
    }

    public function getDomyslnyRabat(): ?float
    {
        return $this->domyslnyRabat;
    }

    public function setDomyslnyRabat(float $domyslnyRabat): self
    {
        $this->domyslnyRabat = $domyslnyRabat;

        return $this;
    }

    public function getCzyZablokowany(): ?bool
    {
        return $this->czyZablokowany;
    }

    public function setCzyZablokowany(?bool $czyZablokowany): self
    {
        $this->czyZablokowany = $czyZablokowany;

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

    public function getCzyAktywny(): ?bool
    {
        return $this->czyAktywny;
    }

    public function setCzyAktywny(?bool $czyAktywny): self
    {
        $this->czyAktywny = $czyAktywny;

        return $this;
    }

    public function getIdKontrahenta(): ?int
    {
        return $this->idKontrahenta;
    }

    public function setIdKontrahenta(?int $idKontrahenta): self
    {
        $this->idKontrahenta = $idKontrahenta;

        return $this;
    }

    public function getCompaniesId(): ?int
    {
        return $this->companiesId;
    }

    public function setCompaniesId(?int $companiesId): self
    {
        $this->companiesId = $companiesId;

        return $this;
    }

    public function getNip(): ?string
    {
        return $this->nip;
    }

    public function setNip(string $nip): self
    {
        $this->nip = $nip;

        return $this;
    }

    public function getRegon(): ?string
    {
        return $this->regon;
    }

    public function setRegon(?string $regon): self
    {
        $this->regon = $regon;

        return $this;
    }

    public function getUlica(): ?string
    {
        return $this->ulica;
    }

    public function setUlica(?string $ulica): self
    {
        $this->ulica = $ulica;

        return $this;
    }

    public function getAktualizujWfmag(): ?bool
    {
        return $this->aktualizujWfmag;
    }

    public function setAktualizujWfmag(?bool $aktualizujWfmag): self
    {
        $this->aktualizujWfmag = $aktualizujWfmag;

        return $this;
    }

    public function getUwagi(): ?string
    {
        return $this->uwagi;
    }

    public function setUwagi(?string $uwagi): self
    {
        $this->uwagi = $uwagi;

        return $this;
    }

    public function getDataRejestracji(): ?\DateTimeInterface
    {
        return $this->dataRejestracji;
    }

    public function setDataRejestracji(?\DateTimeInterface $dataRejestracji): self
    {
        $this->dataRejestracji = $dataRejestracji;

        return $this;
    }

    public function getOgraniczCennik(): ?bool
    {
        return $this->ograniczCennik;
    }

    public function setOgraniczCennik(?bool $ograniczCennik): self
    {
        $this->ograniczCennik = $ograniczCennik;

        return $this;
    }

    public function getCzyProgramLojalnosciowy(): ?bool
    {
        return $this->czyProgramLojalnosciowy;
    }

    public function setCzyProgramLojalnosciowy(?bool $czyProgramLojalnosciowy): self
    {
        $this->czyProgramLojalnosciowy = $czyProgramLojalnosciowy;

        return $this;
    }

    public function getPrzelicznikProgram(): ?float
    {
        return $this->przelicznikProgram;
    }

    public function setPrzelicznikProgram(?float $przelicznikProgram): self
    {
        $this->przelicznikProgram = $przelicznikProgram;

        return $this;
    }

    public function getDarmowaDostawa(): ?bool
    {
        return $this->darmowaDostawa;
    }

    public function setDarmowaDostawa(?bool $darmowaDostawa): self
    {
        $this->darmowaDostawa = $darmowaDostawa;

        return $this;
    }

    public function getKosztDostawa(): ?float
    {
        return $this->kosztDostawa;
    }

    public function setKosztDostawa(?float $kosztDostawa): self
    {
        $this->kosztDostawa = $kosztDostawa;

        return $this;
    }

    public function getPole4(): ?string
    {
        return $this->pole4;
    }

    public function setPole4(?string $pole4): self
    {
        $this->pole4 = $pole4;

        return $this;
    }


}
