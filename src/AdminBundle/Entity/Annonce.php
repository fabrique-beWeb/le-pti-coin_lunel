<?php
namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\File;

/**
 * Annonce
 *
 * @ORM\Table(name="annonce")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\AnnonceRepository")
 */
class Annonce
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
     * @File(mimeTypes={"image/jpeg","image/png"})
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
     * @ORM\Column(name="prix", type="string", length=255)
     */
    private $prix;
    /**
     * @var user
     *
     * @ORM\Column(name="user", type="string")
     */
    private $vendeur;
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
     * @return Annonce
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
     * @return Annonce
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
     * @return Annonce
     */
    public function setDescription($description)
    {
        $this->description = nl2br($description);
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
     * Set prix
     *
     * @param string $prix
     *
     * @return Annonce
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
        return $this;
    }
    /**
     * Get prix
     *
     * @return string
     */
    public function getPrix()
    {
        return $this->prix;
    }
    /**
     * Set vendeur
     *
     * @param string $vendeur
     *
     * @return Annonce
     */
    public function setVendeur($vendeur)
    {
        $this->vendeur = $vendeur;
        return $this;
    }
    /**
     * Get vendeur
     *
     * @return string
     */
    public function getVendeur()
    {
        return $this->vendeur;
    }
    /**
     * Set dateparution
     *
     * @param string $dateparution
     *
     * @return Annonce
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
     * @return Annonce
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
     * @return Annonce
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
     * @return Annonce
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
    
    /*On récupère le champ Titre du tableau Annonce */
     public function __toString() 
    {
         return $this->getTitre();
    }
    
}