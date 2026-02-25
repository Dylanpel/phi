<?php

namespace App\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

final class TwigFactory
{
  public static function create(): Environment
  {
    $loader = new FilesystemLoader(__DIR__ . '/../../views');

    $twig = new Environment($loader, [
      'cache' => $_ENV['APP_ENV'] === 'prod' 
        ? __DIR__ . '/../../var/cache/twig' 
        : false,
      'debug' => $_ENV['APP_ENV'] === 'dev',
    ]);

    // Fonction personnalisée pour générer les URLs
    $twig->addFunction(new TwigFunction('base_url', fn() => Router::getBaseUrl()));
    $twig->addFunction(new TwigFunction('url', fn(string $path) => Router::getBaseUrl() . '/' . ltrim($path, '/')));
    
    // Variables globales disponibles dans tous les templates
    $twig->addGlobal('isLoggedIn', Auth::isLoggedIn());
    $twig->addGlobal('isAdmin', Auth::isAdmin());
    $twig->addGlobal('currentUser', Auth::getUser());
    $twig->addGlobal('baseUrl', Router::getBaseUrl());
    $twig->addGlobal('app_env', $_ENV['APP_ENV'] ?? 'prod');

    // Ajout de l'extension debug (dump()) en dev
    if ($_ENV['APP_ENV'] === 'dev') {
      $twig->addExtension(new \Twig\Extension\DebugExtension());
    }

    return $twig;
  }
}