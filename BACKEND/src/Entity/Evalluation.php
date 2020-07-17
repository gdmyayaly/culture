<?php

namespace App\Entity;

use App\Repository\EvalluationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EvalluationRepository::class)
 */
class Evalluation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="evalluations")
     */
    private $evaluer;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="evalluations")
     */
    private $evaluateur;

    /**
     * @ORM\Column(type="integer")
     */
    private $perseverance;

    /**
     * @ORM\Column(type="integer")
     */
    private $confiance;

    /**
     * @ORM\Column(type="integer")
     */
    private $collaboration;

    /**
     * @ORM\Column(type="integer")
     */
    private $autonomie;

    /**
     * @ORM\Column(type="integer")
     */
    private $problemsolving;

    /**
     * @ORM\Column(type="integer")
     */
    private $transmission;

    /**
     * @ORM\Column(type="integer")
     */
    private $performance;

    /**
     * @ORM\ManyToOne(targetEntity=Allsession::class, inversedBy="evalluations")
     */
    private $session;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvaluer(): ?User
    {
        return $this->evaluer;
    }

    public function setEvaluer(?User $evaluer): self
    {
        $this->evaluer = $evaluer;

        return $this;
    }

    public function getEvaluateur(): ?User
    {
        return $this->evaluateur;
    }

    public function setEvaluateur(?User $evaluateur): self
    {
        $this->evaluateur = $evaluateur;

        return $this;
    }

    public function getPerseverance(): ?string
    {
        return $this->perseverance;
    }

    public function setPerseverance(string $perseverance): self
    {
        $this->perseverance = $perseverance;

        return $this;
    }

    public function getConfiance(): ?int
    {
        return $this->confiance;
    }

    public function setConfiance(int $confiance): self
    {
        $this->confiance = $confiance;

        return $this;
    }

    public function getCollaboration(): ?int
    {
        return $this->collaboration;
    }

    public function setCollaboration(int $collaboration): self
    {
        $this->collaboration = $collaboration;

        return $this;
    }

    public function getAutonomie(): ?int
    {
        return $this->autonomie;
    }

    public function setAutonomie(int $autonomie): self
    {
        $this->autonomie = $autonomie;

        return $this;
    }

    public function getProblemsolving(): ?int
    {
        return $this->problemsolving;
    }

    public function setProblemsolving(int $problemsolving): self
    {
        $this->problemsolving = $problemsolving;

        return $this;
    }

    public function getTransmission(): ?int
    {
        return $this->transmission;
    }

    public function setTransmission(int $transmission): self
    {
        $this->transmission = $transmission;

        return $this;
    }

    public function getPerformance(): ?int
    {
        return $this->performance;
    }

    public function setPerformance(int $performance): self
    {
        $this->performance = $performance;

        return $this;
    }

    public function getSession(): ?Allsession
    {
        return $this->session;
    }

    public function setSession(?Allsession $session): self
    {
        $this->session = $session;

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
}
