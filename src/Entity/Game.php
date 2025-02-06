<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Team::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $teamA = null; // Première équipe

    #[ORM\ManyToOne(targetEntity: Team::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $teamB = null; // Deuxième équipe

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $scoreA = null; // Score de l'équipe A

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $scoreB = null; // Score de l'équipe B

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $gameDate = null; // Date et heure du match

    #[ORM\ManyToOne(targetEntity: Tournament::class, inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tournament $tournament = null; // Le tournoi auquel appartient le match

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeamA(): ?Team
    {
        return $this->teamA;
    }

    public function setTeamA(?Team $teamA): static
    {
        $this->teamA = $teamA;
        return $this;
    }

    public function getTeamB(): ?Team
    {
        return $this->teamB;
    }

    public function setTeamB(?Team $teamB): static
    {
        $this->teamB = $teamB;
        return $this;
    }

    public function getScoreA(): ?int
    {
        return $this->scoreA;
    }

    public function setScoreA(?int $scoreA): static
    {
        $this->scoreA = $scoreA;
        return $this;
    }

    public function getScoreB(): ?int
    {
        return $this->scoreB;
    }

    public function setScoreB(?int $scoreB): static
    {
        $this->scoreB = $scoreB;
        return $this;
    }

    public function getGameDate(): ?\DateTimeInterface
    {
        return $this->gameDate;
    }

    public function setGameDate(\DateTimeInterface $gameDate): static
    {
        $this->gameDate = $gameDate;
        return $this;
    }

    public function getTournament(): ?Tournament
    {
        return $this->tournament;
    }

    public function setTournament(?Tournament $tournament): static
    {
        $this->tournament = $tournament;
        return $this;
    }
}
