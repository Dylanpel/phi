<?php

namespace App\Model\Entities;

use App\Core\Abstract\Entity;

class Article extends Entity
{
  private ?string $title = null;
  private ?string $slug = null;
  private ?string $date = null;
  private ?string $content = null;
  private ?string $imageUrl = null;
  private int $idUser;

  public function getTitle(): ?string { return $this->title; }
  public function setTitle(?string $title): self { $this->title = $title; return $this; }

  public function getSlug(): ?string { return $this->slug; }
  public function setSlug(?string $slug): self { $this->slug = $slug; return $this; }

  public function getDate(): ?string { return $this->date; }
  public function setDate(?string $date): self { $this->date = $date; return $this; }

  public function getContent(): ?string { return $this->content; }
  public function setContent(?string $content): self { $this->content = $content; return $this; }

  public function getImageUrl(): ?string { return $this->imageUrl; }
  public function setImageUrl(?string $imageUrl): self { $this->imageUrl = $imageUrl; return $this; }

  public function getIdUser(): int { return $this->idUser; }
  public function setIdUser(int $idUser): self { $this->idUser = $idUser; return $this; }
}
