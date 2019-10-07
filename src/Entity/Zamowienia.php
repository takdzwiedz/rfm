<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zamowienia
 *
 * @ORM\Table(name="zamowienia", indexes={@ORM\Index(name="id_kontrahenta", columns={"id_kontrahenta"}), @ORM\Index(name="status_ecommerce", columns={"status_ecommerce"}), @ORM\Index(name="id_auth", columns={"id_auth"}), @ORM\Index(name="id_auth_akceptacja", columns={"id_auth_akceptacja"})})
 * @ORM\Entity
 */
class Zamowienia
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_ezamowienia", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
     * @ORM\Column(name="id_kontrahenta", type="bigint", nullable=false, options={"unsigned"=true})
     */
    private $idKontrahenta;

    /**
     * @var string
     *
     * @ORM\Column(name="numer_zamowienia", type="string", length=15, nullable=false)
     */
    private $numerZamowienia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_zlozenia", type="date", nullable=false)
     */
    private $dataZlozenia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="godzina_zlozenia", type="time", nullable=false)
     */
    private $godzinaZlozenia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_realizacji", type="date", nullable=false)
     */
    private $dataRealizacji;

    /**
     * @var bool
     *
     * @ORM\Column(name="priorytet", type="boolean", nullable=false)
     */
    private $priorytet;

    /**
     * @var bool
     *
     * @ORM\Column(name="auto_rezerwacja", type="boolean", nullable=false)
     */
    private $autoRezerwacja;

    /**
     * @var float
     *
     * @ORM\Column(name="wartosc_brutto", type="float", precision=8, scale=2, nullable=false)
     */
    private $wartoscBrutto;

    /**
     * @var float
     *
     * @ORM\Column(name="wartosc_netto", type="float", precision=8, scale=2, nullable=false)
     */
    private $wartoscNetto;

    /**
     * @var string
     *
     * @ORM\Column(name="stan", type="string", length=1, nullable=false, options={"fixed"=true})
     */
    private $stan;

    /**
     * @var string
     *
     * @ORM\Column(name="status_zamowienia", type="string", length=1, nullable=false, options={"fixed"=true})
     */
    private $statusZamowienia;

    /**
     * @var bool
     *
     * @ORM\Column(name="tryb", type="boolean", nullable=false)
     */
    private $tryb;

    /**
     * @var float
     *
     * @ORM\Column(name="narzut", type="float", precision=10, scale=0, nullable=false)
     */
    private $narzut;

    /**
     * @var bool
     *
     * @ORM\Column(name="czy_powiadom", type="boolean", nullable=false, options={"default"="1"})
     */
    private $czyPowiadom = '1';

    /**
     * @var int
     *
     * @ORM\Column(name="id_auth", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $idAuth;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="status_wfmag", type="boolean", nullable=true)
     */
    private $statusWfmag = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="id_wfmag_user", type="string", length=7, nullable=true)
     */
    private $idWfmagUser;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="id_firmy", type="boolean", nullable=true)
     */
    private $idFirmy;

    /**
     * @var float|null
     *
     * @ORM\Column(name="zam_wartosc_rabat", type="float", precision=6, scale=2, nullable=true)
     */
    private $zamWartoscRabat;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="zam_znak_rabat", type="boolean", nullable=true)
     */
    private $zamZnakRabat;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="status_ecommerce", type="boolean", nullable=true)
     */
    private $statusEcommerce = '0';

    /**
     * @var float|null
     *
     * @ORM\Column(name="rabat_kontrahenta", type="float", precision=6, scale=2, nullable=true)
     */
    private $rabatKontrahenta;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="id_magazynu", type="boolean", nullable=true)
     */
    private $idMagazynu;

    /**
     * @var string|null
     *
     * @ORM\Column(name="session_id", type="string", length=32, nullable=true)
     */
    private $sessionId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_platnosci", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idPlatnosci;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_faktura", type="boolean", nullable=true)
     */
    private $czyFaktura = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="uwagi", type="text", length=65535, nullable=false)
     */
    private $uwagi;

    /**
     * @var string|null
     *
     * @ORM\Column(name="uwagi_klienta", type="text", length=65535, nullable=true)
     */
    private $uwagiKlienta;

    /**
     * @var string|null
     *
     * @ORM\Column(name="uwagi_wysylka", type="text", length=65535, nullable=true)
     */
    private $uwagiWysylka;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="rodzaj_zamowienia", type="boolean", nullable=true)
     */
    private $rodzajZamowienia;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_auth_akceptacja", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idAuthAkceptacja;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_adresu", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idAdresu;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_kontaktu", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idKontaktu;

    /**
     * @var string|null
     *
     * @ORM\Column(name="token", type="string", length=50, nullable=true)
     */
    private $token;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="data_akceptacji", type="datetime", nullable=true)
     */
    private $dataAkceptacji;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_jednostki", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idJednostki;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_dzialu", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idDzialu;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_dane_faktury", type="integer", nullable=true)
     */
    private $idDaneFaktury;

    /**
     * @var string|null
     *
     * @ORM\Column(name="numer_wfmag", type="string", length=25, nullable=true)
     */
    private $numerWfmag;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_zaakceptowal", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idZaakceptowal;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_pakietu", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idPakietu = '0';

    public function getIdEzamowienia(): ?string
    {
        return $this->idEzamowienia;
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

    public function getIdKontrahenta(): ?string
    {
        return $this->idKontrahenta;
    }

    public function setIdKontrahenta(string $idKontrahenta): self
    {
        $this->idKontrahenta = $idKontrahenta;

        return $this;
    }

    public function getNumerZamowienia(): ?string
    {
        return $this->numerZamowienia;
    }

    public function setNumerZamowienia(string $numerZamowienia): self
    {
        $this->numerZamowienia = $numerZamowienia;

        return $this;
    }

    public function getDataZlozenia(): ?\DateTimeInterface
    {
        return $this->dataZlozenia;
    }

    public function setDataZlozenia(\DateTimeInterface $dataZlozenia): self
    {
        $this->dataZlozenia = $dataZlozenia;

        return $this;
    }

    public function getGodzinaZlozenia(): ?\DateTimeInterface
    {
        return $this->godzinaZlozenia;
    }

    public function setGodzinaZlozenia(\DateTimeInterface $godzinaZlozenia): self
    {
        $this->godzinaZlozenia = $godzinaZlozenia;

        return $this;
    }

    public function getDataRealizacji(): ?\DateTimeInterface
    {
        return $this->dataRealizacji;
    }

    public function setDataRealizacji(\DateTimeInterface $dataRealizacji): self
    {
        $this->dataRealizacji = $dataRealizacji;

        return $this;
    }

    public function getPriorytet(): ?bool
    {
        return $this->priorytet;
    }

    public function setPriorytet(bool $priorytet): self
    {
        $this->priorytet = $priorytet;

        return $this;
    }

    public function getAutoRezerwacja(): ?bool
    {
        return $this->autoRezerwacja;
    }

    public function setAutoRezerwacja(bool $autoRezerwacja): self
    {
        $this->autoRezerwacja = $autoRezerwacja;

        return $this;
    }

    public function getWartoscBrutto(): ?float
    {
        return $this->wartoscBrutto;
    }

    public function setWartoscBrutto(float $wartoscBrutto): self
    {
        $this->wartoscBrutto = $wartoscBrutto;

        return $this;
    }

    public function getWartoscNetto(): ?float
    {
        return $this->wartoscNetto;
    }

    public function setWartoscNetto(float $wartoscNetto): self
    {
        $this->wartoscNetto = $wartoscNetto;

        return $this;
    }

    public function getStan(): ?string
    {
        return $this->stan;
    }

    public function setStan(string $stan): self
    {
        $this->stan = $stan;

        return $this;
    }

    public function getStatusZamowienia(): ?string
    {
        return $this->statusZamowienia;
    }

    public function setStatusZamowienia(string $statusZamowienia): self
    {
        $this->statusZamowienia = $statusZamowienia;

        return $this;
    }

    public function getTryb(): ?bool
    {
        return $this->tryb;
    }

    public function setTryb(bool $tryb): self
    {
        $this->tryb = $tryb;

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

    public function getCzyPowiadom(): ?bool
    {
        return $this->czyPowiadom;
    }

    public function setCzyPowiadom(bool $czyPowiadom): self
    {
        $this->czyPowiadom = $czyPowiadom;

        return $this;
    }

    public function getIdAuth(): ?int
    {
        return $this->idAuth;
    }

    public function setIdAuth(int $idAuth): self
    {
        $this->idAuth = $idAuth;

        return $this;
    }

    public function getStatusWfmag(): ?bool
    {
        return $this->statusWfmag;
    }

    public function setStatusWfmag(?bool $statusWfmag): self
    {
        $this->statusWfmag = $statusWfmag;

        return $this;
    }

    public function getIdWfmagUser(): ?string
    {
        return $this->idWfmagUser;
    }

    public function setIdWfmagUser(?string $idWfmagUser): self
    {
        $this->idWfmagUser = $idWfmagUser;

        return $this;
    }

    public function getIdFirmy(): ?bool
    {
        return $this->idFirmy;
    }

    public function setIdFirmy(?bool $idFirmy): self
    {
        $this->idFirmy = $idFirmy;

        return $this;
    }

    public function getZamWartoscRabat(): ?float
    {
        return $this->zamWartoscRabat;
    }

    public function setZamWartoscRabat(?float $zamWartoscRabat): self
    {
        $this->zamWartoscRabat = $zamWartoscRabat;

        return $this;
    }

    public function getZamZnakRabat(): ?bool
    {
        return $this->zamZnakRabat;
    }

    public function setZamZnakRabat(?bool $zamZnakRabat): self
    {
        $this->zamZnakRabat = $zamZnakRabat;

        return $this;
    }

    public function getStatusEcommerce(): ?bool
    {
        return $this->statusEcommerce;
    }

    public function setStatusEcommerce(?bool $statusEcommerce): self
    {
        $this->statusEcommerce = $statusEcommerce;

        return $this;
    }

    public function getRabatKontrahenta(): ?float
    {
        return $this->rabatKontrahenta;
    }

    public function setRabatKontrahenta(?float $rabatKontrahenta): self
    {
        $this->rabatKontrahenta = $rabatKontrahenta;

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

    public function getSessionId(): ?string
    {
        return $this->sessionId;
    }

    public function setSessionId(?string $sessionId): self
    {
        $this->sessionId = $sessionId;

        return $this;
    }

    public function getIdPlatnosci(): ?int
    {
        return $this->idPlatnosci;
    }

    public function setIdPlatnosci(?int $idPlatnosci): self
    {
        $this->idPlatnosci = $idPlatnosci;

        return $this;
    }

    public function getCzyFaktura(): ?bool
    {
        return $this->czyFaktura;
    }

    public function setCzyFaktura(?bool $czyFaktura): self
    {
        $this->czyFaktura = $czyFaktura;

        return $this;
    }

    public function getUwagi(): ?string
    {
        return $this->uwagi;
    }

    public function setUwagi(string $uwagi): self
    {
        $this->uwagi = $uwagi;

        return $this;
    }

    public function getUwagiKlienta(): ?string
    {
        return $this->uwagiKlienta;
    }

    public function setUwagiKlienta(?string $uwagiKlienta): self
    {
        $this->uwagiKlienta = $uwagiKlienta;

        return $this;
    }

    public function getUwagiWysylka(): ?string
    {
        return $this->uwagiWysylka;
    }

    public function setUwagiWysylka(?string $uwagiWysylka): self
    {
        $this->uwagiWysylka = $uwagiWysylka;

        return $this;
    }

    public function getRodzajZamowienia(): ?bool
    {
        return $this->rodzajZamowienia;
    }

    public function setRodzajZamowienia(?bool $rodzajZamowienia): self
    {
        $this->rodzajZamowienia = $rodzajZamowienia;

        return $this;
    }

    public function getIdAuthAkceptacja(): ?int
    {
        return $this->idAuthAkceptacja;
    }

    public function setIdAuthAkceptacja(?int $idAuthAkceptacja): self
    {
        $this->idAuthAkceptacja = $idAuthAkceptacja;

        return $this;
    }

    public function getIdAdresu(): ?int
    {
        return $this->idAdresu;
    }

    public function setIdAdresu(?int $idAdresu): self
    {
        $this->idAdresu = $idAdresu;

        return $this;
    }

    public function getIdKontaktu(): ?int
    {
        return $this->idKontaktu;
    }

    public function setIdKontaktu(?int $idKontaktu): self
    {
        $this->idKontaktu = $idKontaktu;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getDataAkceptacji(): ?\DateTimeInterface
    {
        return $this->dataAkceptacji;
    }

    public function setDataAkceptacji(?\DateTimeInterface $dataAkceptacji): self
    {
        $this->dataAkceptacji = $dataAkceptacji;

        return $this;
    }

    public function getIdJednostki(): ?int
    {
        return $this->idJednostki;
    }

    public function setIdJednostki(?int $idJednostki): self
    {
        $this->idJednostki = $idJednostki;

        return $this;
    }

    public function getIdDzialu(): ?int
    {
        return $this->idDzialu;
    }

    public function setIdDzialu(?int $idDzialu): self
    {
        $this->idDzialu = $idDzialu;

        return $this;
    }

    public function getIdDaneFaktury(): ?int
    {
        return $this->idDaneFaktury;
    }

    public function setIdDaneFaktury(?int $idDaneFaktury): self
    {
        $this->idDaneFaktury = $idDaneFaktury;

        return $this;
    }

    public function getNumerWfmag(): ?string
    {
        return $this->numerWfmag;
    }

    public function setNumerWfmag(?string $numerWfmag): self
    {
        $this->numerWfmag = $numerWfmag;

        return $this;
    }

    public function getIdZaakceptowal(): ?int
    {
        return $this->idZaakceptowal;
    }

    public function setIdZaakceptowal(?int $idZaakceptowal): self
    {
        $this->idZaakceptowal = $idZaakceptowal;

        return $this;
    }

    public function getIdPakietu(): ?int
    {
        return $this->idPakietu;
    }

    public function setIdPakietu(?int $idPakietu): self
    {
        $this->idPakietu = $idPakietu;

        return $this;
    }


}
