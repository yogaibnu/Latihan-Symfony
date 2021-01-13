<?php

namespace App\Entity;

use App\Repository\TodoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TodoRepository::class)
 */
class Todo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_done;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $done_at;

    /**
     * @ORM\ManyToOne(targetEntity=Person::class, inversedBy="todos")
     */
    private $person;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIsDone(): ?bool
    {
        return $this->is_done;
    }

    public function setIsDone(bool $is_done): self
    {
        $this->is_done = $is_done;

        return $this;
    }

    public function getDoneAt(): ?\DateTimeInterface
    {
        return $this->done_at;
    }

    public function setDoneAt(\DateTimeInterface $done_at): self
    {
        $this->done_at = $done_at;

        return $this;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): self
    {
        $this->person = $person;

        return $this;
    }

}
