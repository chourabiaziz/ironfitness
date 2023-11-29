<?php

namespace App\Entity;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass:UtilisateurRepository::class)]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]

class Utilisateur implements UserInterface , PasswordAuthenticatedUserInterface
{
   public function supportsClass($class)
{
    return $class === 'App\Entity\Utilisateur' || is_subclass_of($class, 'App\Entity\Utilisateur');
}
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column] ///////////////////////////
    #[Assert\Length(
        min: 3,
        max: 50,
        minMessage: 'le Username doit contenir au min{{ 3 }} caractère ',
        maxMessage: 'le Username doit contenir au max{{ 150 }} caractère',
        )]
    private ?String $username = null;

    #[ORM\Column(length:50) ]
    #[Assert\NotBlank(message:'Le champ E-mail ne peut pas être vide.')]
    private ?String $mail= null;
  
    
    #[ORM\Column(length:30) ]
    #[Assert\Length(
        min : 8,
        minMessage : 'Le mot de passe doit contenir au moins {{ 8 }} caractères',
        max : 255,
        maxMessage : 'Le mot de passe ne peut pas dépasser {{ 255 }} caractères'
        )]
        #[Assert\Regex(
             pattern : "/^(?=.*[a-z])(?=.*[A-Z])/",
             message : "Le mot de passe doit contenir à la fois des lettres minuscules et des lettres majuscules"
         )]
    private ?String $mdp;

    #[ORM\Column(length:20) ]
    private ?String $role;

    #[ORM\Column(length:100) ]
    private ?String $image;

    #[ORM\Column]
    #[Assert\Positive(message:'L âge doit être une valeur positive.')]
    private ?int $age;

    #[ORM\Column(length:10) ]
    private ?String  $sexe;


 

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }



    
    public function setMdp(string $mdp): static
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): static
    {
        $this->sexe = $sexe;

        return $this;
    }

   

   
    public function getRoles(): array
    {
        return [$this->role];
    }

    public function getPassword(): string
    {
        return $this->mdp;
    }

    public function getSalt(): ?string
    {
        // you can leave this method blank unless you use advanced security features
        return null;
    }
    public function getUserIdentifier(): string
    {
        return (string) $this->mail;
    }

    public function eraseCredentials()
    {
        // If you store any tsemporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

   

    

}
