<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EkategorieJezyki
 *
 * @ORM\Table(name="ekategorie_jezyki")
 * @ORM\Entity
 */
class EkategorieJezyki
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
     * @var int|null
     *
     * @ORM\Column(name="id_kategorii", type="bigint", nullable=true, options={"unsigned"=true})
     */
    private $idKategorii;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="id_jezyka", type="boolean", nullable=true)
     */
    private $idJezyka;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nazwa_kategorii", type="string", length=255, nullable=true)
     */
    private $nazwaKategorii;

    /**
     * @var string|null
     *
     * @ORM\Column(name="opis_kategorii", type="text", length=65535, nullable=true)
     */
    private $opisKategorii;

    /**
     * @var string|null
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="keywords", type="string", length=255, nullable=true)
     */
    private $keywords;

    /**
     * @var string|null
     *
     * @ORM\Column(name="naglowek_seo", type="string", length=255, nullable=true)
     */
    private $naglowekSeo;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getIdKategorii(): ?string
    {
        return $this->idKategorii;
    }

    public function setIdKategorii(?string $idKategorii): self
    {
        $this->idKategorii = $idKategorii;

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

    public function getNazwaKategorii(): ?string
    {
        return $this->nazwaKategorii;
    }

    public function setNazwaKategorii(?string $nazwaKategorii): self
    {
        $this->nazwaKategorii = $nazwaKategorii;

        return $this;
    }

    public function getOpisKategorii(): ?string
    {
        return $this->opisKategorii;
    }

    public function setOpisKategorii(?string $opisKategorii): self
    {
        $this->opisKategorii = $opisKategorii;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function getNaglowekSeo(): ?string
    {
        return $this->naglowekSeo;
    }

    public function setNaglowekSeo(?string $naglowekSeo): self
    {
        $this->naglowekSeo = $naglowekSeo;

        return $this;
    }


}
