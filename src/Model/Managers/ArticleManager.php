<?php

namespace App\Model\Managers;

use App\Core\Abstract\Manager;
use App\Model\Entities\Article;

class ArticleManager extends Manager
{
  protected string $table = 'articles';
  protected string $entityClass = Article::class;
  protected array $tableColumns = [
    'id',
    'title',
    'date',
    'content',
    'image_url',
    'id_user'
  ];
}
