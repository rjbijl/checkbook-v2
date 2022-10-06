<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Mutation
 *
 * @ORM\Entity(repositoryClass="App\Repository\MutationRepository")
 * @ORM\Table(name="mutation", uniqueConstraints={@ORM\UniqueConstraint(name="identifier_idx", columns={"account_number", "identifier"})}))
 */
class Mutation
{
    public const TYPE_DEBIT = 'debit';
    public const TYPE_CREDIT = 'credit';

    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     * @ORM\Column(name="account_number", type="string")
     */
    private $accountNumber;

    /**
     * @var string
     * @ORM\Column(name="contra_account_name", type="string")
     */
    private $contraAccountName;

    /**
     * @var string
     * @ORM\Column(name="contra_account_number", type="string")
     */
    private $contraAccountNumber;

    /**
     * @var int
     * @ORM\Column(name="amount", type="integer")
     */
    private $amount;

    /**
     * @var string
     * @ORM\Column(name="type", type="string")
     */
    private $type;

    /**
     * @var string
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(name="identifier", type="string")
     */
    private $identifier;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="mutations")
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="SET NULL")
     */
    private ?Category $category = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }

    public function setAccountNumber(string $accountNumber): self
    {
        $this->accountNumber = $accountNumber;

        return $this;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getContraAccountName(): string
    {
        return $this->contraAccountName;
    }

    public function setContraAccountName(string $contraAccountName): self
    {
        $this->contraAccountName = $contraAccountName;

        return $this;
    }

    public function getContraAccountNumber(): string
    {
        return $this->contraAccountNumber;
    }

    public function setContraAccountNumber(string $contraAccountNumber): self
    {
        $this->contraAccountNumber = $contraAccountNumber;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): self
    {
        if ($this->category !== $category) {
            $this->category = $category;
            $category->addMutation($this);
        }

        return $this;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }
}
