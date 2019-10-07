<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserAuth
 *
 * @ORM\Table(name="user_auth", indexes={@ORM\Index(name="id_dzialu", columns={"id_dzialu"}), @ORM\Index(name="data_dodania", columns={"data_dodania"})})
 * @ORM\Entity
 */
class UserAuth
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_auth", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAuth;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=150, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=50, nullable=false)
     */
    private $password;

    /**
     * @var bool
     *
     * @ORM\Column(name="rodzaj_user", type="boolean", nullable=false)
     */
    private $rodzajUser;

    /**
     * @var string
     *
     * @ORM\Column(name="imie_nazwisko", type="string", length=255, nullable=false)
     */
    private $imieNazwisko;

    /**
     * @var string
     *
     * @ORM\Column(name="opis_uzytkownika", type="string", length=255, nullable=false)
     */
    private $opisUzytkownika;

    /**
     * @var string
     *
     * @ORM\Column(name="adres_email", type="string", length=255, nullable=false)
     */
    private $adresEmail;

    /**
     * @var bool
     *
     * @ORM\Column(name="czy_aktywny", type="boolean", nullable=false, options={"default"="1"})
     */
    private $czyAktywny = '1';

    /**
     * @var bool
     *
     * @ORM\Column(name="czy_usuniety", type="boolean", nullable=false)
     */
    private $czyUsuniety = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="telefon", type="string", length=20, nullable=true)
     */
    private $telefon;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="data_dodania", type="datetime", nullable=true)
     */
    private $dataDodania;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_user_solal", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idUserSolal = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="password_old", type="string", length=50, nullable=true)
     */
    private $passwordOld;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_jednostki", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idJednostki = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_dzialu", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idDzialu = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_auth_akceptuj", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idAuthAkceptuj = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="zmiana_hasla", type="boolean", nullable=true)
     */
    private $zmianaHasla = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="id_jezyka", type="boolean", nullable=true, options={"default"="1"})
     */
    private $idJezyka = '1';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="ogranicz_cennik", type="boolean", nullable=true)
     */
    private $ograniczCennik = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_minikatalog", type="boolean", nullable=true)
     */
    private $czyMinikatalog = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="poziom_akceptuj", type="boolean", nullable=true, options={"default"="3"})
     */
    private $poziomAkceptuj = '3';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="poziom_katalog", type="boolean", nullable=true, options={"default"="1"})
     */
    private $poziomKatalog = '1';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_stan_sie", type="boolean", nullable=true)
     */
    private $czyStanSie = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_widzi_ceny", type="boolean", nullable=true)
     */
    private $czyWidziCeny = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_widzi_promocje", type="boolean", nullable=true)
     */
    private $czyWidziPromocje = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_program_lojalnosciowy", type="boolean", nullable=true)
     */
    private $czyProgramLojalnosciowy = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_domyslny_adres_faktury", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idDomyslnyAdresFaktury = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_domyslny_adres_dostawy", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idDomyslnyAdresDostawy = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="status_potwierdzil", type="boolean", nullable=true)
     */
    private $statusPotwierdzil;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="data_potwierdzil", type="datetime", nullable=true)
     */
    private $dataPotwierdzil;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="akcja_budzet", type="boolean", nullable=true, options={"default"="1"})
     */
    private $akcjaBudzet = '1';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_testowe", type="boolean", nullable=true)
     */
    private $czyTestowe = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_mail_przelogowanie", type="boolean", nullable=true)
     */
    private $czyMailPrzelogowanie = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="data_mail_przelogowanie", type="datetime", nullable=true)
     */
    private $dataMailPrzelogowanie;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_klauzula_rodo", type="boolean", nullable=true)
     */
    private $czyKlauzulaRodo;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_regulamin_polityka", type="boolean", nullable=true)
     */
    private $czyRegulaminPolityka;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="data_zgody", type="datetime", nullable=true)
     */
    private $dataZgody;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ip_zgody", type="string", length=30, nullable=true)
     */
    private $ipZgody;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_rejestracji", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idRejestracji = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="id_moduly", type="boolean", nullable=true, options={"default"="1"})
     */
    private $idModuly = '1';

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_pracownika", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idPracownika = '0';

    public function getIdAuth(): ?int
    {
        return $this->idAuth;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRodzajUser(): ?bool
    {
        return $this->rodzajUser;
    }

    public function setRodzajUser(bool $rodzajUser): self
    {
        $this->rodzajUser = $rodzajUser;

        return $this;
    }

    public function getImieNazwisko(): ?string
    {
        return $this->imieNazwisko;
    }

    public function setImieNazwisko(string $imieNazwisko): self
    {
        $this->imieNazwisko = $imieNazwisko;

        return $this;
    }

    public function getOpisUzytkownika(): ?string
    {
        return $this->opisUzytkownika;
    }

    public function setOpisUzytkownika(string $opisUzytkownika): self
    {
        $this->opisUzytkownika = $opisUzytkownika;

        return $this;
    }

    public function getAdresEmail(): ?string
    {
        return $this->adresEmail;
    }

    public function setAdresEmail(string $adresEmail): self
    {
        $this->adresEmail = $adresEmail;

        return $this;
    }

    public function getCzyAktywny(): ?bool
    {
        return $this->czyAktywny;
    }

    public function setCzyAktywny(bool $czyAktywny): self
    {
        $this->czyAktywny = $czyAktywny;

        return $this;
    }

    public function getCzyUsuniety(): ?bool
    {
        return $this->czyUsuniety;
    }

    public function setCzyUsuniety(bool $czyUsuniety): self
    {
        $this->czyUsuniety = $czyUsuniety;

        return $this;
    }

    public function getTelefon(): ?string
    {
        return $this->telefon;
    }

    public function setTelefon(?string $telefon): self
    {
        $this->telefon = $telefon;

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

    public function getIdUserSolal(): ?int
    {
        return $this->idUserSolal;
    }

    public function setIdUserSolal(?int $idUserSolal): self
    {
        $this->idUserSolal = $idUserSolal;

        return $this;
    }

    public function getPasswordOld(): ?string
    {
        return $this->passwordOld;
    }

    public function setPasswordOld(?string $passwordOld): self
    {
        $this->passwordOld = $passwordOld;

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

    public function getIdAuthAkceptuj(): ?int
    {
        return $this->idAuthAkceptuj;
    }

    public function setIdAuthAkceptuj(?int $idAuthAkceptuj): self
    {
        $this->idAuthAkceptuj = $idAuthAkceptuj;

        return $this;
    }

    public function getZmianaHasla(): ?bool
    {
        return $this->zmianaHasla;
    }

    public function setZmianaHasla(?bool $zmianaHasla): self
    {
        $this->zmianaHasla = $zmianaHasla;

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

    public function getOgraniczCennik(): ?bool
    {
        return $this->ograniczCennik;
    }

    public function setOgraniczCennik(?bool $ograniczCennik): self
    {
        $this->ograniczCennik = $ograniczCennik;

        return $this;
    }

    public function getCzyMinikatalog(): ?bool
    {
        return $this->czyMinikatalog;
    }

    public function setCzyMinikatalog(?bool $czyMinikatalog): self
    {
        $this->czyMinikatalog = $czyMinikatalog;

        return $this;
    }

    public function getPoziomAkceptuj(): ?bool
    {
        return $this->poziomAkceptuj;
    }

    public function setPoziomAkceptuj(?bool $poziomAkceptuj): self
    {
        $this->poziomAkceptuj = $poziomAkceptuj;

        return $this;
    }

    public function getPoziomKatalog(): ?bool
    {
        return $this->poziomKatalog;
    }

    public function setPoziomKatalog(?bool $poziomKatalog): self
    {
        $this->poziomKatalog = $poziomKatalog;

        return $this;
    }

    public function getCzyStanSie(): ?bool
    {
        return $this->czyStanSie;
    }

    public function setCzyStanSie(?bool $czyStanSie): self
    {
        $this->czyStanSie = $czyStanSie;

        return $this;
    }

    public function getCzyWidziCeny(): ?bool
    {
        return $this->czyWidziCeny;
    }

    public function setCzyWidziCeny(?bool $czyWidziCeny): self
    {
        $this->czyWidziCeny = $czyWidziCeny;

        return $this;
    }

    public function getCzyWidziPromocje(): ?bool
    {
        return $this->czyWidziPromocje;
    }

    public function setCzyWidziPromocje(?bool $czyWidziPromocje): self
    {
        $this->czyWidziPromocje = $czyWidziPromocje;

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

    public function getIdDomyslnyAdresFaktury(): ?int
    {
        return $this->idDomyslnyAdresFaktury;
    }

    public function setIdDomyslnyAdresFaktury(?int $idDomyslnyAdresFaktury): self
    {
        $this->idDomyslnyAdresFaktury = $idDomyslnyAdresFaktury;

        return $this;
    }

    public function getIdDomyslnyAdresDostawy(): ?int
    {
        return $this->idDomyslnyAdresDostawy;
    }

    public function setIdDomyslnyAdresDostawy(?int $idDomyslnyAdresDostawy): self
    {
        $this->idDomyslnyAdresDostawy = $idDomyslnyAdresDostawy;

        return $this;
    }

    public function getStatusPotwierdzil(): ?bool
    {
        return $this->statusPotwierdzil;
    }

    public function setStatusPotwierdzil(?bool $statusPotwierdzil): self
    {
        $this->statusPotwierdzil = $statusPotwierdzil;

        return $this;
    }

    public function getDataPotwierdzil(): ?\DateTimeInterface
    {
        return $this->dataPotwierdzil;
    }

    public function setDataPotwierdzil(?\DateTimeInterface $dataPotwierdzil): self
    {
        $this->dataPotwierdzil = $dataPotwierdzil;

        return $this;
    }

    public function getAkcjaBudzet(): ?bool
    {
        return $this->akcjaBudzet;
    }

    public function setAkcjaBudzet(?bool $akcjaBudzet): self
    {
        $this->akcjaBudzet = $akcjaBudzet;

        return $this;
    }

    public function getCzyTestowe(): ?bool
    {
        return $this->czyTestowe;
    }

    public function setCzyTestowe(?bool $czyTestowe): self
    {
        $this->czyTestowe = $czyTestowe;

        return $this;
    }

    public function getCzyMailPrzelogowanie(): ?bool
    {
        return $this->czyMailPrzelogowanie;
    }

    public function setCzyMailPrzelogowanie(?bool $czyMailPrzelogowanie): self
    {
        $this->czyMailPrzelogowanie = $czyMailPrzelogowanie;

        return $this;
    }

    public function getDataMailPrzelogowanie(): ?\DateTimeInterface
    {
        return $this->dataMailPrzelogowanie;
    }

    public function setDataMailPrzelogowanie(?\DateTimeInterface $dataMailPrzelogowanie): self
    {
        $this->dataMailPrzelogowanie = $dataMailPrzelogowanie;

        return $this;
    }

    public function getCzyKlauzulaRodo(): ?bool
    {
        return $this->czyKlauzulaRodo;
    }

    public function setCzyKlauzulaRodo(?bool $czyKlauzulaRodo): self
    {
        $this->czyKlauzulaRodo = $czyKlauzulaRodo;

        return $this;
    }

    public function getCzyRegulaminPolityka(): ?bool
    {
        return $this->czyRegulaminPolityka;
    }

    public function setCzyRegulaminPolityka(?bool $czyRegulaminPolityka): self
    {
        $this->czyRegulaminPolityka = $czyRegulaminPolityka;

        return $this;
    }

    public function getDataZgody(): ?\DateTimeInterface
    {
        return $this->dataZgody;
    }

    public function setDataZgody(?\DateTimeInterface $dataZgody): self
    {
        $this->dataZgody = $dataZgody;

        return $this;
    }

    public function getIpZgody(): ?string
    {
        return $this->ipZgody;
    }

    public function setIpZgody(?string $ipZgody): self
    {
        $this->ipZgody = $ipZgody;

        return $this;
    }

    public function getIdRejestracji(): ?int
    {
        return $this->idRejestracji;
    }

    public function setIdRejestracji(?int $idRejestracji): self
    {
        $this->idRejestracji = $idRejestracji;

        return $this;
    }

    public function getIdModuly(): ?bool
    {
        return $this->idModuly;
    }

    public function setIdModuly(?bool $idModuly): self
    {
        $this->idModuly = $idModuly;

        return $this;
    }

    public function getIdPracownika(): ?int
    {
        return $this->idPracownika;
    }

    public function setIdPracownika(?int $idPracownika): self
    {
        $this->idPracownika = $idPracownika;

        return $this;
    }


}
