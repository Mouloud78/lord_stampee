<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Privilege;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

class UserController
{

  public function index()
  {

    $user = new User;
    $selectUser = $user->select();

    return View::render('user/index', [
      'title' => 'Liste des utilisateurs',
      'users' => $selectUser
    ]);
  }

  public function create()
  {
    return View::render('user/create', [
      'title' => 'Créer un utilisateur',
      'base'  => BASE,
    ]);
  }

  public function store($postData = [])
  {

    $validator = new Validator();
    $validator->field('username', $postData['username'])->min(2)->max(50)->required();
    $validator->field('email', $postData['email'])
      ->email()
      ->unique('User')
      ->required()
      ->max(45);

    $validator->field('password', $postData['password'])->min(6)->max(40)->required();

    if (!$validator->isSuccess()) {
      $errors = $validator->getErrors();
      return View::render('user/create', [
        'title' => 'Créer un utilisateur',
        'errors' => $errors,
        'user' => $postData
      ]);
    }

    $user = new User();
    $hashedPassword = $user->hashPassword($postData['password']);

    $data = [
      'username' => $postData['username'],
      'email' => $postData['email'],
      'password' => $hashedPassword,
      'create_at' => date('Y-m-d H:i:s')
    ];

    $insert = $user->insert($data);
    if ($insert) {
      return View::render('enchere/index', [
        'title' => 'Créer un utilisateur',
        'successMessage' => 'Utilisateur créé avec succès !',
        'base' => BASE
      ]);
    } else {
      return View::render('user/create', [
        'title' => 'Créer un utilisateur',
        'error' => "Erreur lors de l'insertion dans la base de données.",
        'user' => $postData
      ]);
    }
  }
}
