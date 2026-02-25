<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Env;
use App\Core\Router;

//démarrage de la session
session_start();

// Chargement des variables d'environnement
Env::load(__DIR__ . '/..');

// Initialisation du Rooter
$router = new Router();

// Dispatcher
$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$router->dispatch($method, $uri);
