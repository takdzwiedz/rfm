<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserAuthFirmy
 *
 * @ORM\Table(name="user_auth_firmy")
 * @ORM\Entity
 */
class UserAuthFirmy
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
     * @ORM\Column(name="id_auth", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $idAuth;

    /**
     * @var int
     *
     * @ORM\Column(name="id_firmy", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $idFirmy;

    public function getId(): ?int
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

    public function getIdFirmy(): ?int
    {
        return $this->idFirmy;
    }

    public function setIdFirmy(int $idFirmy): self
    {
        $this->idFirmy = $idFirmy;

        return $this;
    }


}
