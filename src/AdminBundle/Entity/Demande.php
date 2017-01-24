<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demande
 *
 * @ORM\Table(name="demande")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\DemandeRepository")
 */
class Demande
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
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=255)
     */
    private $img;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="estimation", type="string", length=255)
     */
    private $estimation;

    /**
     * @var string
     *
     * @ORM\Column(name="demandeur", type="string", length=255)
     */
    private $demandeur;

     /**
     *@var datetime
     * 
     * @ORM\Column(name="dateparution", type="datetime")
     */
    
    private $dateparution;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumn(name="fk_categorie", referencedColumnName="id")
     */

    /* Ici on a lié les tables catégorie et localité à notre table annonce */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Localite")
     * @ORM\JoinColumn(name="fk_localite", referencedColumnName="id")
     */
    
    private $localite;


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
     * Set titre
     *
     * @param string $titre
     *
     * @return Demande
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set img
     *
     * @param string $img
     *
     * @return Demande
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img
     *
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Demande
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set estimation
     *
     * @param string $estimation
     *
     * @return Demande
     */
    public function setEstimation($estimation)
    {
        $this->estimation = $estimation;

        return $this;
    }

    /**
     * Get estimation
     *
     * @return string
     */
    public function getEstimation()
    {
        return $this->estimation;
    }

    /**
     * Set demandeur
     *
     * @param string $demandeur
     *
     * @return Demande
     */
    public function setDemandeur($demandeur)
    {
        $this->demandeur = $demandeur;

        return $this;
    }

    /**
     * Get demandeur
     *
     * @return string
     */
    public function getDemandeur()
    {
        return $this->demandeur;
    }

    /**
     * Set dateparution
     *
     * @param string $dateparution
     *
     * @return Demande
     */
    public function setDateparution($dateparution)
    {
        $this->dateparution = $dateparution;

        return $this;
    }

    /**
     * Get dateparution
     *
     * @return string
     */
    public function getDateparution()
    {
        return $this->dateparution;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Demande
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     *
     * @return Demande
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set localite
     *
     * @param string $localite
     *
     * @return Demande
     */
    public function setLocalite($localite)
    {
        $this->localite = $localite;

        return $this;
    }

    /**
     * Get localite
     *
     * @return string
     */
    public function getLocalite()
    {
        return $this->localite;
    }
}

