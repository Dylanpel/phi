<?php

namespace App\Controllers;

use App\Core\Abstract\Controller;
use App\Core\Auth;
use App\Core\Router;
use App\Model\Managers\PageManager;

class PageController extends Controller
{
  private PageManager $pageManager;

  public function __construct()
  {
    parent::__construct();

    //on instancie les managers directement à l'instantiation
    $this->pageManager = new PageManager();
  }

  /**
   * Affiche la vue de la home
   * @return void Pas de valeur de retour
   */
  public function home(): void
  {
    $this->render('pages/home', [
      //spécifier en dûr id de la page en base
      'page' => $this->pageManager->findById(1)
    ]);
  }

  /**
   * Affiche la vue du formulaire de création de page
   * @return void Pas de valeur de retour
   */
  public function createForm(): void
  {
    //obligation de la connexion en tant qu'admin
    $this->requireAdmin();

    $this->render('admin/page/form', [
      'action' => '/admin/page/form'
    ]);
  }

  /**
   * Traitement du formulaire de création de page
   * @return void Pas de valeur de retour
   */
  public function create(): void
  {
    //obligation de la connexion en tant qu'admin
    $this->requireAdmin();

    //récupération des infos envoyées par le formulaire
    $title = trim($_POST['title'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $imageUrl = trim($_POST['image_url'] ?? '');

    $data = [
      'title' => $title,
      'slug' => $slug,
      'content' => $content,
    ];
    
    if(!empty($imageUrl)) {
      $data['image_url'] = $imageUrl;
    }
    
    $this->pageManager->create($data);

    //redirection vers la home
    Router::redirect('/');
  }

  /**
   * Affiche la vue du formulaire de modification de page
   * @return void Pas de valeur de retour
   */
  public function updateForm(int $id): void
  {
    //obligation de la connexion en tant qu'admin
    $this->requireAdmin();

    $this->render('admin/page/form', [
      'action' => "/admin/page/$id/form",
      'page' => $this->pageManager->findById($id)
    ]);
  }

  /**
   * Traitement du formulaire de modification de page
   * @return void Pas de valeur de retour
   */
  public function update(int $id): void
  {
    //obligation de la connexion en tant qu'admin
    $this->requireAdmin();
    
    //récupération des infos envoyées par le formulaire
    $title = trim($_POST['title'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $imageUrl = trim($_POST['image_url'] ?? '');

    //création object contenant les données à mettre à jour
    $data = [
      'title' => $title,
      'slug' => $slug,
      'content' => $content,
      'image_url' => $imageUrl,
    ];

    $this->pageManager->update($id, $data);

    //redirection vers le formulaire de modification
    Router::redirect("/admin/page/$id/form");
  }
  
  /**
   * Affiche la vue de la page d'erreur
   * @return void Pas de valeur de retour
   */
  public function error(?array $data = []): void
  {
    $this->render('pages/error', $data);
  }

  /**
   * Affiche la vue de la page d'accès interdit
   * @return void Pas de valeur de retour
   */
  public function forbidden(?array $data = []): void
  {
    $this->render('pages/forbidden', $data);
  }

  /**
   * Affiche la vue de la page de contact
   * @return void Pas de valeur de retour
   */
  public function contact(?array $data = []): void
  {
    $this->render('pages/contact', $data);
  }

  /**
   * Affiche la vue de la page de Qui Sommes Nous
   * @return void Pas de valeur de retour
   */
  public function quiSommesNous(?array $data = []): void
  {
    $this->render('pages/qui-sommes-nous', $data);
  }

  /**
   * Affiche la vue de la page de Qui Sommes Nous Histoire
   * @return void Pas de valeur de retour
   */
  public function quiSommesNousHistoire(?array $data = []): void
  {
    $this->render('pages/qui-somme-nous/histoire', $data);
  }

  /**
   * Affiche la vue de la page de Qui Sommes Nous Equipe
   * @return void Pas de valeur de retour
   */
  public function quiSommesNousEquipe(?array $data = []): void
  {
    $this->render('pages/qui-somme-nous/equipe', $data);
  }

  /**
   * Affiche la vue de la page de Qui Sommes Nous Etablissement
   * @return void Pas de valeur de retour
   */
  public function quiSommesNousEtablissement(?array $data = []): void
  {
    $this->render('pages/qui-somme-nous/etablissement', $data);
  }

  /**
   * Affiche la vue de la page devenir Bénévole
   * @return void Pas de valeur de retour
   */
  public function devenirBenevole(?array $data = []): void
  {
    $this->render('pages/devenir_benevole', $data);
  }

  /**
   * Affiche la vue de la page faire un don
   * @return void Pas de valeur de retour
   */
  public function faireDon(?array $data = []): void
  {
    $this->render('pages/dons', $data);
  }

  /**
   * Affiche la vue de la page faire un don
   * @return void Pas de valeur de retour
   */
  public function mobilisation(?array $data = []): void
  {
    $this->render('pages/mobilisation', $data);
  }
}
