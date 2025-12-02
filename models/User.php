<?php

namespace App\Models;

use App\Models\CRUD;


class User extends CRUD
{

  protected $table = 'users';
  protected $primaryKey = 'user_id';
  protected $fillable = ['username', 'email', 'password', 'create_at'];

  public function hashPassword($password, $cost = 10)
  {
    $options = [
      'cost' => $cost
    ];

    return password_hash($password, PASSWORD_BCRYPT, $options);
  }

  public function checkUser($email, $password)
  {
    $user = $this->unique('email', $email);

    if (!$user) {
      return 'email_non_trouve';
    }

    if (!password_verify($password, $user['password'])) {
      return 'password_incorrect';
    }

    session_regenerate_id(true);
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);

    return 'success';
  }

  public static function logout()
  {
    session_unset();
    session_destroy();
    header('Location: /');
    exit;
  }
}
