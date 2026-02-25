<?php

namespace App\Core\Interfaces;

interface EntityInterface
{
  public function hydrate(array $data): self;
}
