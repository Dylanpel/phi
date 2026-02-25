<?php

namespace App\Core;

final class Db
{
  private static ?\PDO $instance = null;
  
  private function __construct()
  {
    throw new \LogicException('Cette classe ne peut pas être instanciée.');
  }

  private function __clone()
  {
    throw new \LogicException('Cette classe ne peut pas être clonée.');
  }

  /**
   * Récupération de l'instance PDO
   * @return \PDO Instance PDO
   */
  public static function getInstance(): \PDO
  {
    if (self::$instance === null) {
      try {
        self::$instance = new \PDO(
          "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'] . ";charset=utf8mb4",
          $_ENV['DB_USER'],
          $_ENV['DB_PASS'],
          [
              \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
              \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
              \PDO::ATTR_EMULATE_PREPARES => false
          ]
        );
      } catch (\PDOException $e) {
        die("PDO connection error : " . $e->getMessage());
      }
    }
    
    return self::$instance;
  }
  
}
