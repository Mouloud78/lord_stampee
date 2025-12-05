<?php

namespace App\Controllers;

use App\Models\Timbre;
use App\Models\Categorie;
use App\Models\Etat;
use App\Models\Pays;
use App\Models\User;
use App\Providers\Auth;
use App\Providers\View;
use App\Providers\Validator;

class TimbreController
{

  public function create()
  {
    Auth::session();
    $categorie = new Categorie();
    $selectCat = $categorie->select('nom');
    $pays = new Pays();
    $selectPays = $pays->select('nom');
    $etat = new Etat();
    $selectEtat = $etat->select('nom');
    $user = $_SESSION['user_id'];

    return View::render("timbre/create", ["categorie" => $selectCat, "pays" => $selectPays, "etat" => $selectEtat]);
  }

  public function store($postData = [], $fileData = [])
  {
    $user_id = $_SESSION['user_id'];

    if (empty($postData['categorie_id'])) {

      $categorie = new Categorie();
      $selectCat = $categorie->select('nom');

      return View::render("timbre/create", [
        "categorie" => $selectCat,
        "error" => "Veuillez sélectionner une catégorie.",
        "timbre" => $postData
      ]);
    }

    if (empty($postData['pays_id'])) {

      $pays = new Pays();
      $selectPays = $pays->select('nom');

      return View::render("timbre/create", [
        "pays" => $selectPays,
        "error" => "Veuillez sélectionner le pays.",
        "timbre" => $postData
      ]);
    }

    if (empty($postData['etat_id'])) {

      $etat = new Etat();
      $selectEtat = $etat->select('nom');

      return View::render("timbre/create", [
        "etat" => $selectEtat,
        "error" => "Veuillez sélectionner l'etat du timbre.",
        "timbre" => $postData
      ]);
    }

    $imagePath = null;
    if (isset($fileData['image_principale']) && $fileData['image_principale']['error'] === UPLOAD_ERR_OK) {
      // chemin physique
      $uploadDir = trim(UPLOAD, '/') . '/';

      if (!file_exists($uploadDir)) mkdir($uploadDir, 0755, true);

      // Nom du fichier
      $imageName = uniqid() . '_' . basename($fileData['image_principale']['name']);

      // Déplacer le fichier
      if (move_uploaded_file($fileData['image']['tmp_name'], $uploadDir . $imageName)) {
        // Chemin pour la BDD 
        $imagePath = trim(UPLOAD, '/') . '/' . $imageName;
      } else {
        // Gestion d'erreur 
        $imagePath = null;
      }
    }

    $data = [
      'nom' => $postData['nom'],
      'categorie_id' => $postData['categorie_id'],
      'pays_id' => $postData['pays_id'],
      'etat_id' => $postData['etat_id'],
      'user_id' => $user_id,
      'imageprincipale' => $imagePath,
      'couleur' => $postData['couleur'],
      'dimention' => $postData['dimention'],
      'certifie' => $postData['certifie'],
      'create_at' => date('Y-m-d H:i:s')
    ];

    $timbre = new Timbre();
    $insert = $timbre->insert($data);

    if ($insert) {
      header("Location: " . BASE . "/enchere");
      exit;
    } else {
      $categorie = new Categorie();
      $selectCat = $categorie->select('nom');
      $pays =  new Pays();
      $selectPays = $pays->select('nom');
      $etat = new Etat();
      $selectEtat = $etat->select('nom');

      return View::render("timbre/create", [
        "categorie" => $selectCat,
        "pays" => $selectPays,
        "etat" => $selectEtat,
        "error" => "Erreur lors de l'insertion dans la base de données.",
        "timbre" => $data
      ]);
    }
  }
}
