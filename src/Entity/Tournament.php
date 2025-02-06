<?php

namespace App\Entity;

use App\Repository\TournamentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Team;

#[ORM\Entity(repositoryClass: TournamentRepository::class)]
class Tournament
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $registrationStartDate = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $registrationEndDate = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column]
    private ?int $maxTeams = null;

    #[ORM\Column]
    private ?int $playersPerTeam = null;

    #[ORM\Column(length: 20)]
    private ?string $status = 'À venir'; // Valeurs possibles : "À venir", "En cours", "Terminé"

    #[ORM\OneToMany(mappedBy: "tournament", targetEntity: Team::class, orphanRemoval: true)]
    private Collection $teams;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
    }

    // Getters & Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getRegistrationStartDate(): ?\DateTimeInterface
    {
        return $this->registrationStartDate;
    }

    public function setRegistrationStartDate(\DateTimeInterface $date): static
    {
        $this->registrationStartDate = $date;
        return $this;
    }

    public function getRegistrationEndDate(): ?\DateTimeInterface
    {
        return $this->registrationEndDate;
    }

    public function setRegistrationEndDate(\DateTimeInterface $date): static
    {
        $this->registrationEndDate = $date;
        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $date): static
    {
        $this->startDate = $date;
        return $this;
    }

    public function getMaxTeams(): ?int
    {
        return $this->maxTeams;
    }

    public function setMaxTeams(int $maxTeams): static
    {
        $this->maxTeams = $maxTeams;
        return $this;
    }

    public function getPlayersPerTeam(): ?int
    {
        return $this->playersPerTeam;
    }

    public function setPlayersPerTeam(int $playersPerTeam): static
    {
        $this->playersPerTeam = $playersPerTeam;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return Collection<int, Team>
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): static
    {
        if (!$this->teams->contains($team)) {
            $this->teams->add($team);
            $team->setTournament($this);
        }
        return $this;
    }

    public function removeTeam(Team $team): static
    {
        if ($this->teams->removeElement($team)) {
            if ($team->getTournament() === $this) {
                $team->setTournament(null);
            }
        }
        return $this;
    }
}
