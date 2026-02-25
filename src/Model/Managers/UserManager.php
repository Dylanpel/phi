<?php

namespace App\Model\Managers;

use App\Core\Abstract\Manager;
use App\Model\Entities\User;

class UserManager extends Manager
{
  protected string $table = 'users';
  protected string $entityClass = User::class;
  protected array $tableColumns = [
    'id',
    'login',
    'email',
    'role'
  ];
}
