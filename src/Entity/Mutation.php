<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Mutation
 *
 * @ORM\Entity(repositoryClass="App\Repository\MutationRepository")
 * @ORM\Table(name="mutation", uniqueConstraints={@ORM\UniqueConstraint(name="identifier_idx", columns={"account_number", "identifier"})}))
 *
 * @package App\Entity
 */
class Mutation
{
    const TYPE_DEBIT = 'debit';
    const TYPE_CREDIT = 'credit';

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
     * @var Category
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="mutations")
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="SET NULL")
     */
    private $category;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @param \DateTimeInterface $date
     * @return Mutation
     */
    public function setDate(\DateTimeInterface $date): Mutation
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }

    /**
     * @param string $accountNumber
     * @return Mutation
     */
    public function setAccountNumber(string $accountNumber): Mutation
    {
        $this->accountNumber = $accountNumber;
        return $this;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     * @return Mutation
     */
    public function setAmount(int $amount): Mutation
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Mutation
     */
    public function setType(string $type): Mutation
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Mutation
     */
    public function setDescription(string $description): Mutation
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getContraAccountName(): string
    {
        return $this->contraAccountName;
    }

    /**
     * @param string $contraAccountName
     * @return Mutation
     */
    public function setContraAccountName(string $contraAccountName): Mutation
    {
        $this->contraAccountName = $contraAccountName;
        return $this;
    }

    /**
     * @return string
     */
    public function getContraAccountNumber(): string
    {
        return $this->contraAccountNumber;
    }

    /**
     * @param string $contraAccountNumber
     * @return Mutation
     */
    public function setContraAccountNumber(string $contraAccountNumber): Mutation
    {
        $this->contraAccountNumber = $contraAccountNumber;
        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     * @return Mutation
     */
    public function setCategory(Category $category): Mutation
    {
        if ($this->category !== $category) {
            $this->category = $category;
            $category->addMutation($this);
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @param string $identifier
     * @return Mutation
     */
    public function setIdentifier(string $identifier): Mutation
    {
        $this->identifier = $identifier;
        return $this;
    }
}
