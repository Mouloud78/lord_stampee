<?php

namespace App\Models;

use App\Models\CRUD;
use PDO;


class Categorie extends CRUD
{
  protected $table = 'categorie';
  protected $primaryKey = 'categorie_id';
  protected $fillable = ['nom'];

  public function selectCategorie($order = 'ASC', $orderBy = 'nom')
  {
    $allowedOrders = ['ASC', 'DESC'];
    $order = strtoupper($order);
    if (!in_array($order, $allowedOrders)) {
      $order = 'ASC';
    }
    if (!in_array($orderBy, $this->fillable)) {
      $orderBy = $this->primaryKey;
    }

    $sql = "
        SELECT * 
        FROM {$this->table}
        ORDER BY {$orderBy} {$order}
    ";

    $stmt = $this->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
