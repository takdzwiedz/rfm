<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArtykulyWyroznieniaJezyki
 *
 * @ORM\Table(name="artykuly_wyroznienia_jezyki")
 * @ORM\Entity
 */
class ArtykulyWyroznieniaJezyki
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
     * @var bool|null
     *
     * @ORM\Column(name="id_wyroznienia", type="boolean", nullable=true)
     */
    private $idWyroznienia;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="id_jezyka", type="boolean", nullable=true)
     */
    private $idJezyka;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nazwa_wyroznienia", type="string", length=255, nullable=true)
     */
    private $nazwaWyroznienia;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nazwa_zdjecia", type="string", length=255, nullable=true)
     */
    private $nazwaZdjecia;

    /**
     * @var string|null
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="keywords", type="string", length=255, nullable=true)
     */
    private $keywords;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdWyroznienia(): ?bool
    {
        return $this->idWyroznienia;
    }

    public function setIdWyroznienia(?bool $idWyroznienia): self
    {
        $this->idWyroznienia = $idWyroznienia;

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

    public function getNazwaWyroznienia(): ?string
    {
        return $this->nazwaWyroznienia;
    }

    public function setNazwaWyroznienia(?string $nazwaWyroznienia): self
    {
        $this->nazwaWyroznienia = $nazwaWyroznienia;

        return $this;
    }

    public function getNazwaZdjecia(): ?string
    {
        return $this->nazwaZdjecia;
    }

    public function setNazwaZdjecia(?string $nazwaZdjecia): self
    {
        $this->nazwaZdjecia = $nazwaZdjecia;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function setKeywords(?string $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }


}
