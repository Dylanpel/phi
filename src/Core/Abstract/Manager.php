<?php

namespace App\Core\Abstract;

use App\Core\Db;

abstract class Manager
{
  protected \PDO $db;

  // Table en base de donnée
  protected string $table;

  // Nom de la classe entité
  protected string $entityClass;
  
  // Tableau contenant toutes les colonnes de la table (par sécurité)
  protected array $tableColumns = [];

  /**
   * Récupération de l'instance de PDO à l'instanciation du manager
   */
  public function __construct()
  {
    $this->db = Db::getInstance();
  }

  /**
   * Hydrate une entité à partir d’un tableau
   * @return object Entité hydratée
   */
  protected function hydrate(array $data): object
  {
    $entity = new $this->entityClass();
    $entity->hydrate($data);

    return $entity;
  }
  
  /**
   * Retourne toutes les entités
   * @return array Tableau d'entités
   */
  public function findAll(): array
  {
    $stmt = $this->db->query("SELECT * FROM {$this->table}");
    $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    return array_map(fn($row) => $this->hydrate($row), $results);
  }

  /**
   * Récupération d'une entité par son id
   * @param int $id Identifiant de l'entité à récupérer
   * @return ?object Entité ou null
   */
  public function findById(int $id): ?object
  {
    $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
    $stmt->execute(['id' => $id]);

    $result = $stmt->fetch(\PDO::FETCH_ASSOC);

    return $result ? $this->hydrate($result) : null;
  }

  /**
   * Création d'une entité en base avec un tableau de données
   * @param array $data Tableau des données à insérer en base
   * @return object Entité créée en base
   */
  public function create(array $data): object
  {
    $fields = array_keys($data);
    //création d'un tableau de correspondance :champ $champ
    $placeholders = array_map(fn($field) => ":$field", $fields);

    //création de la requête d'insertion
    $sql = sprintf(
      "INSERT INTO %s (%s) VALUES (%s)",
      $this->table,
      implode(', ', $fields),
      implode(', ', $placeholders)
    );

    //exécution de la requête avec les données à insérer
    $stmt = $this->db->prepare($sql);
    $stmt->execute($data);

    //récupératin de l'id de l'élément inséré
    $id = (int) $this->db->lastInsertId();
    
    //on retourne l'élément créé 
    return $this->findById($id);
  }

  /**
   * Mise à jour en base d'un élément à partir de son id
   * @param int $id Identifiant de l'entité à mettre à jour
   * @param array $data Tableau des données à mettre à jour
   * @return bool Valeur booléenne
   */
  public function update(int $id, array $data): bool
  {
    //extraction des champs à partir du tableau associatif de données
    $fields = array_map(fn($field) => "$field = :$field", array_keys($data));

    //création de la requête
    $sql = sprintf(
      "UPDATE %s SET %s WHERE id = :id",
      $this->table,
      implode(', ', $fields)
    );

    //spécification de l'ID dans les données
    $data['id'] = $id;

    //exécution de la requête avec les données à mettre à jour
    $stmt = $this->db->prepare($sql);
    return $stmt->execute($data);
  }

  /**
   * Suppression en base d'un élément à partir de son id
   * @param int $id Identifiant de l'élément à supprimer
   * @return bool Valeur booléenne
   */
  public function delete(int $id): bool
  {
    $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
    return $stmt->execute(['id' => $id]);
  }

  /**
   * Méthode magique pour gérer les appels dynamiques findBy* et *Exists
   * 
   * Exemples d'utilisation :
   * - findByEmail('test@example.com')
   * - findByRole('admin', orderBy: 'admin', direction: 'DESC', limit: 10)
   * - emailExists('test@example.com')
   * 
   * @param string $method Nom de la méthode appelée
   * @param array $arguments Arguments passés à la méthode
   * @return mixed
   */
  public function __call(string $method, array $arguments)
  {
    // Pattern pour findBy{Column}
    if (preg_match('/^findBy([A-Z][a-zA-Z0-9]*)$/', $method, $matches)) {
      $column = $this->camelToSnake($matches[1]);
      $this->validateColumn($column);
      
      // Extraction des paramètres
      $value = $arguments[0] ?? null;
      $orderBy = $arguments['orderBy'] ?? $arguments[1] ?? null;
      $direction = $arguments['direction'] ?? $arguments[2] ?? 'ASC';
      $limit = $arguments['limit'] ?? $arguments[3] ?? null;
      
      return $this->findByColumn($column, $value, $orderBy, $direction, $limit);
    }
    
    // Pattern pour {column}Exists
    if (preg_match('/^([a-z][a-zA-Z0-9]*)Exists$/', $method, $matches)) {
      $column = $this->camelToSnake($matches[1]);
      $this->validateColumn($column);
      return $this->columnExists($column, $arguments[0] ?? null);
    }
    
    throw new \BadMethodCallException("La méthode {$method} n'existe pas dans " . static::class);
  }

  /**
   * Valide qu'une colonne est autorisée pour la recherche ou validation
   * @param string $column Nom de la colonne
   * @throws \BadMethodCallException Si la colonne n'est pas autorisée
   */
  private function validateColumn(string $column): void
  {
    if (!empty($this->tableColumns) && !in_array($column, $this->tableColumns)) {
      throw new \BadMethodCallException(
        "La colonne '{$column}' n'est pas autorisée pour la recherche ou vérification dans " . static::class
      );
    }
  }

  /**
   * Valide qu'une colonne existe dans les colonnes autorisées (pour ORDER BY)
   * @param string $column Nom de la colonne
   * @throws \InvalidArgumentException Si la colonne n'est pas autorisée
   */
  private function validateOrderByColumn(string $column): void
  {
    if (!empty($this->tableColumns) && !in_array($column, $this->tableColumns) && $column !== 'id') {
      throw new \InvalidArgumentException(
        "La colonne '{$column}' n'est pas autorisée pour le tri dans " . static::class
      );
    }
  }

  /**
   * Valide la direction du tri
   * @param string $direction Direction du tri
   * @throws \InvalidArgumentException Si la direction n'est pas ASC ou DESC
   */
  private function validateDirection(string $direction): void
  {
    $direction = strtoupper($direction);
    if (!in_array($direction, ['ASC', 'DESC'])) {
      throw new \InvalidArgumentException("La direction doit être 'ASC' ou 'DESC'");
    }
  }
  
  /**
   * Conversion camelCase vers snake_case
   * @param string $input Chaîne en camelCase
   * @return string Chaîne en snake_case
   */
  private function camelToSnake(string $input): string
  {
    return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $input));
  }
  
  /**
   * Recherche des entités par une colonne spécifique avec options de tri et limite
   * @param string $column Nom de la colonne
   * @param mixed $value Valeur à rechercher
   * @param string|null $orderBy Colonne de tri (optionnel)
   * @param string $direction Direction du tri : ASC ou DESC (défaut: ASC)
   * @param int|null $limit Nombre maximum de résultats (optionnel)
   * @return array|object|null Entité(s) trouvée(s) ou null
   */
  protected function findByColumn(
    string $column, 
    mixed $value, 
    ?string $orderBy = null, 
    string $direction = 'ASC',
    ?int $limit = null
  ): array|object|null
  {
    // Construction de la requête de base
    $sql = "SELECT * FROM {$this->table} WHERE {$column} = :{$column}";

    // Ajout du ORDER BY si spécifié
    if ($orderBy !== null) {
      $this->validateOrderByColumn($orderBy);
      $this->validateDirection($direction);
      $sql .= " ORDER BY {$orderBy} " . strtoupper($direction);
    }

    // Ajout du LIMIT si spécifié
    if ($limit !== null) {
      if ($limit < 1) {
        throw new \InvalidArgumentException("La limite doit être un entier positif");
      }
      $sql .= " LIMIT " . (int)$limit;
    }

    $stmt = $this->db->prepare($sql);
    $stmt->execute([$column => $value]);
    
    // Si limit = 1, on retourne une seule entité (ou null)
    if ($limit === 1) {
      $result = $stmt->fetch(\PDO::FETCH_ASSOC);
      return $result ? $this->hydrate($result) : null;
    }

    // Sinon, on retourne un tableau d'entités
    $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    // Si aucun orderBy/limit n'est spécifié et qu'il n'y a qu'un résultat,
    // on retourne l'entité directement (comportement historique)
    if ($orderBy === null && $limit === null && count($results) === 1) {
      return $this->hydrate($results[0]);
    }

    // Si pas de résultats et pas de limit/orderBy, on retourne null (comportement historique)
    if ($orderBy === null && $limit === null && empty($results)) {
      return null;
    }
    
    // Sinon on retourne le tableau (peut être vide)
    return array_map(fn($row) => $this->hydrate($row), $results);
  }

  /**
   * Vérifie si une valeur existe pour une colonne donnée
   * @param string $column Nom de la colonne
   * @param mixed $value Valeur à vérifier
   * @return bool True si la valeur existe
   */
  protected function columnExists(string $column, mixed $value): bool
  {
    $stmt = $this->db->prepare("SELECT COUNT(*) FROM {$this->table} WHERE {$column} = :{$column}");
    $stmt->execute([$column => $value]);
    
    return $stmt->fetchColumn() > 0;
  }
}
