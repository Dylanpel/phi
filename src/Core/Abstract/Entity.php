<?php

namespace App\Core\Abstract;

use App\Core\Interfaces\EntityInterface;
use App\Core\Traits\Hydratable;

// Classe de base pour les entités
abstract class Entity implements EntityInterface
{
  //récupération du constructeur et de la méthode d'hydratation
  use Hydratable;

  //chaque entité à toujours un id
  protected int $id;
  
  public function getId(): int { return $this->id; }
  public function setId(int $id): self { $this->id = $id; return $this; }
}
