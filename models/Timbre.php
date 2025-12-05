<?php

namespace App\Models;

use App\Models\CRUD;
use App\Providers\Auth;
use PDO;

class Timbre extends CRUD
{

  protected $table = "timbres";
  protected $primaryKey = "timbre_id";
  protected $fillable = ["nom", "cteate_at", "couleur", "image_principale", "dimention", 'certifie', "tirage", "etat_id", "pays_id", "categorie_id", "user_id"];
}
