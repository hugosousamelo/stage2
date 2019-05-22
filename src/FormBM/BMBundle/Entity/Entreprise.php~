<?php

namespace FormBM\BMBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entreprise
 *
 * @ORM\Table(name="entreprise")
 * @ORM\Entity(repositoryClass="FormBM\BMBundle\Repository\EntrepriseRepository")
 */
class Entreprise
{

    /**
     * @ORM\ManyToOne(targetEntity="FormBM\BMBundle\Entity\Logo", cascade = {"persist"})
     */
    private $logo;


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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var int
     *
     * @ORM\Column(name="codePostal", type="integer")
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="siteWeb", type="string", length=255)
     */
    private $siteWeb;

    /**
     * @var string
     *
     * @ORM\Column(name="nomDirigeant", type="string", length=255)
     */
    private $nomDirigeant;

    /**
     * @var string
     *
     * @ORM\Column(name="numTel", type="string", length=255)
     */
    private $numTel;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="numUnique", type="string", length=255, unique=true, nullable=true)
     */
    private $numUnique;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Entreprise
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Entreprise
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set codePostal
     *
     * @param integer $codePostal
     *
     * @return Entreprise
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return int
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set siteWeb
     *
     * @param string $siteWeb
     *
     * @return Entreprise
     */
    public function setSiteWeb($siteWeb)
    {
        $this->siteWeb = $siteWeb;

        return $this;
    }

    /**
     * Get siteWeb
     *
     * @return string
     */
    public function getSiteWeb()
    {
        return $this->siteWeb;
    }

    /**
     * Set nomDirigeant
     *
     * @param string $nomDirigeant
     *
     * @return Entreprise
     */
    public function setNomDirigeant($nomDirigeant)
    {
        $this->nomDirigeant = $nomDirigeant;

        return $this;
    }

    /**
     * Get nomDirigeant
     *
     * @return string
     */
    public function getNomDirigeant()
    {
        return $this->nomDirigeant;
    }

    /**
     * Set numTel
     *
     * @param string $numTel
     *
     * @return Entreprise
     */
    public function setNumTel($numTel)
    {
        $this->numTel = $numTel;

        return $this;
    }

    /**
     * Get numTel
     *
     * @return string
     */
    public function getNumTel()
    {
        return $this->numTel;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Entreprise
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set numUnique
     *
     * @param string $numUnique
     *
     * @return Entreprise
     */
    public function setNumUnique($numUnique)
    {
        $this->numUnique = $numUnique;

        return $this;
    }

    /**
     * Get numUnique
     *
     * @return string
     */
    public function getNumUnique()
    {
        return $this->numUnique;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->moyennest = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set logo
     *
     * @param \FormBM\BMBundle\Entity\Logo $logo
     *
     * @return Entreprise
     */
    public function setLogo(\FormBM\BMBundle\Entity\Logo $logo = null)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return \FormBM\BMBundle\Entity\Logo
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Add moyennest
     *
     * @param \FormBM\BMBundle\Entity\SousTheme $moyennest
     *
     * @return Entreprise
     */
    public function addMoyennest(\FormBM\BMBundle\Entity\SousTheme $moyennest)
    {
        $this->moyennest[] = $moyennest;

        return $this;
    }

    /**
     * Remove moyennest
     *
     * @param \FormBM\BMBundle\Entity\SousTheme $moyennest
     */
    public function removeMoyennest(\FormBM\BMBundle\Entity\SousTheme $moyennest)
    {
        $this->moyennest->removeElement($moyennest);
    }

    /**
     * Get moyennest
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMoyennest()
    {
        return $this->moyennest;
    }
}
