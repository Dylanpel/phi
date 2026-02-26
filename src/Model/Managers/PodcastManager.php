<?php

namespace App\Model\Managers;

use App\Core\Abstract\Manager;
use App\Model\Entities\Podcast;

class PodcastManager extends Manager
{
  protected string $table = 'podcasts';
  protected string $entityClass = Podcast::class;
  protected array $tableColumns = [
    'id',
    'title',
    'slug',
    'date',
    'path',
    'description',
    'author'
  ];
}
