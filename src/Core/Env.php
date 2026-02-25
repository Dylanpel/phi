<?php

namespace App\Core;

final class Env
{
  private function __construct()
  {
    throw new \LogicException('Cette classe ne peut pas être instanciée.');
  }

  private function __clone()
  {
    throw new \LogicException('Cette classe ne peut pas être clonée.');
  }
  
  /**
   * Permet de charger tous les fichiers ENV d'un coup
   * @return void Pas de valeur de retour
   */
  public static function load(string $rootDir): void
  {
    // Charger .env
    self::loadFile($rootDir . '/.env');
    
    // Charger .env.local (override)
    self::loadFile($rootDir . '/.env.local');
  }
  
  /**
   * Récupération des variables des fichiers ENV
   * @return void Pas de valeur de retour
   */
  private static function loadFile(string $filePath): void
  {
    if (!file_exists($filePath)) {
      return;
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    foreach ($lines as $line) {
      if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
        [$key, $value] = explode('=', $line, 2);
        $_ENV[trim($key)] = trim($value);
      }
    }
  }
}
