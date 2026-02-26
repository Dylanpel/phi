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
      'articles' => $this->articleManager->findAll('date','DESC')
    ]);
  }
  
  /**
   * Affiche la vue listant les articles
   * @return void Pas de valeur de retour
   */
  public function show(string $slug): void
  {
    $this->render('articles/show', [
      'article' => $this->articleManager->findBySlug($slug)
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
    //obligation de la connexion
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
    
    //redirection vers la page article créé
    $slug = $article->getSlug();
    Router::redirect("/nos-actus/blog/$slug");
  }

  /**
   * Affiche la vue du formulaire de modification de page
   * @return void Pas de valeur de retour
   */
  public function updateForm(int $id): void
  {
    //obligation de la connexion
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
    //obligation de la connexion
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

    //redirection vers la page article
    Router::redirect("/nos-actus/blog/$slug");
  }
  
  /**
   * Supprimer un artiste
   * @param int $id Identifiant de l'artiste à supprimer
   * @return void Pas de valeur de retour
   */
  public function delete(int $id): void
  {
    //obligation de la connexion en tant qu'admin
    $this->requireAdmin();

    //suppression article en base
    $this->articleManager->delete($id);
    
    //redirection vers la page listing articles
    Router::redirect("/nos-actus/blog");
  }
}
