<?php

namespace App\Entity;

use App\Entity\Brands;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;



/**
 * @ORM\Entity(repositoryClass="App\Repository\MembresRepository")
 * @UniqueEntity(fields={"Email"}, message="l'email que vous avez indiqué est déjà utilisé")
 */
class Membres implements UserInterface
{
    
     
   
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")*/

    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="string", length=50)
     *
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="5", minMessage="votre mot pass doit etre faire minimum 5")
     * @Assert\EqualTo(propertyPath="Confirme_Password")
     */
    private $Password;



    public $Confirme_Password;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Adresse;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Ville;

    /**
     * @ORM\Column(type="integer")
     */
    private $CodePostal;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Pays;

    /**
     * @ORM\Column(type="array")
     */
    private $Roles=[];

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Brands", inversedBy="membres")
     */
    private $Brands;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Vechicles", inversedBy="membres")
     */
    private $vechicles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="membres", orphanRemoval=true)
     */
    private $bookings;

   
    

    public function __construct()
    {  
        $this->vechicles = new ArrayCollection();
        $this->Brands = new ArrayCollection();
        $this->bookings = new ArrayCollection();
        
        
        
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->Ville;
    }

    public function setVille(string $Ville): self
    {
        $this->Ville = $Ville;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->CodePostal;
    }

    public function setCodePostal(int $CodePostal): self
    {
        $this->CodePostal = $CodePostal;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->Pays;
    }

    public function setPays(string $Pays): self
    {
        $this->Pays = $Pays;

        return $this;
    }



    public function getUsername(): ?string
    {


        return (string) $this->id;
    }

    public function getSalt(){

     }
    public function eraseCredentials(){

    }

    /**
     * @return array|null
     */
    public function getRoles(): ?array
    {
        $roles = $this->Roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
      
    }

    public function setRoles(array $Roles): self
    {
        $this->Roles = $Roles;

        return $this;
    }

    /**
     * @return Collection|Brands[]
     */
    public function getBrands(): Collection
    {
        return $this->Brands;
    }

    public function addBrand(Brands $brand): self
    {
        if (!$this->Brands->contains($brand)) {
            $this->Brands[] = $brand;
        }

        return $this;
    }

    public function removeBrand(Brands $brand): self
    {
        if ($this->Brands->contains($brand)) {
            $this->Brands->removeElement($brand);
        }

        return $this;
    }

    /**
     * @return Collection|Vechicles[]
     */
    public function getVechicles(): Collection
    {
        return $this->vechicles;
    }

    public function addVechicle(Vechicles $vechicle): self
    {
        if (!$this->vechicles->contains($vechicle)) {
            $this->vechicles[] = $vechicle;
        }

        return $this;
    }

    public function removeVechicle(Vechicles $vechicle): self
    {
        if ($this->vechicles->contains($vechicle)) {
            $this->vechicles->removeElement($vechicle);
        }

        return $this;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setMembres($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->contains($booking)) {
            $this->bookings->removeElement($booking);
            // set the owning side to null (unless already changed)
            if ($booking->getMembres() === $this) {
                $booking->setMembres(null);
            }
        }

        return $this;
    }

    
    

    

    

    
}
