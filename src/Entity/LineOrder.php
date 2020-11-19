<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LineOrderRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LineOrderRepository::class)
 *  @ApiResource(
 *      collectionOperations={
 *     }, itemOperations={
 *     "get"
 *     }
 * )
 */
class LineOrder
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"order_details"})
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="orderLine")
     * @ORM\JoinColumn(nullable=false)
     */
    private $numOrder;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="lineOrder")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"order_details"})
     */
    private $product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getNumOrder(): ?Order
    {
        return $this->numOrder;
    }

    public function setNumOrder(?Order $numOrder): self
    {
        $this->numOrder = $numOrder;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
