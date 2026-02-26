<?php

namespace App\Controllers;

use App\Core\Abstract\Controller;
use App\Core\Auth;
use App\Core\Router;
use App\Model\Managers\ArticleManager;

class ArticleController extends Controller
{
  private ArticleManager $articleManager;

  public function __construct()
  {
    parent::__construct();

    //on instancie les managers directement à l'instantiation
    $this->articleManager = new ArticleManager();
  }

  /**
   * Affiche la vue listant les articles
   * @return void Pas de valeur de retour
   */
  public function index(): void
  {
    $this->render('articles/index', [
      'articles' => $this->articleManager->findAll()
    ]);
  }

  /**
   * Affiche la vue du formulaire de création d'article
   * @return void Pas de valeur de retour
   */
  public function createForm(): void
  {
    //obligation de la connexion en tant qu'admin
    $this->requireAuth();

    $this->render('admin/article/form', [
      'action' => '/admin/article/form'
    ]);
  }

  /**
   * Traitement du formulaire de création d'article
   * @return void Pas de valeur de retour
   */
  public function create(): void
  {
    //obligation de la connexion en tant qu'admin
    $this->requireAuth();

    //récupération des infos envoyées par le formulaire
    $title = trim($_POST['title'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $date = trim($_POST['date'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $imageUrl = trim($_POST['image_url'] ?? '');

    $data = [
      'title' => $title,
      'slug' => $slug,
      'date' => $date,
      'content' => $content,
      'id_user' => Auth::getUserId()
    ];
    
    if(!empty($imageUrl)) {
      $data['image_url'] = $imageUrl;
    }
    
    //création de l'article en base et récupération entité de ce dernier
    $article = $this->articleManager->create($data);
    
    //redirection vers le formulaire de modification
    $id = $article->getId();
    Router::redirect("/admin/article/$id/form");
  }

  /**
   * Affiche la vue du formulaire de modification de page
   * @return void Pas de valeur de retour
   */
  public function updateForm(int $id): void
  {
    //obligation de la connexion en tant qu'admin
    $this->requireAuth();

    $this->render('admin/article/form', [
      'action' => "/admin/article/$id/form",
      'article' => $this->articleManager->findById($id)
    ]);
  }

  /**
   * Traitement du formulaire de modification de page
   * @return void Pas de valeur de retour
   */
  public function update(int $id): void
  {
    //obligation de la connexion en tant qu'admin
    $this->requireAuth();
    
    //récupération des infos envoyées par le formulaire
    $title = trim($_POST['title'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $date = trim($_POST['date'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $imageUrl = trim($_POST['image_url'] ?? '');

    //création object contenant les données à mettre à jour
    $data = [
      'title' => $title,
      'slug' => $slug,
      'date' => $date,
      'content' => $content,
      'image_url' => $imageUrl,
    ];

    $this->articleManager->update($id, $data);

    //redirection vers le formulaire de modification
    Router::redirect("/admin/article/$id/form");
  }
}
