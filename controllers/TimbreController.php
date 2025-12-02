<?php

namespace App\Controllers;

use App\Models\Timbre;
use App\Providers\View;

class TimbreController
{

  public function index($param = [])
  {
    // var_dump($_SESSION);

    $timbre =  new Timbre();

    View::render('timbre/index', []);
  }
}
