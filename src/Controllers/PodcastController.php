<?php

namespace App\Controllers;

use App\Core\Abstract\Controller;
use App\Core\Auth;
use App\Core\Router;
use App\Model\Managers\PodcastManager;

class PodcastController extends Controller
{
  private PodcastManager $podcastManager;

  public function __construct()
  {
    parent::__construct();

    //on instancie les managers directement à l'instantiation
    $this->podcastManager = new PodcastManager();
  }

  /**
   * Affiche la vue listant les podcasts
   * @return void Pas de valeur de retour
   */
  public function index(): void
  {
    $this->render('podcasts/index', [
      'podcasts' => $this->podcastManager->findAll()
    ]);
  }
}