<?php

namespace App\Entity;

use App\Repository\EnregistrementRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InheritanceType;

/**
 * @ORM\Entity(repositoryClass=EnregistrementRepository::class)
 * @InheritanceType("JOINED")
 */
class Enregistrement 
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $creePar;

    /**
     * @ORM\Column(type="date")
     */
    protected $creeLe;

    /**
     * @ORM\Column(type="string", length=255, nullable= true)
     */
    protected $modifiePar;

    /**
     * @ORM\Column(type="date", nullable= true)
     */
    protected $modifieLe;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $enable;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreePar(): ?string
    {
        return $this->creePar;
    }

    public function setCreePar(string $creePar): self
    {
        $this->creePar = $creePar;

        return $this;
    }

    public function getCreeLe(): ?\DateTimeInterface
    {
        return $this->creeLe;
    }

    public function setCreeLe(\DateTimeInterface $creeLe): self
    {
        $this->creeLe = $creeLe;

        return $this;
    }

    public function getModifiePar(): ?string
    {
        return $this->modifiePar;
    }

    public function setModifiePar(string $modifiePar): self
    {
        $this->modifiePar = $modifiePar;

        return $this;
    }

    public function getModifieLe(): ?\DateTimeInterface
    {
        return $this->modifieLe;
    }

    public function setModifieLe(\DateTimeInterface $modifieLe): self
    {
        $this->modifieLe = $modifieLe;

        return $this;
    }

    public function getEnable(): ?bool
    {
        return $this->enable;
    }

    public function setEnable(bool $enable): self
    {
        $this->enable = $enable;

        return $this;
    }
}
