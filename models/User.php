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

  public function checkUser($username, $password)
  {

    $user = $this->unique('email', $username);
    if ($user) {

      if (password_verify($password, $user['password'])) {
        session_regenerate_id();

        $_SESSION['user_id'] = $user['user_id'];

        $_SESSION['email'] = $user['email'];
        // $_SESSION['privilege_id'] = $user['privilege_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  public static function logout()
  {
    session_unset();
    session_destroy();
    header('Location: /');
    exit;
  }
}
