<?php

namespace App\Controllers;

use App\Core\Abstract\Controller;
use App\Core\Auth;
use App\Core\Router;
use App\Model\Managers\MobilizationManager;

class MobilizationController extends Controller
{
  private MobilizationManager $mobilizationManager;

  public function __construct()
  {
    parent::__construct();

    //on instancie les managers directement à l'instantiation
    $this->mobilizationManager = new MobilizationManager();
  }

  /**
   * Affiche la vue listant les mobilisations
   * @return void Pas de valeur de retour
   */
  public function index(): void
  {
    $this->render('mobilizations/index', [
      'mobilizations' => $this->mobilizationManager->findAll()
    ]);
  }
}