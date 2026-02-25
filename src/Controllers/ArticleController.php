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
}