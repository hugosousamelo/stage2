<?php

namespace FormBM\BMBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avis
 *
 * @ORM\Table(name="avis")
 * @ORM\Entity(repositoryClass="FormBM\BMBundle\Repository\AvisRepository")
 */
class Avis
{

    /**
     * @ORM\ManyToOne(targetEntity="FormBM\BMBundle\Entity\Entreprise", cascade = {"persist"})
     */
    private $entreprise;
    /**
     * @ORM\ManyToOne(targetEntity="FormBM\BMBundle\Entity\MotCle", cascade = {"persist"})
     */
    private $motcle;
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
     * @ORM\Column(name="statut", type="string", length=255)
     */
    private $statut;


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
     * Set statut
     *
     * @param string $statut
     *
     * @return Avis
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set motcle
     *
     * @param \FormBM\BMBundle\Entity\MotCle $motcle
     *
     * @return Avis
     */
    public function setMotcle(\FormBM\BMBundle\Entity\MotCle $motcle = null)
    {
        $this->motcle = $motcle;

        return $this;
    }

    /**
     * Get motcle
     *
     * @return \FormBM\BMBundle\Entity\MotCle
     */
    public function getMotcle()
    {
        return $this->motcle;
    }

    /**
     * Set entreprise
     *
     * @param \FormBM\BMBundle\Entity\Entreprise $entreprise
     *
     * @return Avis
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
}
