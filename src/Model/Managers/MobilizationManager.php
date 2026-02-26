<?php

namespace App\Model\Managers;

use App\Core\Abstract\Manager;
use App\Model\Entities\Mobilization;

class MobilizationManager extends Manager
{
  protected string $table = 'mobilizations';
  protected string $entityClass = Mobilization::class;
  protected array $tableColumns = [
    'id',
    'title',
    'slug',
    'description',
    'image_url'
  ];
}
