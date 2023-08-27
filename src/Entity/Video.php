<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use App\Entity\Traits\Timestampable;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
#[ORM\Table(name: "videos")]
#[ORM\HasLifecycleCallbacks]
class Video
{
     use Timestampable;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotIdenticalTo(value: "merde")]
    #[Assert\NotBlank(message: "Veuillez entrer un titre")]
    #[Assert\Length(max: 20, maxMessage: "Vous devez avoir un titre de maximum 20 caractères")]
    private ?string $title = null;

    #[ORM\Column(length: 500)]
    private ?string $videoLink = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: "Veuillez entrer un titre")]
    #[Assert\Length(max: 25, maxMessage: "Vous devez avoir une description de maximum 25 caractères")]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'videos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column]
    private ?bool $premiumVideo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getVideoLink(): ?string
    {
        return $this->videoLink;
    }

    public function setVideoLink(string $videoLink): static
    {
        $this->videoLink = $videoLink;

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
    
 /**
 * Return only the security relevant data
 *
 * @return array
 */
public function __serialize(): array
{
    return [
        'id' => $this->id,
        'title' => $this->title,
        'description' => $this->description,
        'videoLink' => $this->videoLink,
    ];
}

public function getUser(): ?User
{
    return $this->user;
}

public function setUser(?User $user): static
{
    $this->user = $user;

    return $this;
}

public function isPremiumVideo(): ?bool
{
    return $this->premiumVideo;
}

public function setPremiumVideo(bool $premiumVideo): static
{
    $this->premiumVideo = $premiumVideo;

    return $this;
}


}
