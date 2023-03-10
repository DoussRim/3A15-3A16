<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $nsc = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\ManyToOne(inversedBy: 'students')]
    private ?Classeroom $classroom = null;

    public function getNSC(): ?int
    {
        return $this->nsc;
    }
    public function setNSC(int $nsc): self
    {
        $this->nsc = $nsc;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getClassroom(): ?Classeroom
    {
        return $this->classroom;
    }

    public function setClassroom(?Classeroom $classroom): self
    {
        $this->classroom = $classroom;

        return $this;
    }
}
