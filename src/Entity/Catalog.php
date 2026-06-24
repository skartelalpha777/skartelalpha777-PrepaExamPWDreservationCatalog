<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\CatalogRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table('catalogs')]
#[ORM\Entity(repositoryClass: CatalogRepository::class)]
class Catalog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 120, unique: true)]
    private ?string $title = null;

    #[ORM\Column]
    private ?int $year = null;


    #[ORM\Column]
    private ?\DateTime $validityDate = null;

    /**
     * @var Collection<int, Show>
     * ici on définit la relation ManyToMany entre Catalog et Show, en utilisant une table de jointure appelée 'catalogs_shows'.
     * La relation est bidirectionnelle, ce qui signifie que chaque Catalog peut avoir plusieurs Shows et chaque Show peut appartenir à plusieurs Catalogs.
     * La propriété 'inversedBy' indique que la relation est inversée par la propriété 'catalogs' dans l'entité Show.
     * La cascade 'persist' signifie que lorsque vous persistez un Catalog, les Shows associés seront également persistés.
     * Les colonnes de jointure sont définies avec des contraintes de suppression 'RESTRICT', ce qui signifie que vous ne pouvez pas supprimer un Catalog ou un Show si des relations existent entre eux.
     */
    #[ORM\ManyToMany(targetEntity: Show::class, inversedBy: 'catalogs', cascade: ['persist'])]
    #[ORM\JoinTable(name: 'catalog_show')]
    #[ORM\JoinColumn(name: 'catalog_id', referencedColumnName: 'id', onDelete: 'RESTRICT')]
    #[ORM\InverseJoinColumn(name: 'show_id', referencedColumnName: 'id', onDelete: 'RESTRICT')]
    private Collection $shows;

    public function __construct()
    {
        $this->shows = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getValidityDate(): ?\DateTime
    {
        return $this->validityDate;
    }

    public function setValidityDate(\DateTime $validityDate): static
    {
        $this->validityDate = $validityDate;

        return $this;
    }

    /**
     * @return Collection<int, Show>
     */
    public function getShows(): Collection
    {
        return $this->shows;
    }

    public function addShow(Show $show): static
    {
        if (!$this->shows->contains($show)) {
            $this->shows->add($show);
        }

        return $this;
    }

    public function removeShow(Show $show): static
    {
        $this->shows->removeElement($show);

        return $this;
    }
}
