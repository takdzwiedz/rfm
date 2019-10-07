<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserAuthLogowania
 *
 * @ORM\Table(name="user_auth_logowania")
 * @ORM\Entity
 */
class UserAuthLogowania
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
     * @ORM\Column(name="id_auth", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $idAuth;

    /**
     * @var string
     *
     * @ORM\Column(name="id_sesji", type="string", length=32, nullable=false)
     */
    private $idSesji;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=15, nullable=false)
     */
    private $ip;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_zalogowania", type="datetime", nullable=false)
     */
    private $dataZalogowania;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_wylogowania", type="datetime", nullable=false, options={"default"="0000-00-00 00:00:00"})
     */
    private $dataWylogowania = '0000-00-00 00:00:00';

    public function getId(): ?string
    {
        return $this->id;
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

    public function getIdSesji(): ?string
    {
        return $this->idSesji;
    }

    public function setIdSesji(string $idSesji): self
    {
        $this->idSesji = $idSesji;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getDataZalogowania(): ?\DateTimeInterface
    {
        return $this->dataZalogowania;
    }

    public function setDataZalogowania(\DateTimeInterface $dataZalogowania): self
    {
        $this->dataZalogowania = $dataZalogowania;

        return $this;
    }

    public function getDataWylogowania(): ?\DateTimeInterface
    {
        return $this->dataWylogowania;
    }

    public function setDataWylogowania(\DateTimeInterface $dataWylogowania): self
    {
        $this->dataWylogowania = $dataWylogowania;

        return $this;
    }


}
