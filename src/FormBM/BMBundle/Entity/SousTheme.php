<?php

namespace FormBM\BMBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SousTheme
 *
 * @ORM\Table(name="sous_theme")
 * @ORM\Entity(repositoryClass="FormBM\BMBundle\Repository\SousThemeRepository")
 */
class SousTheme
{

 
    /**
     * @ORM\ManyToOne(targetEntity="FormBM\BMBundle\Entity\Theme", inversedBy = "sousthemes" )
     */
    private $theme;
    /**
     * @ORM\OneToMany(targetEntity="FormBM\BMBundle\Entity\Fiche", mappedBy = "soustheme" )
     */
    private $fiche;

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
        $this->fiche = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return SousTheme
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
     * Set theme
     *
     * @param \FormBM\BMBundle\Entity\Theme $theme
     *
     * @return SousTheme
     */
    public function setTheme(\FormBM\BMBundle\Entity\Theme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \FormBM\BMBundle\Entity\Theme
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Add fiche
     *
     * @param \FormBM\BMBundle\Entity\Fiche $fiche
     *
     * @return SousTheme
     */
    public function addFiche(\FormBM\BMBundle\Entity\Fiche $fiche)
    {
        $this->fiche[] = $fiche;

        return $this;
    }

    /**
     * Remove fiche
     *
     * @param \FormBM\BMBundle\Entity\Fiche $fiche
     */
    public function removeFiche(\FormBM\BMBundle\Entity\Fiche $fiche)
    {
        $this->fiche->removeElement($fiche);
    }

    /**
     * Get fiche
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFiche()
    {
        return $this->fiche;
    }

    /**
     * Add theme
     *
     * @param \FormBM\BMBundle\Entity\Theme $theme
     *
     * @return SousTheme
     */
    public function addTheme(\FormBM\BMBundle\Entity\Theme $theme)
    {
        $this->theme[] = $theme;

        return $this;
    }

    /**
     * Remove theme
     *
     * @param \FormBM\BMBundle\Entity\Theme $theme
     */
    public function removeTheme(\FormBM\BMBundle\Entity\Theme $theme)
    {
        $this->theme->removeElement($theme);
    }
}
