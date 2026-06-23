<?php

namespace App\Entity;

use App\Repository\ArtisTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtisTypeRepository::class)]
class ArtisType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'artisTypes')]
    private ?Artist $artist = null;

    #[ORM\ManyToOne(inversedBy: 'artisTypes')]
    private ?Type $type = null;

    /**
     * @var Collection<int, ArtisTypeShow>
     */
    #[ORM\OneToMany(targetEntity: ArtisTypeShow::class, mappedBy: 'artistType')]
    private Collection $artisTypeShows;

    public function __construct()
    {
        $this->artisTypeShows = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtist(): ?Artist
    {
        return $this->artist;
    }

    public function setArtist(?Artist $artist): static
    {
        $this->artist = $artist;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, ArtisTypeShow>
     */
    public function getArtisTypeShows(): Collection
    {
        return $this->artisTypeShows;
    }

    public function addArtisTypeShow(ArtisTypeShow $artisTypeShow): static
    {
        if (!$this->artisTypeShows->contains($artisTypeShow)) {
            $this->artisTypeShows->add($artisTypeShow);
            $artisTypeShow->setArtistType($this);
        }

        return $this;
    }

    public function removeArtisTypeShow(ArtisTypeShow $artisTypeShow): static
    {
        if ($this->artisTypeShows->removeElement($artisTypeShow)) {
            // set the owning side to null (unless already changed)
            if ($artisTypeShow->getArtistType() === $this) {
                $artisTypeShow->setArtistType(null);
            }
        }

        return $this;
    }
}
