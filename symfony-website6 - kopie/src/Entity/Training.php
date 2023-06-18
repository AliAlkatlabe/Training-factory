<?php

namespace App\Entity;

use App\Repository\TrainingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrainingRepository::class)]
class Training
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\OneToMany(mappedBy: 'training', targetEntity: Lessen::class)]
    private Collection $lessens;

    public function __construct()
    {
        $this->lessens = new ArrayCollection();
    }


    public function __toString() {
        return $this->name;
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

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return Collection<int, Lessen>
     */
    public function getLessens(): Collection
    {
        return $this->lessens;
    }

    public function addLessen(Lessen $lessen): self
    {
        if (!$this->lessens->contains($lessen)) {
            $this->lessens->add($lessen);
            $lessen->setTraining($this);
        }

        return $this;
    }

    public function removeLessen(Lessen $lessen): self
    {
        if ($this->lessens->removeElement($lessen)) {
            // set the owning side to null (unless already changed)
            if ($lessen->getTraining() === $this) {
                $lessen->setTraining(null);
            }
        }

        return $this;
    }

    

   

  
}
