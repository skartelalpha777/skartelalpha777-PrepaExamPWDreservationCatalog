<?php

namespace App\Entity;

use App\Repository\ArtisTypeShowRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtisTypeShowRepository::class)]
class ArtisTypeShow
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'artisTypeShows')]
    private ?ArtisType $artistType = null;

    #[ORM\ManyToOne(inversedBy: 'artisTypeShows')]
    private ?Show $theShow = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtistType(): ?ArtisType
    {
        return $this->artistType;
    }

    public function setArtistType(?ArtisType $artistType): static
    {
        $this->artistType = $artistType;

        return $this;
    }

    public function getTheShow(): ?Show
    {
        return $this->theShow;
    }

    public function setTheShow(?Show $theShow): static
    {
        $this->theShow = $theShow;

        return $this;
    }
}
