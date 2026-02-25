<?php

namespace App\Controllers;

use App\Core\Abstract\Controller;

class PagesController extends Controller
{
  /**
   * Affiche la vue de la home
   * @return void Pas de valeur de retour
   */
  public function home(): void
  {
    $this->render('pages/home', []);
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
}
