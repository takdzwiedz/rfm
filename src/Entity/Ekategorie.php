<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ekategorie
 *
 * @ORM\Table(name="ekategorie")
 * @ORM\Entity
 */
class Ekategorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_kategorii", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idKategorii;

    /**
     * @var int
     *
     * @ORM\Column(name="update_person_id", type="bigint", nullable=false)
     */
    private $updatePersonId;

    /**
     * @var int
     *
     * @ORM\Column(name="create_person_id", type="bigint", nullable=false)
     */
    private $createPersonId;

    /**
     * @var int
     *
     * @ORM\Column(name="publication_state_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $publicationStateId;

    /**
     * @var int
     *
     * @ORM\Column(name="p_catalog_id", type="bigint", nullable=false)
     */
    private $pCatalogId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_ojca", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $idOjca;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nazwa_kategorii", type="string", length=255, nullable=true)
     */
    private $nazwaKategorii;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="publication_date_from", type="datetime", nullable=true)
     */
    private $publicationDateFrom;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="publication_date_to", type="datetime", nullable=true)
     */
    private $publicationDateTo;

    /**
     * @var bool
     *
     * @ORM\Column(name="publication_always", type="boolean", nullable=false, options={"default"="1"})
     */
    private $publicationAlways = '1';

    /**
     * @var string|null
     *
     * @ORM\Column(name="photo_url_th", type="string", length=255, nullable=true)
     */
    private $photoUrlTh;

    /**
     * @var string|null
     *
     * @ORM\Column(name="photo_url", type="string", length=255, nullable=true)
     */
    private $photoUrl;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean", nullable=false, options={"default"="1"})
     */
    private $active = '1';

    /**
     * @var int
     *
     * @ORM\Column(name="sort", type="integer", nullable=false, options={"default"="100"})
     */
    private $sort = '100';

    /**
     * @var string|null
     *
     * @ORM\Column(name="html_desc", type="text", length=65535, nullable=true)
     */
    private $htmlDesc;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="creation_date", type="datetime", nullable=true)
     */
    private $creationDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="update_date", type="datetime", nullable=true)
     */
    private $updateDate;

    /**
     * @var int|null
     *
     * @ORM\Column(name="lft", type="bigint", nullable=true)
     */
    private $lft;

    /**
     * @var int|null
     *
     * @ORM\Column(name="rgt", type="bigint", nullable=true)
     */
    private $rgt;

    /**
     * @var string
     *
     * @ORM\Column(name="locale_id", type="string", length=20, nullable=false, options={"default"="pl_PL","fixed"=true})
     */
    private $localeId = 'pl_PL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="html_desc_short", type="text", length=65535, nullable=true)
     */
    private $htmlDescShort;

    /**
     * @var string|null
     *
     * @ORM\Column(name="links", type="text", length=65535, nullable=true)
     */
    private $links;

    /**
     * @var string|null
     *
     * @ORM\Column(name="slider", type="text", length=65535, nullable=true)
     */
    private $slider;

    /**
     * @var bool
     *
     * @ORM\Column(name="some_parent_inactive", type="boolean", nullable=false)
     */
    private $someParentInactive = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="extra1", type="text", length=65535, nullable=true)
     */
    private $extra1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="extra2", type="text", length=65535, nullable=true)
     */
    private $extra2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="seo_title", type="text", length=65535, nullable=true)
     */
    private $seoTitle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="seo_description", type="text", length=65535, nullable=true)
     */
    private $seoDescription;

    /**
     * @var string|null
     *
     * @ORM\Column(name="seo_keywords", type="text", length=65535, nullable=true)
     */
    private $seoKeywords;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_kategorii_wfmag", type="bigint", nullable=true, options={"unsigned"=true})
     */
    private $idKategoriiWfmag;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="czy_widoczna", type="boolean", nullable=true, options={"default"="1"})
     */
    private $czyWidoczna = '1';

    /**
     * @var string|null
     *
     * @ORM\Column(name="zdjecie", type="string", length=255, nullable=true)
     */
    private $zdjecie;

    /**
     * @var string|null
     *
     * @ORM\Column(name="opis", type="text", length=65535, nullable=true)
     */
    private $opis;

    public function getIdKategorii(): ?int
    {
        return $this->idKategorii;
    }

    public function getUpdatePersonId(): ?string
    {
        return $this->updatePersonId;
    }

    public function setUpdatePersonId(string $updatePersonId): self
    {
        $this->updatePersonId = $updatePersonId;

        return $this;
    }

    public function getCreatePersonId(): ?string
    {
        return $this->createPersonId;
    }

    public function setCreatePersonId(string $createPersonId): self
    {
        $this->createPersonId = $createPersonId;

        return $this;
    }

    public function getPublicationStateId(): ?int
    {
        return $this->publicationStateId;
    }

    public function setPublicationStateId(int $publicationStateId): self
    {
        $this->publicationStateId = $publicationStateId;

        return $this;
    }

    public function getPCatalogId(): ?string
    {
        return $this->pCatalogId;
    }

    public function setPCatalogId(string $pCatalogId): self
    {
        $this->pCatalogId = $pCatalogId;

        return $this;
    }

    public function getIdOjca(): ?int
    {
        return $this->idOjca;
    }

    public function setIdOjca(?int $idOjca): self
    {
        $this->idOjca = $idOjca;

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

    public function getPublicationDateFrom(): ?\DateTimeInterface
    {
        return $this->publicationDateFrom;
    }

    public function setPublicationDateFrom(?\DateTimeInterface $publicationDateFrom): self
    {
        $this->publicationDateFrom = $publicationDateFrom;

        return $this;
    }

    public function getPublicationDateTo(): ?\DateTimeInterface
    {
        return $this->publicationDateTo;
    }

    public function setPublicationDateTo(?\DateTimeInterface $publicationDateTo): self
    {
        $this->publicationDateTo = $publicationDateTo;

        return $this;
    }

    public function getPublicationAlways(): ?bool
    {
        return $this->publicationAlways;
    }

    public function setPublicationAlways(bool $publicationAlways): self
    {
        $this->publicationAlways = $publicationAlways;

        return $this;
    }

    public function getPhotoUrlTh(): ?string
    {
        return $this->photoUrlTh;
    }

    public function setPhotoUrlTh(?string $photoUrlTh): self
    {
        $this->photoUrlTh = $photoUrlTh;

        return $this;
    }

    public function getPhotoUrl(): ?string
    {
        return $this->photoUrl;
    }

    public function setPhotoUrl(?string $photoUrl): self
    {
        $this->photoUrl = $photoUrl;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getSort(): ?int
    {
        return $this->sort;
    }

    public function setSort(int $sort): self
    {
        $this->sort = $sort;

        return $this;
    }

    public function getHtmlDesc(): ?string
    {
        return $this->htmlDesc;
    }

    public function setHtmlDesc(?string $htmlDesc): self
    {
        $this->htmlDesc = $htmlDesc;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(?\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getUpdateDate(): ?\DateTimeInterface
    {
        return $this->updateDate;
    }

    public function setUpdateDate(?\DateTimeInterface $updateDate): self
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    public function getLft(): ?string
    {
        return $this->lft;
    }

    public function setLft(?string $lft): self
    {
        $this->lft = $lft;

        return $this;
    }

    public function getRgt(): ?string
    {
        return $this->rgt;
    }

    public function setRgt(?string $rgt): self
    {
        $this->rgt = $rgt;

        return $this;
    }

    public function getLocaleId(): ?string
    {
        return $this->localeId;
    }

    public function setLocaleId(string $localeId): self
    {
        $this->localeId = $localeId;

        return $this;
    }

    public function getHtmlDescShort(): ?string
    {
        return $this->htmlDescShort;
    }

    public function setHtmlDescShort(?string $htmlDescShort): self
    {
        $this->htmlDescShort = $htmlDescShort;

        return $this;
    }

    public function getLinks(): ?string
    {
        return $this->links;
    }

    public function setLinks(?string $links): self
    {
        $this->links = $links;

        return $this;
    }

    public function getSlider(): ?string
    {
        return $this->slider;
    }

    public function setSlider(?string $slider): self
    {
        $this->slider = $slider;

        return $this;
    }

    public function getSomeParentInactive(): ?bool
    {
        return $this->someParentInactive;
    }

    public function setSomeParentInactive(bool $someParentInactive): self
    {
        $this->someParentInactive = $someParentInactive;

        return $this;
    }

    public function getExtra1(): ?string
    {
        return $this->extra1;
    }

    public function setExtra1(?string $extra1): self
    {
        $this->extra1 = $extra1;

        return $this;
    }

    public function getExtra2(): ?string
    {
        return $this->extra2;
    }

    public function setExtra2(?string $extra2): self
    {
        $this->extra2 = $extra2;

        return $this;
    }

    public function getSeoTitle(): ?string
    {
        return $this->seoTitle;
    }

    public function setSeoTitle(?string $seoTitle): self
    {
        $this->seoTitle = $seoTitle;

        return $this;
    }

    public function getSeoDescription(): ?string
    {
        return $this->seoDescription;
    }

    public function setSeoDescription(?string $seoDescription): self
    {
        $this->seoDescription = $seoDescription;

        return $this;
    }

    public function getSeoKeywords(): ?string
    {
        return $this->seoKeywords;
    }

    public function setSeoKeywords(?string $seoKeywords): self
    {
        $this->seoKeywords = $seoKeywords;

        return $this;
    }

    public function getIdKategoriiWfmag(): ?string
    {
        return $this->idKategoriiWfmag;
    }

    public function setIdKategoriiWfmag(?string $idKategoriiWfmag): self
    {
        $this->idKategoriiWfmag = $idKategoriiWfmag;

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

    public function getZdjecie(): ?string
    {
        return $this->zdjecie;
    }

    public function setZdjecie(?string $zdjecie): self
    {
        $this->zdjecie = $zdjecie;

        return $this;
    }

    public function getOpis(): ?string
    {
        return $this->opis;
    }

    public function setOpis(?string $opis): self
    {
        $this->opis = $opis;

        return $this;
    }


}
