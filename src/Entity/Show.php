<?php

namespace App\Entity;

use App\Repository\ShowRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ShowRepository::class)]
#[ORM\Table(name: '`show`')]
class Show
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'le titre ne peut pas etre vide')]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $poster_URL = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero(message: 'la duree ne peut pas etre négative')]
    private ?int $duration = null;

    #[ORM\Column]
    private ?\DateTime $created_in = null;

    #[ORM\Column]
    private ?bool $bookable = null;

    /**
     * @var Collection<int, Representation>
     */
    #[ORM\OneToMany(targetEntity: Representation::class, mappedBy: 'representationShow', cascade: ['remove', 'persist'])]
    private Collection $representations;

    #[ORM\ManyToOne(inversedBy: 'shows')]
    private ?Location $location = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, Review>
     */
    #[ORM\OneToMany(targetEntity: Review::class, mappedBy: 'showReview', cascade: ['remove', 'persist'])]
    private Collection $review;

    /**
     * @var Collection<int, Price>
     */
    #[ORM\ManyToMany(targetEntity: Price::class, mappedBy: 'shows', cascade: ['remove', 'persist'])]
    private Collection $prices;

    /**
     * @var Collection<int, ArtisTypeShow>
     */
    #[ORM\OneToMany(targetEntity: ArtisTypeShow::class, mappedBy: 'theShow')]
    private Collection $artisTypeShows;

    /**
     * @var Collection<int, Catalog>
     */
    #[ORM\ManyToMany(targetEntity: Catalog::class, mappedBy: 'shows')]
    private Collection $catalogs;

    public function __construct()
    {
        $this->representations = new ArrayCollection();
        $this->created_in = new \DateTime();
        $this->review = new ArrayCollection();
        $this->prices = new ArrayCollection();
        $this->artisTypeShows = new ArrayCollection();
        $this->catalogs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getPosterURL(): ?string
    {
        return $this->poster_URL;
    }

    public function setPosterURL(?string $poster_URL): static
    {
        $this->poster_URL = $poster_URL;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getCreatedIn(): ?\DateTime
    {
        return $this->created_in;
    }

    public function setCreatedIn(\DateTime $created_in): static
    {
        $this->created_in = $created_in;

        return $this;
    }

    public function isBookable(): ?bool
    {
        return $this->bookable;
    }

    public function setBookable(bool $bookable): static
    {
        $this->bookable = $bookable;

        return $this;
    }

    /**
     * @return Collection<int, Representation>
     */
    public function getRepresentations(): Collection
    {
        return $this->representations;
    }

    public function addRepresentation(Representation $representation): static
    {
        if (!$this->representations->contains($representation)) {
            $this->representations->add($representation);
            $representation->setRepresentationShow($this);
        }

        return $this;
    }

    public function removeRepresentation(Representation $representation): static
    {
        if ($this->representations->removeElement($representation)) {
            // set the owning side to null (unless already changed)
            if ($representation->getRepresentationShow() === $this) {
                $representation->setRepresentationShow(null);
            }
        }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getShowReview(): Collection
    {
        return $this->review;
    }

    public function addShowReview(Review $showReview): static
    {
        if (!$this->review->contains($showReview)) {
            $this->review->add($showReview);
            $showReview->setShowReview($this);
        }

        return $this;
    }

    public function removeShowReview(Review $showReview): static
    {
        if ($this->review->removeElement($showReview)) {
            // set the owning side to null (unless already changed)
            if ($showReview->getShowReview() === $this) {
                $showReview->setShowReview(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Price>
     */
    public function getPrices(): Collection
    {
        return $this->prices;
    }

    public function addPrice(Price $price): static
    {
        if (!$this->prices->contains($price)) {
            $this->prices->add($price);
            $price->addShow($this);
        }

        return $this;
    }

    public function removePrice(Price $price): static
    {
        if ($this->prices->removeElement($price)) {
            $price->removeShow($this);
        }

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
            $artisTypeShow->setTheShow($this);
        }

        return $this;
    }

    public function removeArtisTypeShow(ArtisTypeShow $artisTypeShow): static
    {
        if ($this->artisTypeShows->removeElement($artisTypeShow)) {
            // set the owning side to null (unless already changed)
            if ($artisTypeShow->getTheShow() === $this) {
                $artisTypeShow->setTheShow(null);
            }
        }

        return $this;
    }
    function __toString()
    {
        return $this->title;
    }

    /**
     * @return Collection<int, Catalog>
     */
    public function getCatalogs(): Collection
    {
        return $this->catalogs;
    }

    public function addCatalog(Catalog $catalog): static
    {
        if (!$this->catalogs->contains($catalog)) {
            $this->catalogs->add($catalog);
            $catalog->addShow($this);
        }

        return $this;
    }

    public function removeCatalog(Catalog $catalog): static
    {
        if ($this->catalogs->removeElement($catalog)) {
            $catalog->removeShow($this);
        }

        return $this;
    }
}
