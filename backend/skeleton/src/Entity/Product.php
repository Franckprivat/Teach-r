<?php


namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'The product name cannot be blank.')]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'The description cannot be blank.')]
    private ?string $description = null;

    #[ORM\Column]
    #[Assert\Positive(message: 'The price must be a positive number.')]
    private ?float $price = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull(message: 'The category must not be null.')]
    private ?Category $category = null;

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

public function getDescription(): string
    {
        return $this->description;
    }
public function setDescription(string $description): self
{
    $this->description = $description;

    return $this;
}

public function getPrice(): float
    {
        return $this->price;
    }
public function setPrice(float $price): self
{
    $this->price = $price;

    return $this;
}

public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

public function setCreatedAt(\DateTimeImmutable $createdAt): self
{
    $this->createdAt = $createdAt;

    return $this;
    }

public function __construct()
    {
        if ($this->updatedAt === null) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

public function getCategory(): ?Category
    {
        return $this->category;
    }

public function setCategory(?Category $category): self
    {
        $this->category = $category;
        return $this;
    }
}
