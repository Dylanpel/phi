<?php

namespace App\Model\Managers;

use App\Core\Abstract\Manager;
use App\Model\Entities\Page;

class PageManager extends Manager
{
  protected string $table = 'pages';
  protected string $entityClass = Page::class;
  protected array $tableColumns = [
    'id',
    'title',
    'content',
    'image_url'
  ];
}
