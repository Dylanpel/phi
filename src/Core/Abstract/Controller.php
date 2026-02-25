<?php

namespace App\Core\Abstract;

use App\Core\Auth;
use App\Core\Router;
use App\Core\TwigFactory;
use App\Model\Entities\User;
use Twig\Environment;

abstract class Controller
{
  protected ?string $currentRoute = null;
  protected Environment $twig;

  public function __construct()
  {
    $this->twig = TwigFactory::create();
  }

  /**
   * Définit la route actuelle
   * @param string $route Route actuelle
   * @return self Classe du controller
   */
  public function setCurrentRoute(string $route): self
  {
    $this->currentRoute = $route;
    return $this;
  }
  
  /**
   * Récupère la route actuelle
   * @return string|null Route actuelle ou null
   */
  protected function getCurrentRoute(): ?string
  {
    return $this->currentRoute;
  }

  /**
   * Vérifie si l'utilisateur est connecté, sinon redirige vers login
   *
   * @param string|null $role Rôle minimum requis (null = juste connecté)
   * @return void Pas de valeur de retour
   */
  protected function requireAuth(?string $role = null): void
  {
    // Vérifier si l'utilisateur est connecté
    if (!Auth::isLoggedIn()) {
      $_SESSION['redirect_override'] = $this->currentRoute;
      Router::redirect('/login', false);
      exit;
    }
    
    // Vérification du rôle UNIQUEMENT si un rôle spécifique est demandé
    if ($role !== null && $_SESSION['user_role'] !== $role) {
      http_response_code(403);
      Router::redirect('/forbidden');
      exit;
    }
  }

  /**
   * Vérifie si l'utilisateur est un admin, sinon redirige vers login
   * @return void Pas de valeur de retour
   */
  protected function requireAdmin(): void
  {
    $this->requireAuth(User::ROLE_ADMIN);
  }

  /**
   * Fonction de rendu de la vue associée au controleur
   * @param string $view Nom de la vue à afficher
   * @param array $data Tableau des données à insérer dans la vue
   * @return void Pas de valeur de retour
   */
  protected function render(string $view, array $data = []): void
  {
    echo $this->twig->render("{$view}.html.twig", $data);
  }
}