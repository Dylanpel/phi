<?php

namespace App\Core\Traits;

trait Hydratable
{
  /**
   * Constructeur
   * @param array $data Données pour hydrater l'entité à l'instanciation
   */
  public function __construct(array $data = []) {
    if(!empty($data)) {
      $this->hydrate($data);
    }
  }
  
  /**
   * Hydratation de l'entité
   * @param array $data Tableau des données à hydrater dans l'entité
   * @return self Classe de l'entité
   */
  public function hydrate(array $data): self
  {
    foreach ($data as $key => $value) {
      $method = 'set' . str_replace('_', '', ucwords($key, '_'));
      if (method_exists($this, $method)) {
        $this->$method($value);
      }
    }
    return $this;
  }
}
