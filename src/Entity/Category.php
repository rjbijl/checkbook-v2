<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Mutation
 *
 * @ORM\Entity
 * @ORM\Table(name="category")
 *
 * @package App\Entity
 */
class Category
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var Category
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent = null;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\Category", mappedBy="parent")
     */
    private $children;

    /**
     * @var string
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\Mutation", mappedBy="category")
     */
    private $mutations;

    /**
     * Category constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->mutations = new ArrayCollection();
        $this->children = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Category
     */
    public function setName(string $name): Category
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Category
     */
    public function getParent(): Category
    {
        return $this->parent;
    }

    /**
     * @param Category $parent
     */
    public function setParent(Category $parent)
    {
        if ($this->parent !== $parent) {
            $this->parent = $parent;
            $parent->addChild($this);
        }

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getMutations(): ArrayCollection
    {
        return $this->mutations;
    }

    /**
     * @param ArrayCollection $mutations
     * @return Category
     */
    public function setMutations(ArrayCollection $mutations): Category
    {
        $this->mutations = $mutations;
        return $this;
    }

    /**
     * @param Mutation $mutation
     * @return Category
     */
    public function addMutation(Mutation $mutation): Category
    {
        if (!$this->mutations->contains($mutation)) {
            $this->mutations->add($mutation);
            $mutation->setCategory($this);
        }

        return $this;
    }
    /**
     * @return ArrayCollection
     */
    public function getChildren(): ArrayCollection
    {
        return $this->children;
    }

    /**
     * @param ArrayCollection $children
     * @return Category
     */
    public function setChildren(ArrayCollection $children): Category
    {
        $this->children = $children;
        return $this;
    }

    /**
     * @param Category $child
     * @return Category
     */
    public function addChild(Category $child): Category
    {
        if (!$this->children->contains($child)) {
            $this->children->add($child);
            $child->setParent($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
