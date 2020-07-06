<?php

namespace App\Entity;

use App\Repository\AllsessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AllsessionRepository::class)
 */
class Allsession
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $mois;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $annee;

    /**
     * @ORM\OneToMany(targetEntity=Evalluation::class, mappedBy="session")
     */
    private $evalluations;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $teams = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $concerner;

    public function __construct()
    {
        $this->evalluations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMois(): ?string
    {
        return $this->mois;
    }

    public function setMois(string $mois): self
    {
        $this->mois = $mois;

        return $this;
    }

    public function getAnnee(): ?string
    {
        return $this->annee;
    }

    public function setAnnee(string $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * @return Collection|Evalluation[]
     */
    public function getEvalluations(): Collection
    {
        return $this->evalluations;
    }

    public function addEvalluation(Evalluation $evalluation): self
    {
        if (!$this->evalluations->contains($evalluation)) {
            $this->evalluations[] = $evalluation;
            $evalluation->setSession($this);
        }

        return $this;
    }

    public function removeEvalluation(Evalluation $evalluation): self
    {
        if ($this->evalluations->contains($evalluation)) {
            $this->evalluations->removeElement($evalluation);
            // set the owning side to null (unless already changed)
            if ($evalluation->getSession() === $this) {
                $evalluation->setSession(null);
            }
        }

        return $this;
    }

    public function getTeams(): ?array
    {
        return $this->teams;
    }

    public function setTeams(?array $teams): self
    {
        $this->teams = $teams;

        return $this;
    }

    public function getConcerner(): ?string
    {
        return $this->concerner;
    }

    public function setConcerner(string $concerner): self
    {
        $this->concerner = $concerner;

        return $this;
    }
}
