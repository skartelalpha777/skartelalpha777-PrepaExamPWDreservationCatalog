<?php

namespace App\Entity;

use App\Repository\RepresentationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RepresentationRepository::class)]
class Representation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $schedule = null;

    #[ORM\ManyToOne(inversedBy: 'representations')]
    private ?Show $representationShow = null;

 
    #[ORM\ManyToOne(inversedBy: 'representations')]
    private ?Location $location = null;

    /**
     * @var Collection<int, RepresentationReservation>
     */
    #[ORM\OneToMany(targetEntity: RepresentationReservation::class, mappedBy: 'representation')]
    private Collection $representationReservations;

    public function __construct()
    {
        $this->representationReservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSchedule(): ?\DateTime
    {
        return $this->schedule;
    }

    public function setSchedule(\DateTime $schedule): static
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function getRepresentationShow(): ?Show
    {
        return $this->representationShow;
    }

    public function setRepresentationShow(?Show $representationShow): static
    {
        $this->representationShow = $representationShow;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): static
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return Collection<int, RepresentationReservation>
     */
    public function getRepresentationReservations(): Collection
    {
        return $this->representationReservations;
    }

    public function addRepresentationReservation(RepresentationReservation $representationReservation): static
    {
        if (!$this->representationReservations->contains($representationReservation)) {
            $this->representationReservations->add($representationReservation);
            $representationReservation->setRepresentation($this);
        }

        return $this;
    }

    public function removeRepresentationReservation(RepresentationReservation $representationReservation): static
    {
        if ($this->representationReservations->removeElement($representationReservation)) {
            // set the owning side to null (unless already changed)
            if ($representationReservation->getRepresentation() === $this) {
                $representationReservation->setRepresentation(null);
            }
        }

        return $this;
    }


}
