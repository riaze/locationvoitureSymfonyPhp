<?php

namespace App\Entity;

use App\Entity\Membres;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BrandsRepository")
 */
class Brands
{   
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */ 
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $BrandName;

    /**
     * @ORM\Column(type="date")
     */
    private $CreatedDate;

    /**
     * @ORM\Column(type="date")
     */
    private $UpdatedDate;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Membres", mappedBy="Brands")
     */
    private $membres;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vechicles", mappedBy="brands")
     */
    private $Vechicles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="brand", orphanRemoval=true)
     */
    private $bookings;


    public function __construct()
    {
        $this->membres = new ArrayCollection();
        $this->Vechicles = new ArrayCollection();
        $this->bookings = new ArrayCollection();   
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrandName(): ?string
    {
        return $this->BrandName;
    }

    public function setBrandName(string $BrandName): self
    {
        $this->BrandName = $BrandName;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->CreatedDate;
    }

    public function setCreatedDate(\DateTimeInterface $CreatedDate): self
    {
        $this->CreatedDate = $CreatedDate;

        return $this;
    }

    public function getUpdatedDate(): ?\DateTimeInterface
    {
        return $this->UpdatedDate;
    }

    public function setUpdatedDate(\DateTimeInterface $UpdatedDate): self
    {
        $this->UpdatedDate = $UpdatedDate;

        return $this;
    }

    /**
     * @return Collection|Membres[]
     */
    public function getMembres(): Collection
    {
        return $this->membres;
    }

    public function addMembre(Membres $membre): self
    {
        if (!$this->membres->contains($membre)) {
            $this->membres[] = $membre;
            $membre->addBrand($this);
        }

        return $this;
    }

    public function removeMembre(Membres $membre): self
    {
        if ($this->membres->contains($membre)) {
            $this->membres->removeElement($membre);
            $membre->removeBrand($this);
        }

        return $this;
    }

    /**
     * @return Collection|Vechicles[]
     */
    public function getVechicles(): Collection
    {
        return $this->Vechicles;
    }

    public function addVechicle(Vechicles $vechicle): self
    {
        if (!$this->Vechicles->contains($vechicle)) {
            $this->Vechicles[] = $vechicle;
            $vechicle->setBrands($this);
        }

        return $this;
    }

    public function removeVechicle(Vechicles $vechicle): self
    {
        if ($this->Vechicles->contains($vechicle)) {
            $this->Vechicles->removeElement($vechicle);
            // set the owning side to null (unless already changed)
            if ($vechicle->getBrands() === $this) {
                $vechicle->setBrands(null);
            }
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
            $booking->setBrand($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->contains($booking)) {
            $this->bookings->removeElement($booking);
            // set the owning side to null (unless already changed)
            if ($booking->getBrand() === $this) {
                $booking->setBrand(null);
            }
        }

        return $this;
    }

    

   

   
}
