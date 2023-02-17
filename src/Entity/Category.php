<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=Counterparty::class, mappedBy="category", orphanRemoval=true)
     */
    private $counterparties;

    public function __construct()
    {
        $this->counterparties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?int
    {
        return $this->name;
    }

    public function setName(int $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Counterparty>
     */
    public function getCounterparties(): Collection
    {
        return $this->counterparties;
    }

    public function addCounterparty(Counterparty $counterparty): self
    {
        if (!$this->counterparties->contains($counterparty)) {
            $this->counterparties[] = $counterparty;
            $counterparty->setCategory($this);
        }

        return $this;
    }

    public function removeCounterparty(Counterparty $counterparty): self
    {
        if ($this->counterparties->removeElement($counterparty)) {
            // set the owning side to null (unless already changed)
            if ($counterparty->getCategory() === $this) {
                $counterparty->setCategory(null);
            }
        }

        return $this;
    }
}
