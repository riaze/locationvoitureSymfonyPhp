<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VechiclesRepository")
 * 
 */
class Vechicles
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
    private $vechicleTitle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $VechilcleOverview;

    /**
     * @ORM\Column(type="integer")
     */
    private $PrricePerDay;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $FuelType;

    /**
     * @ORM\Column(type="date")
     */
    private $ModelYear;

    /**
     * @ORM\Column(type="integer")
     */
    private $SeatingCapacity;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $Vimage1;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $Vimage2;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $Vimage;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $AirConditioner;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $PowerDoorLocks;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $AntiLockBraking;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $BreakAssist;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $PowerSteering;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $DriverAirBag;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $regDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $UpdationDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Brands",inversedBy="Vechicles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $brands;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Membres", mappedBy="vechicles")
     */
    private $membres;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Booking", mappedBy="vechicles", cascade={"persist", "remove"})
     */
    private $booking;

    

    public function __construct()
    {
        $this->membres = new ArrayCollection();
       
    }

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVechicleTitle(): ?string
    {
        return $this->vechicleTitle;
    }

    public function setVechicleTitle(string $vechicleTitle): self
    {
        $this->vechicleTitle = $vechicleTitle;

        return $this;
    }

    

    public function getVechilcleOverview(): ?string
    {
        return $this->VechilcleOverview;
    }

    public function setVechilcleOverview(string $VechilcleOverview): self
    {
        $this->VechilcleOverview = $VechilcleOverview;

        return $this;
    }

    public function getPrricePerDay(): ?int
    {
        return $this->PrricePerDay;
    }

    public function setPrricePerDay(int $PrricePerDay): self
    {
        $this->PrricePerDay = $PrricePerDay;

        return $this;
    }

    public function getFuelType(): ?string
    {
        return $this->FuelType;
    }

    public function setFuelType(string $FuelType): self
    {
        $this->FuelType = $FuelType;

        return $this;
    }

    public function getModelYear(): ?\DateTimeInterface
    {
        return $this->ModelYear;
    }

    public function setModelYear(\DateTimeInterface $ModelYear): self
    {
        $this->ModelYear = $ModelYear;

        return $this;
    }

    public function getSeatingCapacity(): ?int
    {
        return $this->SeatingCapacity;
    }

    public function setSeatingCapacity(int $SeatingCapacity): self
    {
        $this->SeatingCapacity = $SeatingCapacity;

        return $this;
    }

    public function getVimage1(): ?string
    {
        return $this->Vimage1;
    }

    public function setVimage1(?string $Vimage1): self
    {
        $this->Vimage1 = $Vimage1;

        return $this;
    }

    public function getVimage2(): ?string
    {
        return $this->Vimage2;
    }

    public function setVimage2(?string $Vimage2): self
    {
        $this->Vimage2 = $Vimage2;

        return $this;
    }

    public function getVimage(): ?string
    {
        return $this->Vimage;
    }

    public function setVimage(?string $Vimage): self
    {
        $this->Vimage = $Vimage;

        return $this;
    }

    public function getAirConditioner(): ?bool
    {
        return $this->AirConditioner;
    }

    public function setAirConditioner(?bool $AirConditioner): self
    {
        $this->AirConditioner = $AirConditioner;

        return $this;
    }

    public function getPowerDoorLocks(): ?bool
    {
        return $this->PowerDoorLocks;
    }

    public function setPowerDoorLocks(?bool $PowerDoorLocks): self
    {
        $this->PowerDoorLocks = $PowerDoorLocks;

        return $this;
    }

    public function getAntiLockBraking(): ?bool
    {
        return $this->AntiLockBraking;
    }

    public function setAntiLockBraking(?bool $AntiLockBraking): self
    {
        $this->AntiLockBraking = $AntiLockBraking;

        return $this;
    }

    public function getBreakAssist(): ?bool
    {
        return $this->BreakAssist;
    }

    public function setBreakAssist(?bool $BreakAssist): self
    {
        $this->BreakAssist = $BreakAssist;

        return $this;
    }

    public function getPowerSteering(): ?bool
    {
        return $this->PowerSteering;
    }

    public function setPowerSteering(?bool $PowerSteering): self
    {
        $this->PowerSteering = $PowerSteering;

        return $this;
    }

    public function getDriverAirBag(): ?bool
    {
        return $this->DriverAirBag;
    }

    public function setDriverAirBag(?bool $DriverAirBag): self
    {
        $this->DriverAirBag = $DriverAirBag;

        return $this;
    }

    public function getRegDate(): ?\DateTimeInterface
    {
        return $this->regDate;
    }

    public function setRegDate(?\DateTimeInterface $regDate): self
    {
        $this->regDate = $regDate;

        return $this;
    }

    public function getUpdationDate(): ?\DateTimeInterface
    {
        return $this->UpdationDate;
    }

    public function setUpdationDate(?\DateTimeInterface $UpdationDate): self
    {
        $this->UpdationDate = $UpdationDate;

        return $this;
    }

    public function getBrands(): ?Brands
    {
        return $this->brands;
    }

    public function setBrands(?Brands $brands): self
    {
        $this->brands = $brands;

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
            $membre->addVechicle($this);
        }

        return $this;
    }

    public function removeMembre(Membres $membre): self
    {
        if ($this->membres->contains($membre)) {
            $this->membres->removeElement($membre);
            $membre->removeVechicle($this);
        }

        return $this;
    }

    public function getBooking(): ?Booking
    {
        return $this->booking;
    }

    public function setBooking(Booking $booking): self
    {
        $this->booking = $booking;

        // set the owning side of the relation if necessary
        if ($this !== $booking->getVechicles()) {
            $booking->setVechicles($this);
        }

        return $this;
    }

    

   
    
}
