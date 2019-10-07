<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KontrahenciGrupy
 *
 * @ORM\Table(name="kontrahenci_grupy")
 * @ORM\Entity
 */
class KontrahenciGrupy
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
     * @ORM\Column(name="id_grupy", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $idGrupy;

    /**
     * @var string
     *
     * @ORM\Column(name="nazwa_grupy", type="string", length=255, nullable=false)
     */
    private $nazwaGrupy;

    /**
     * @var string
     *
     * @ORM\Column(name="opis_grupy", type="text", length=255, nullable=false)
     */
    private $opisGrupy;

    /**
     * @var float|null
     *
     * @ORM\Column(name="narzut", type="float", precision=8, scale=2, nullable=true)
     */
    private $narzut;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_ceny", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idCeny;

    public function getId(): ?string
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

    public function getNazwaGrupy(): ?string
    {
        return $this->nazwaGrupy;
    }

    public function setNazwaGrupy(string $nazwaGrupy): self
    {
        $this->nazwaGrupy = $nazwaGrupy;

        return $this;
    }

    public function getOpisGrupy(): ?string
    {
        return $this->opisGrupy;
    }

    public function setOpisGrupy(string $opisGrupy): self
    {
        $this->opisGrupy = $opisGrupy;

        return $this;
    }

    public function getNarzut(): ?float
    {
        return $this->narzut;
    }

    public function setNarzut(?float $narzut): self
    {
        $this->narzut = $narzut;

        return $this;
    }

    public function getIdCeny(): ?int
    {
        return $this->idCeny;
    }

    public function setIdCeny(?int $idCeny): self
    {
        $this->idCeny = $idCeny;

        return $this;
    }


}
