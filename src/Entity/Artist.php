<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtistRepository::class)]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    /**
     * @var Collection<int, ArtisType>
     */
    #[ORM\OneToMany(targetEntity: ArtisType::class, mappedBy: 'artist')]
    private Collection $artisTypes;

    public function __construct()
    {
        $this->artisTypes = new ArrayCollection();
    }

 

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return Collection<int, ArtisType>
     */
    public function getArtisTypes(): Collection
    {
        return $this->artisTypes;
    }

    public function addArtisType(ArtisType $artisType): static
    {
        if (!$this->artisTypes->contains($artisType)) {
            $this->artisTypes->add($artisType);
            $artisType->setArtist($this);
        }

        return $this;
    }

    public function removeArtisType(ArtisType $artisType): static
    {
        if ($this->artisTypes->removeElement($artisType)) {
            // set the owning side to null (unless already changed)
            if ($artisType->getArtist() === $this) {
                $artisType->setArtist(null);
            }
        }

        return $this;
    }
}