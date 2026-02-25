<?php

namespace App\Core;

use App\Model\Entities\User;

final class Auth
{
  /**
   * Fonction de login qui stocke en session les infos utilisateur
   * @param User $user Entité utilisateur (id, email, role)
   * @return void Pas de valeur de retour
   */
  public static function login(User $user): void
  {
    $_SESSION['user_id'] = $user->getId();
    $_SESSION['user_login'] = $user->getLogin();
    $_SESSION['user_email'] = $user->getEmail();
    $_SESSION['user_role'] = $user->getRole() ?? User::ROLE_EDITOR;
  }
  
  /**
   * Fonction de déconnexion (on détruit puis réinitialise une session vide)
   * @return void Pas de valeur de retour
   */
  public static function logout(): void
  {
    session_destroy();
    session_start();
  }
  
  /**
   * Indique si on est loggué
   * @return bool Valeur booléenne
   */
  public static function isLoggedIn(): bool
  {
    return isset($_SESSION['user_id']);
  }
  
  /**
   * Récupération id utilisateur depuis la session
   * @return ?int Identifiant utilisateur
   */
  public static function getUserId(): ?int
  {
    return $_SESSION['user_id'] ?? null;
  }
  
  /**
   * Récupération des infos de l'utilisateur connecté depuis la session
   * @return ?User Entité user
   */
  public static function getUser(): ?User
  {
    //si pas connecté on retourne rien
    if (!self::isLoggedIn()) {
      return null;
    }
      
    return new User([
      'id'       => $_SESSION['user_id'],
      'login'    => $_SESSION['user_login'],
      'email'    => $_SESSION['user_email'],
      'role'     => $_SESSION['user_role']
    ]);
  }
  
  /**
   * Vérification du rôle de l'utilisateur connecté
   * @param string $role Rôle à vérifier
   * @return bool Valeur booléenne
   */
  public static function hasRole(string $role): bool
  {
    return self::isLoggedIn() && $_SESSION['user_role'] === $role;
  }
  
  /**
   * Vérification si administrateur
   * @return bool Valeur booléenne
   */
  public static function isAdmin(): bool
  {
    return self::hasRole(User::ROLE_ADMIN);
  }
  
  /**
   * Hashage du mot de passe
   * @param string $password Mot de passe à hasher
   * @return string Mot de passe hashé
   */
  public static function hashPassword(string $password): string
  {
    return password_hash($password, PASSWORD_BCRYPT);
  }
  
  /**
   * Vérification du mot de passe
   * @param string $password Mot de passe à vérifier
   * @param string $hash Hash de mot de passe à comparer
   * @return bool Valeur booléenne
   */
  public static function verifyPassword(string $password, string $hash): bool
  {
    return password_verify($password, $hash);
  }
}
