<?php

namespace App\Controllers;

use App\Core\Abstract\Controller;
use App\Core\Auth;
use App\Core\Router;
use App\Model\Managers\UserManager;

class AuthController extends Controller
{
  private UserManager $userManager;
  
  public function __construct()
  {
    parent::__construct();
    
    //on instancie le manager directement à l'instantiation pour récupérer les infos utilisateur
    $this->userManager = new UserManager();
  }
  
  /**
   * Affiche la vue du formulaire de login
   * @return void Pas de valeur de retour
   */
  public function loginForm(): void
  {
    //si déjà logué on redirige vers l'admin
    if (Auth::isLoggedIn()) {
      Router::redirect('/');
    }
    
    $this->render('auth/login');
  }
  
  /**
   * Traitement du formulaire de login
   * @return void Pas de valeur de retour
   */
  public function login(): void
  {
    //récupération des infos de login envoyées par le formulaire
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';
    
    //on vérifie que l'utilisateur existe par login
    $user = $this->userManager->findByLogin($login);

    //si l'utilisateur existe et que le mot de passe existe on redirige vers le dashboard (vue à créer)
    if ($user && Auth::verifyPassword($password, $user->getPassword())) {
      Auth::login($user);
      Router::redirect('/');
    } else {
      $this->render('auth/login', ['error' => 'Identifiants invalides']);
    }
  }

  /**
   * Création des utilisateurs admin et editor
   * @return void Pas de valeur de retour
   */
  public function usersInit(): void
  {
    //création des utilisateurs en base et retour ids EN DUR si nécessaire

    if (!$this->userManager->loginExists('administrator')) {
      $this->userManager->create([
        'email' => 'admin@phi.local',
        'password' => Auth::hashPassword('adminpassword'),
        'login' => 'administrator',
        'role' => 'admin'
      ]);
    }

    if (!$this->userManager->loginExists('editor')) {
      $this->userManager->create([
        'email' => 'editor@phi.local',
        'password' => Auth::hashPassword('editorpassword'),
        'login' => 'editor',
        'role' => 'editor'
      ]);
    }
    
    Router::redirect('/');
  }
  
  /**
   * Affiche la vue du formulaire de création d'utilisateur
   * @return void Pas de valeur de retour
   */
  public function registerForm(): void
  {
    //seul les admins peuvent créer des utilisateurs
    $this->requireAdmin();
    
    $this->render('auth/register');
  }
  
  /**
   * Traitement du formulaire de création d'un utilisateur
   * @return void Pas de valeur de retour
   */
  public function register(): void
  {
    //seul les admins peuvent créer des utilisateurs
    $this->requireAdmin();
    
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $login = $_POST['login'] ?? '';
    
    //vérification utilisation email
    if ($this->userManager->emailExists($email)) {
      $this->render('auth/register', ['error' => 'Email déjà utilisé']);
      return;
    }
    
    //vérification utilisation login
    if ($this->userManager->loginExists($login)) {
      $this->render('auth/register', ['error' => 'Nom d\'utilisateur déjà utilisé']);
      return;
    }
    
    //création de l'utilisateur en base et retour de son entité
    $user = $this->userManager->create([
      'email' => $email,
      'password' => Auth::hashPassword($password),
      'login' => $login
    ]);
    
    //on se logue automatiquement avec l'entité créée et on va dans l'admin
    Auth::login($user);
    Router::redirect('/dashboard');
  }
  
  /**
   * Déconnection et redirection vers la home
   * @return void Pas de valeur de retour
   */
  public function logout(): void
  {
    Auth::logout();
    Router::redirect('/');
  }
}
