<?php

namespace FormBM\BMBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Fiche
 *
 * @ORM\Table(name="fiche")
 * @ORM\Entity(repositoryClass="FormBM\BMBundle\Repository\FicheRepository")
 */
class Fiche
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="FormBM\BMBundle\Entity\Entreprise", cascade = {"persist"})
     */
    private $entreprise;

    
    /**
     * @ORM\ManyToOne(targetEntity="FormBM\BMBundle\Entity\SousTheme", inversedBy="fiche")
     * @Assert\NotBlank()
     */
    private $soustheme;


    /**
     * @var int
     *
     * @ORM\Column(name="pourcentage", type="integer", nullable=true)
     */
    private $pourcentage;



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
     * Set pourcentage
     *
     * @param integer $pourcentage
     *
     * @return Fiche
     */
    public function setPourcentage($pourcentage)
    {
        $this->pourcentage = $pourcentage;

        return $this;
    }

    /**
     * Get pourcentage
     *
     * @return integer
     */
    public function getPourcentage()
    {
        return $this->pourcentage;
    }

    /**
     * Set entreprise
     *
     * @param \FormBM\BMBundle\Entity\Entreprise $entreprise
     *
     * @return Fiche
     */
    public function setEntreprise(\FormBM\BMBundle\Entity\Entreprise $entreprise = null)
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * Get entreprise
     *
     * @return \FormBM\BMBundle\Entity\Entreprise
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }

    /**
     * Set soustheme
     *
     * @param \FormBM\BMBundle\Entity\SousTheme $soustheme
     *
     * @return Fiche
     */
    public function setSoustheme(\FormBM\BMBundle\Entity\SousTheme $soustheme = null)
    {
        $this->soustheme = $soustheme;

        return $this;
    }

    /**
     * Get soustheme
     *
     * @return \FormBM\BMBundle\Entity\SousTheme
     */
    public function getSoustheme()
    {
        return $this->soustheme;
    }
}
