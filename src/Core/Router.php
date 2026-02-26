<?php

namespace App\Core;

use App\Controllers\PageController;

final class Router
{
  private static ?Router $instance = null;
  private array $routes = [];
  private string $baseUrl;
  private string $basePath;
  private ?string $currentRoute = null; // ✅ Ajout pour stocker la route actuelle
  
  /**
   * Constructeur du Router
   */
  public function __construct()
  {
    // Détection automatique du base path et base URL
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $scriptName = $_SERVER['SCRIPT_NAME'];
    
    // Calcul du base path (ex: /mon-projet ou vide)
    $this->basePath = rtrim(str_replace('\\', '/', dirname($scriptName)), '/');

    // Construction de l'URL de base
    $this->baseUrl = $protocol . '://' . $host . $this->basePath;

    // Stockage de l'instance pour accès statique
    self::$instance = $this;

    $this->loadRoutesFromJson();
  }
  
  /**
   * Récupère l'instance du Router (singleton)
   *
   * @return Router
   */
  public static function getInstance(): Router
  {
    if (self::$instance === null) {
      throw new \RuntimeException("Le Router n'a pas encore été instancié.");
    }
    return self::$instance;
  }
  
  /**
   * Récupère la route actuelle
   *
   * @return string|null Route actuelle ou null
   */
  public static function getCurrentRoute(): ?string
  {
    return self::getInstance()->currentRoute;
  }
  
  /**
   * Charge les routes depuis un fichier JSON
   *
   * @return void
   * @throws \RuntimeException Si le fichier n'existe pas ou est invalide
   */
  private function loadRoutesFromJson(): void
  {
    // Construire le chemin complet vers le fichier de config
    $configPath = __DIR__ . '/../../Config/routes.json';
    
    // Vérifier que le fichier existe
    if (!file_exists($configPath)) {
      throw new \RuntimeException("Le fichier de configuration {$configPath} n'existe pas.");
    }
    
    // Lire le contenu du fichier
    $jsonContent = file_get_contents($configPath);
    
    if ($jsonContent === false) {
      throw new \RuntimeException("Impossible de lire le fichier de configuration {$configPath}.");
    }
    
    // Décoder le JSON
    $routesData = json_decode($jsonContent, true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
      throw new \RuntimeException("Erreur de parsing JSON : " . json_last_error_msg());
    }
    
    // Vérifier que le JSON contient bien un objet routes
    if (!isset($routesData['routes']) || !is_array($routesData['routes'])) {
      throw new \RuntimeException("Le fichier JSON doit contenir une clé 'routes' avec un objet.");
    }
    
    // Parcourir chaque controller
    foreach ($routesData['routes'] as $controller => $routes) {
      // Vérifier que $routes est bien un tableau
      if (!is_array($routes)) {
        throw new \RuntimeException("Les routes du controller {$controller} doivent être un tableau.");
      }
      
      // Ajouter chaque route du controller
      foreach ($routes as $route) {
        // Valider que la route contient les champs requis
        if (!isset($route['method'], $route['path'], $route['action'])) {
          throw new \RuntimeException("Une route du controller {$controller} est incomplète. Champs requis : method, path, action.");
        }
        
        $this->addRoute(
          $route['method'],
          $route['path'],
          $controller,
          $route['action']
        );
      }
    }
  }
  
  /**
   * Permet d'ajouter une route
   *
   * @param string $method Méthode HTTP (GET OU POST)
   * @param string $path Chemin url de la route
   * @param string $controller Nom du controller
   * @param string $action Nom de l'action
   * @return void Pas de valeur de retour
   */
  public function addRoute(string $method, string $path, string $controller, string $action): void
  {
    $this->routes[] = [
      'method' => strtoupper($method),
      'path' => $path,
      'controller' => $controller,
      'action' => $action
    ];
  }

  /**
   * Génère une URL complète avec le base path
   * Accepte les chemins avec ou sans slash initial
   *
   * @param string $path Chemin relatif (ex: 'contact', '/contact', 'admin/users', '/admin/users')
   * @return string URL complète
   */
  public static function url(string $path = ''): string
  {
    $instance = self::getInstance();
    // Normalise le path en retirant le slash initial s'il existe
    $path = ltrim($path, '/');
    return $instance->baseUrl . '/' . $path;
  }
  
  /**
   * Redirige vers une URL avec gestion du redirect_override
   * Accepte les chemins avec ou sans slash initial
   *
   * @param string $path Chemin relatif (ex: 'contact', '/contact', 'admin/users', '/admin/users')
   * @param bool $useOverride Indique si on doit utiliser la variable de session redirect_override (true par défaut)
   * @return void
   */
  public static function redirect(string $path = '', bool $useOverride = true): void
  {
    // Gestion du redirect_override depuis la session
    if ($useOverride && isset($_SESSION['redirect_override'])) {
      $path = $_SESSION['redirect_override'];
      unset($_SESSION['redirect_override']);
    }
    
    // Normalise le path en retirant le slash initial s'il existe
    $path = ltrim($path, '/');
    $redirectPath = self::url($path);
    
    header("Location: $redirectPath");
    exit;
  }
  
  /**
   * Retourne le base path
   *
   * @return string Base path (ex: '/mon-projet' ou '')
   */
  public static function getBasePath(): string
  {
    return self::getInstance()->basePath;
  }
  
  /**
   * Retourne le base URL
   *
   * @return string Base URL complète (ex: 'http://localhost/mon-projet')
   */
  public static function getBaseUrl(): string
  {
    return self::getInstance()->baseUrl;
  }

  /**
   * Permet d'appeler le bon contrôleur en fonction de l'url courante
   *
   * @param string $method Méthode HTTP (GET OU POST)
   * @param string $uri URI complète à parser
   * @return void Pas de valeur de retour
   */
  public function dispatch(string $method, string $uri): void
  {
    // Récupération de la partie URI (hors domaine)
    $uri = parse_url($uri, PHP_URL_PATH);
    
    // *** RETIRE LE BASE PATH DE L'URI POUR MATCHER LES ROUTES ***
    if ($this->basePath !== '' && strpos($uri, $this->basePath) === 0) {
      $uri = substr($uri, strlen($this->basePath));
    }
    
    // Assure qu'on a un slash au début
    $uri = '/' . ltrim($uri, '/');
    
    // Stockage de la route actuelle dans le Router (propriété privée, pas besoin de setter)
    $this->currentRoute = $uri;
    
    // On parcourt toutes les routes passées au Router
    foreach ($this->routes as $route) {
      $params = [];
      
      // Si on ne trouve pas de controller ou d'action on sort une 404, sinon on charge l'action associée
      if ($route['method'] === $method && $this->matchPath($route['path'], $uri, $params)) {
        $controllerClass = "App\\Controllers\\{$route['controller']}";
        
        // Si la classe controller n'existe pas
        if (!class_exists($controllerClass)) {
          $this->error404();
          return;
        }
        
        // Instanciation de la classe controleur
        $controller = new $controllerClass();
        $action = $route['action'];
        
        // Vérification de la méthode action dans le controleur
        if (!method_exists($controller, $action)) {
          $this->error404();
          return;
        }
        
        // Injection de la route actuelle dans le contrôleur via son setter
        if (method_exists($controller, 'setCurrentRoute')) {
          $controller->setCurrentRoute($uri);
        }
        
        // Lancement de l'action avec les paramètres extraits
        $controller->$action(...$params);
        return;
      }
    }
    
    // Par défaut on a une erreur 404
    $this->error404();
  }
  
  /**
   * Permet de vérifier la présence du chemin et extraire les paramètres
   *
   * @param string $path Chemin à analyser
   * @param string $uri URI complète
   * @param ?array $params Paramètres à extraire de l'URI
   * @return bool Valeur booléenne
   */
  private function matchPath(string $path, string $uri, &$params = []): bool
  {
    // Capturer les noms de paramètres {id}, {slug}, etc.
    preg_match_all('/\{([a-zA-Z]+)\}/', $path, $paramNames);
    
    // Transformer {id} en groupe de capture ([^/]+)
    $regex = preg_replace('/\{[a-zA-Z]+\}/', '([^/]+)', $path);
    $regex = "#^{$regex}$#";
    
    // Vérifier si l'URI correspond au pattern
    if (preg_match($regex, $uri, $matches)) {
      // Enlever le match complet (index 0)
      array_shift($matches);
      
      // Associer les noms de paramètres avec leurs valeurs
      foreach ($paramNames[1] as $index => $name) {
        $params[] = $matches[$index] ?? null;
      }
      
      return true;
    }
    
    return false;
  }
  
  /**
   * Renvoie une page 404 (remplacer à terme par une vue spécifique)
   *
   * @return void Pas de valeur de retour
   */
  private function error404(): void
  {
    http_response_code(404);
    $pageController = new PageController();
    $pageController->error([
      'error' => '404 - Page non trouvée'
    ]);
  }
}
