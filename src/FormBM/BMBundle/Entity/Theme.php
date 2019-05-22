<?php

namespace FormBM\BMBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Theme
 *
 * @ORM\Table(name="theme")
 * @ORM\Entity(repositoryClass="FormBM\BMBundle\Repository\ThemeRepository")
 */
class Theme
{

    /**
     * @ORM\OneToMany(targetEntity="FormBM\BMBundle\Entity\SousTheme",mappedBy="theme")
     */
    private $sousthemes;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

 	public function __toString() {
    return $this->libelle;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->soustheme = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Theme
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Add soustheme
     *
     * @param \FormBM\BMBundle\Entity\SousTheme $soustheme
     *
     * @return Theme
     */
    public function addSoustheme(\FormBM\BMBundle\Entity\SousTheme $soustheme)
    {
        $this->soustheme[] = $soustheme;

        return $this;
    }

    /**
     * Remove soustheme
     *
     * @param \FormBM\BMBundle\Entity\SousTheme $soustheme
     */
    public function removeSoustheme(\FormBM\BMBundle\Entity\SousTheme $soustheme)
    {
        $this->soustheme->removeElement($soustheme);
    }

    /**
     * Get soustheme
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSoustheme()
    {
        return $this->soustheme;
    }

    /**
     * Get sousthemes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSousthemes()
    {
        return $this->sousthemes;
    }
}
