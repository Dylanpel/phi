<?php

namespace App\Model\Entities;

use App\Core\Abstract\Entity;

class Podcast extends Entity
{
  private ?string $title = null;
  private ?string $date = null;
  private ?string $path = null;
  private ?string $description = null;
  private ?string $author = null;

  public function getTitle(): ?string { return $this->title; }
  public function setTitle(?string $title): self { $this->title = $title; return $this; }

  public function getDate(): ?string { return $this->date; }
  public function setDate(?string $date): self { $this->date = $date; return $this; }

  public function getPath(): ?string { return $this->path; }
  public function setPath(?string $path): self { $this->path = $path; return $this; }

  public function getDescription(): ?string { return $this->description; }
  public function setDescription(?string $description): self { $this->description = $description; return $this; }

  public function getAuthor(): ?string { return $this->author; }
  public function setAuthor(?string $author): self { $this->author = $author; return $this; }
}
