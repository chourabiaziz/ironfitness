<?php

namespace App\Entity;
use App\Repository\CodepromoRepository;
use Symfony\Component\Validator\Constraints as Assert;


use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:CodepromoRepository::class)]
class Codepromo
{
  
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idCodepromo;

    
    #[Assert\Length(
        min: 3,
        max: 6,
        minMessage: 'le Username doit contenir au min{{ 3 }} caractère ',
        maxMessage: 'le Username doit contenir au max{{ 150 }} caractère',
        )]
    private ?String $code = null ;
    #[ORM\Column(length:20) ]
    #[Assert\NotBlank(message:'Le champ Description ne peut pas être vide.')]
    private ?String$description;
    #[ORM\Column(length:20) ]
    #[Assert\Date(message:'Le champ Date dexpiration ne peut pas être avec ce format .')]
    private ?String $datedexpiration;

    #[ORM\Column(length:20) ]
    private ?String $used = 'NULL';

    public function getIdCodepromo(): ?int
    {
        return $this->idCodepromo;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDatedexpiration(): ?string
    {
        return $this->datedexpiration;
    }

    public function setDatedexpiration(string $datedexpiration): static
    {
        $this->datedexpiration = $datedexpiration;

        return $this;
    }

    public function getUsed(): ?string
    {
        return $this->used;
    }

    public function setUsed(?string $used): static
    {
        $this->used = $used;

        return $this;
    }


}
