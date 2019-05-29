<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 */
class Booking
{   
   

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     */
    private $id;
    

    /**
     * @ORM\Column(type="date")
     */
    private $FromDate;

    /**
     * @ORM\Column(type="date")
     */
    private $ToDate;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $Message;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $Status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Membres", inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $membres;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Vechicles", inversedBy="booking", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $vechicles;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Brands", inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $brand;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFromDate(): ?\DateTimeInterface
    {
        return $this->FromDate;
    }

    public function setFromDate(\DateTimeInterface $FromDate): self
    {
        $this->FromDate = $FromDate;

        return $this;
    }

    public function getToDate(): ?\DateTimeInterface
    {
        return $this->ToDate;
    }

    public function setToDate(\DateTimeInterface $ToDate): self
    {
        $this->ToDate = $ToDate;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->Message;
    }

    public function setMessage(?string $Message): self
    {
        $this->Message = $Message;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(string $Status): self
    {
        $this->Status = $Status;

        return $this;
    }

    public function getMembres(): ?Membres
    {
        return $this->membres;
    }

    public function setMembres(?Membres $membres): self
    {
        $this->membres = $membres;

        return $this;
    }

    public function getVechicles(): ?Vechicles
    {
        return $this->vechicles;
    }

    public function setVechicles(Vechicles $vechicles): self
    {
        $this->vechicles = $vechicles;

        return $this;
    }

    public function getBrand(): ?Brands
    {
        return $this->brand;
    }

    public function setBrand(?Brands $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    

    /*public function getBrands(): ?Brands
    {
        return $this->brands;
    }

    public function setBrands(?Brands $brands): self
    {
        $this->brands = $brands;

        return $this;
    }*/

    
}
