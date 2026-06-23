<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $type = null;

    /**
     * @var Collection<int, ArtisType>
     */
    #[ORM\OneToMany(targetEntity: ArtisType::class, mappedBy: 'type')]
    private Collection $artisTypes;

    public function __construct()
    {
        $this->artisTypes = new ArrayCollection();
    }

 


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

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
            $artisType->setType($this);
        }

        return $this;
    }

    public function removeArtisType(ArtisType $artisType): static
    {
        if ($this->artisTypes->removeElement($artisType)) {
            // set the owning side to null (unless already changed)
            if ($artisType->getType() === $this) {
                $artisType->setType(null);
            }
        }

        return $this;
    }


}
