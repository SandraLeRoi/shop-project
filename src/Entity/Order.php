<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
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
    private $numero;

    /**
     * @ORM\Column(type="boolean")
     */
    private $state;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commande")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=LineOrder::class, mappedBy="numOrder", orphanRemoval=true)
     */
    private $orderLine;

    public function __construct()
    {
        $this->orderLine = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getState(): ?bool
    {
        return $this->state;
    }

    public function setState(bool $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|LineOrder[]
     */
    public function getOrderLine(): Collection
    {
        return $this->orderLine;
    }

    public function addOrderLine(LineOrder $orderLine): self
    {
        if (!$this->orderLine->contains($orderLine)) {
            $this->orderLine[] = $orderLine;
            $orderLine->setNumOrder($this);
        }

        return $this;
    }

    public function removeOrderLine(LineOrder $orderLine): self
    {
        if ($this->orderLine->removeElement($orderLine)) {
            // set the owning side to null (unless already changed)
            if ($orderLine->getNumOrder() === $this) {
                $orderLine->setNumOrder(null);
            }
        }

        return $this;
    }
}
