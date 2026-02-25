<?php

namespace App\Model\Entities;

use App\Core\Abstract\Entity;

class Mobilization extends Entity
{
  private ?string $title = null;
  private ?string $description = null;
  private ?string $imageUrl = null;

  public function getTitle(): ?string { return $this->title; }
  public function setTitle(?string $title): self { $this->title = $title; return $this; }

  public function getDescription(): ?string { return $this->description; }
  public function setDescription(?string $description): self { $this->description = $description; return $this; }

  public function getImageUrl(): ?string { return $this->imageUrl; }
  public function setImageUrl(?string $imageUrl): self { $this->imageUrl = $imageUrl; return $this; }
}
