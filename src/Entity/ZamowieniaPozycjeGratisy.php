<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZamowieniaPozycjeGratisy
 *
 * @ORM\Table(name="zamowienia_pozycje_gratisy")
 * @ORM\Entity
 */
class ZamowieniaPozycjeGratisy
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_gratisu_zamowienia", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idGratisuZamowienia;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_pozycji_zamowienia", type="bigint", nullable=true, options={"unsigned"=true})
     */
    private $idPozycjiZamowienia;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_gratisu", type="bigint", nullable=true, options={"unsigned"=true})
     */
    private $idGratisu;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="ilosc_gratisu", type="boolean", nullable=true)
     */
    private $iloscGratisu;

    public function getIdGratisuZamowienia(): ?string
    {
        return $this->idGratisuZamowienia;
    }

    public function getIdPozycjiZamowienia(): ?string
    {
        return $this->idPozycjiZamowienia;
    }

    public function setIdPozycjiZamowienia(?string $idPozycjiZamowienia): self
    {
        $this->idPozycjiZamowienia = $idPozycjiZamowienia;

        return $this;
    }

    public function getIdGratisu(): ?string
    {
        return $this->idGratisu;
    }

    public function setIdGratisu(?string $idGratisu): self
    {
        $this->idGratisu = $idGratisu;

        return $this;
    }

    public function getIloscGratisu(): ?bool
    {
        return $this->iloscGratisu;
    }

    public function setIloscGratisu(?bool $iloscGratisu): self
    {
        $this->iloscGratisu = $iloscGratisu;

        return $this;
    }


}
