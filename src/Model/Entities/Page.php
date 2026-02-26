<?php

namespace App\Model\Entities;

use App\Core\Abstract\Entity;

class Page extends Entity
{
  private ?string $title = null;
  private ?string $content = null;
  private ?string $imageUrl = null;

  public function getTitle(): ?string { return $this->title; }
  public function setTitle(?string $title): self { $this->title = $title; return $this; }

  public function getContent(): ?string { return $this->content; }
  public function setContent(?string $content): self { $this->content = $content; return $this; }

  public function getImageUrl(): ?string { return $this->imageUrl; }
  public function setImageUrl(?string $imageUrl): self { $this->imageUrl = $imageUrl; return $this; }
}
