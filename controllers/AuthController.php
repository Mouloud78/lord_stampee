<?php

namespace App\Controllers;

use App\Models\User;
use App\Providers\View;
use App\Providers\Validator;

class AuthController
{

  public function index()
  {
    return View::render('auth/index');
  }

  public function store($data)
  {
    $validator = new Validator;

    $validator
      ->field('email', $data['email'])
      ->email()
      ->max(45)
      ->required();

    if (!isset($validator->getErrors()['email'])) {
      $validator
        ->field('password', $data['password'])
        ->min(6)
        ->max(40)
        ->required()
        ->checkPassword('email', 'password');
    }


    if (!$validator->isSuccess()) {
      $errors = $validator->getErrors();
      return View::render('auth/index', ['errors' => $errors, 'user' => $data]);
    }


    $user = new User();
    $user->checkUser($data['email'], $data['password']);

    // return View::redirect('/encheres');
    return View::render('enchere/index', [
      'title' => 'Connexion utilisateur',
      'successMessage' => 'Connexion réussie !',
      'base' => BASE
    ]);
  }

  public function delete()
  {
    session_unset();
    session_destroy();
    // return View::redirect('/');
    return View::render('enchere/index', [
      'title' => 'Déconnexion utilisateur',
      'successMessage' => 'Déconnexion réussie !',
      'base' => BASE
    ]);
  }
}
