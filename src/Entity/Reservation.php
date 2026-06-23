<?php

namespace App\Entity;

use App\Enum\Status;
use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: false)]
    private ?\DateTime $booking_date = null;

    #[ORM\Column(enumType: Status::class, nullable: false)]
    private ?Status $status = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?User $user = null;

    /**
     * @var Collection<int, RepresentationReservation>
     */
    #[ORM\OneToMany(targetEntity: RepresentationReservation::class, mappedBy: 'reservation', cascade: ['remove', 'persist'], orphanRemoval: true)]
    private Collection $representationReservations;

    function __construct()
    {
        $this->booking_date = new \DateTime();
        $this->status = Status::Pending;
        $this->representationReservations = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBookingDate(): ?\DateTime
    {
        return $this->booking_date;
    }

    public function setBookingDate(\DateTime $booking_date): static
    {
        $this->booking_date = $booking_date;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(Status $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

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
            $representationReservation->setReservation($this);
        }

        return $this;
    }

    public function removeRepresentationReservation(RepresentationReservation $representationReservation): static
    {
        if ($this->representationReservations->removeElement($representationReservation)) {
            // set the owning side to null (unless already changed)
            if ($representationReservation->getReservation() === $this) {
                $representationReservation->setReservation(null);
            }
        }

        return $this;
    }
}
