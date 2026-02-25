<?php

namespace App\Controllers;

use App\Core\Abstract\Controller;

class PageController extends Controller
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
