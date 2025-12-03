<?php

namespace App\Controllers;

use App\Models\Enchere;
use App\Providers\View;

class EnchereController
{

  public function index($param = [])
  {
    // var_dump($_SESSION);

    $timbre =  new Enchere();

    View::render('enchere/index', []);
  }
}
