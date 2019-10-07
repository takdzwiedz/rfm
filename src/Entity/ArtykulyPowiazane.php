<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArtykulyPowiazane
 *
 * @ORM\Table(name="artykuly_powiazane")
 * @ORM\Entity
 */
class ArtykulyPowiazane
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="id_artykul_glowny", type="bigint", nullable=false, options={"unsigned"=true})
     */
    private $idArtykulGlowny;

    /**
     * @var int
     *
     * @ORM\Column(name="id_artykul_powiazany", type="bigint", nullable=false, options={"unsigned"=true})
     */
    private $idArtykulPowiazany;

    /**
     * @var bool
     *
     * @ORM\Column(name="rodzaj_powiazania", type="boolean", nullable=false)
     */
    private $rodzajPowiazania;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getIdArtykulGlowny(): ?string
    {
        return $this->idArtykulGlowny;
    }

    public function setIdArtykulGlowny(string $idArtykulGlowny): self
    {
        $this->idArtykulGlowny = $idArtykulGlowny;

        return $this;
    }

    public function getIdArtykulPowiazany(): ?string
    {
        return $this->idArtykulPowiazany;
    }

    public function setIdArtykulPowiazany(string $idArtykulPowiazany): self
    {
        $this->idArtykulPowiazany = $idArtykulPowiazany;

        return $this;
    }

    public function getRodzajPowiazania(): ?bool
    {
        return $this->rodzajPowiazania;
    }

    public function setRodzajPowiazania(bool $rodzajPowiazania): self
    {
        $this->rodzajPowiazania = $rodzajPowiazania;

        return $this;
    }


}
