<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

class User implements UserInterface, \Serializable {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
  
   /**
     * @ORM\Column(type="string", length=255)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=250)
     */
    private $plainPassword;

    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     *
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;
  
   /**
     * @ORM\Column(type="string", length=255)
     */
    private $departement;
  
    
  
  
	//CONSTRUCTEUR
  
    /**
     * @ORM\Column(name="roles", type="array")
     */
    private $roles = array();
  
  	//CONSTRUCTEUR
    public function __construct() {
        $this->statut = "offline";
    }

  	//GET
  
    public function getId(): ?int{
        return $this->id;
    }

    public function getUsername(): ?string {
        return $this->email;
    }


    public function getPassword(): ?string {
        return $this->password;
    }

    public function getRoles() {
        if (empty($this->roles)) {
            return ['ROLE_USER'];
        }
        return $this->roles;
    }
  
    public function getPseudo(): ?string {
     	return $this->pseudo;
   }
  
    
    public function getNom(): ?string {
     	return $this->nom;
   }
  
    public function getEmail(): ?string {
     	return $this->email;
   }
  
    public function getDepartement(): ?string {
     	return $this->departement;
   }
  
    public function getStatut(): ?string {
     	return $this->statut;
   }
  
   function getPlainPassword(){
        return $this->plainPassword;
    }
  
  
  //OTHERS METHODS

    public function addRole($role) {
        $this->roles[] = $role;
    }

    public function eraseCredentials() {
       
    }

    /** @see \Serializable::serialize() */
    public function serialize() {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
            $this->statut,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized) {
        list (
                $this->id,
                $this->email,
                $this->password,
                $this->statut,
                ) = unserialize($serialized);
    }

   


    //SET

    public function getSalt() {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function setId(int $id): self {
        $this->id = $id;
    }
  
	public function setPseudo(string $lepseudo) : self{
        $this->pseudo = $lepseudo;
    }
  
   public function setPassword(string $lepassword) : self{
        $this->password = $lepassword;
    }
  
    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function setPlainPassword(string $plainPassword): self {
        $this->plainPassword = $plainPassword;
    }

    public function setStatut(string $lestatut) : self{
        $this->statut = $lestatut;
    }
    
    public function setNom(string $lenom) : self{
        $this->nom = $lenom;
    }
  
   public function setDepartement(string $ledepartement) : self{
        $this->departement = $ledepartement;
    }

}


