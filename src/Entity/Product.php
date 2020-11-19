<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @ApiResource(
 *      collectionOperations={
 *     "get"={
 *          "normalization_context"={
 *              "groups"= {"order_details"}
 *          }}, "post"
 *     }, itemOperations={
 *     "get"={
 *          "normalization_context"={
 *              "groups"= {"order_details"}
 *          }
 *     }, "put"
 * })
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"order_details"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"order_details"})
     */
    private $reference;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"order_details"})
     */
    private $puht;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"order_details"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $stock;

    /**
     * @ORM\OneToMany(targetEntity=LineOrder::class, mappedBy="product", orphanRemoval=true)
     */
    private $lineOrder;

    public function __construct()
    {
        $this->lineOrder = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getPuht(): ?float
    {
        return $this->puht;
    }

    public function setPuht(?float $puht): self
    {
        $this->puht = $puht;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(?int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * @return Collection|LineOrder[]
     */
    public function getLineOrder(): Collection
    {
        return $this->lineOrder;
    }

    public function addLineOrder(LineOrder $lineOrder): self
    {
        if (!$this->lineOrder->contains($lineOrder)) {
            $this->lineOrder[] = $lineOrder;
            $lineOrder->setProduct($this);
        }

        return $this;
    }

    public function removeLineOrder(LineOrder $lineOrder): self
    {
        if ($this->lineOrder->removeElement($lineOrder)) {
            // set the owning side to null (unless already changed)
            if ($lineOrder->getProduct() === $this) {
                $lineOrder->setProduct(null);
            }
        }

        return $this;
    }
}
