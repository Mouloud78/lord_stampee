<?php

namespace App\Controllers;

use App\Models\Timbre;
use App\Providers\View;

class TimbreController
{

  public function index($param = [])
  {
    $timbre =  new Timbre();

    View::render('timbre/index', []);
  }
}
