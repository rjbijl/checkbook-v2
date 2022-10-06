<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Mutation
 *
 * @ORM\Entity
 * @ORM\Table(name="category")
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private ?Category $parent = null;

    /**
     * @var Collection<Category>
     * @ORM\OneToMany(targetEntity="App\Entity\Category", mappedBy="parent")
     */
    private Collection $children;

    /**
     * @ORM\Column(name="name", type="string")
     */
    private string $name;

    /**
     * @var Collection<Mutation>
     * @ORM\OneToMany(targetEntity="App\Entity\Mutation", mappedBy="category")
     */
    private Collection $mutations;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->mutations = new ArrayCollection();
        $this->children = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(self $parent): self
    {
        if ($this->parent !== $parent) {
            $this->parent = $parent;
            $parent->addChild($this);
        }

        return $this;
    }

    /**
     * @return Collection<Mutation>
     */
    public function getMutations(): Collection
    {
        return $this->mutations;
    }

    public function setMutations(Collection $mutations): self
    {
        $this->mutations = $mutations;
        return $this;
    }

    public function addMutation(Mutation $mutation): self
    {
        if (!$this->mutations->contains($mutation)) {
            $this->mutations->add($mutation);
            $mutation->setCategory($this);
        }

        return $this;
    }

    /**
     * @return Collection<Category>
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function setChildren(Collection $children): self
    {
        $this->children = $children;
        return $this;
    }

    public function addChild(self $child): self
    {
        if (!$this->children->contains($child)) {
            $this->children->add($child);
            $child->setParent($this);
        }

        return $this;
    }
}
