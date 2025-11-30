<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Log;
use App\Providers\View;
use App\Providers\Validator;

class AuthController
{

  public function index()
  {
    return View::render('auth/index');
  }
}
