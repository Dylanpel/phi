<?php

namespace App\Model\Entities;

use App\Core\Abstract\Entity;

class User extends Entity
{
  // Constantes pour les rôles
  public const ROLE_EDITOR = 'editor';
  public const ROLE_ADMIN = 'admin';
  
  private string $email;
  private string $password;
  private string $login;
  private string $role = self::ROLE_EDITOR;

  /**
   * Vérifie si l'utilisateur est un administrateur
   * @return bool Valeur booléenne
   */
  public function isAdmin(): bool
  {
    return $this->role === self::ROLE_ADMIN;
  }
  
  public function getEmail(): string { return $this->email; }
  public function setEmail(string $email): self { $this->email = $email; return $this; }
  
  public function getPassword(): string { return $this->password; }
  public function setPassword(string $password): self { $this->password = $password; return $this; }
  
  public function getLogin(): string { return $this->login; }
  public function setLogin(string $login): self { $this->login = $login; return $this; }
  
  public function getRole(): string { return $this->role; }
  public function setRole(string $role): self { $this->role = $role; return $this; }
}
