<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArtykulyWyroznienia
 *
 * @ORM\Table(name="artykuly_wyroznienia")
 * @ORM\Entity
 */
class ArtykulyWyroznienia
{
    /**
     * @var bool
     *
     * @ORM\Column(name="id_wyroznienia", type="boolean", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idWyroznienia;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="aktualizacja_wfmag", type="boolean", nullable=true)
     */
    private $aktualizacjaWfmag = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_widoczna", type="boolean", nullable=true)
     */
    private $czyWidoczna = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_glowna", type="boolean", nullable=true)
     */
    private $czyGlowna = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="data_utworzenia", type="date", nullable=true)
     */
    private $dataUtworzenia;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_dostawy", type="boolean", nullable=true)
     */
    private $czyDostawy = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="jako_dostawy", type="boolean", nullable=true)
     */
    private $jakoDostawy = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="nazwa_robocza", type="string", length=255, nullable=true)
     */
    private $nazwaRobocza;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_lewe_menu", type="boolean", nullable=true, options={"default"="1"})
     */
    private $czyLeweMenu = '1';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="kolejnosc", type="boolean", nullable=true)
     */
    private $kolejnosc;

    /**
     * @var string|null
     *
     * @ORM\Column(name="kolor", type="string", length=7, nullable=true)
     */
    private $kolor;

    /**
     * @var string|null
     *
     * @ORM\Column(name="kolor_tla", type="string", length=7, nullable=true)
     */
    private $kolorTla;

    public function getIdWyroznienia(): ?bool
    {
        return $this->idWyroznienia;
    }

    public function getAktualizacjaWfmag(): ?bool
    {
        return $this->aktualizacjaWfmag;
    }

    public function setAktualizacjaWfmag(?bool $aktualizacjaWfmag): self
    {
        $this->aktualizacjaWfmag = $aktualizacjaWfmag;

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

    public function getCzyGlowna(): ?bool
    {
        return $this->czyGlowna;
    }

    public function setCzyGlowna(?bool $czyGlowna): self
    {
        $this->czyGlowna = $czyGlowna;

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

    public function getCzyDostawy(): ?bool
    {
        return $this->czyDostawy;
    }

    public function setCzyDostawy(?bool $czyDostawy): self
    {
        $this->czyDostawy = $czyDostawy;

        return $this;
    }

    public function getJakoDostawy(): ?bool
    {
        return $this->jakoDostawy;
    }

    public function setJakoDostawy(?bool $jakoDostawy): self
    {
        $this->jakoDostawy = $jakoDostawy;

        return $this;
    }

    public function getNazwaRobocza(): ?string
    {
        return $this->nazwaRobocza;
    }

    public function setNazwaRobocza(?string $nazwaRobocza): self
    {
        $this->nazwaRobocza = $nazwaRobocza;

        return $this;
    }

    public function getCzyLeweMenu(): ?bool
    {
        return $this->czyLeweMenu;
    }

    public function setCzyLeweMenu(?bool $czyLeweMenu): self
    {
        $this->czyLeweMenu = $czyLeweMenu;

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

    public function getKolor(): ?string
    {
        return $this->kolor;
    }

    public function setKolor(?string $kolor): self
    {
        $this->kolor = $kolor;

        return $this;
    }

    public function getKolorTla(): ?string
    {
        return $this->kolorTla;
    }

    public function setKolorTla(?string $kolorTla): self
    {
        $this->kolorTla = $kolorTla;

        return $this;
    }


}
