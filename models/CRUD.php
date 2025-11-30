<?php

namespace App\Models;

abstract class CRUD extends \PDO
{

  final public function __construct()
  {
    parent::__construct('mysql:host=localhost;dbname=lord_reginal_stampee; port=3306; charset=utf8', 'root', 'root');
  }

  final public function select($field = null, $order = 'ASC')
  {
    if ($field == null) {
      $field = $this->primaryKey;
    }
    $sql = "SELECT * FROM $this->table ORDER BY $field $order";
    // return  $sql;
    $stmt = $this->query($sql);
    return $stmt->fetchAll();
  }



  final public function selectId($value)
  {
    $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = :$this->primaryKey";
    $stmt = $this->prepare($sql);
    $stmt->bindValue(":$this->primaryKey", $value);
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($count == 1) {
      return $stmt->fetch();
    } else {
      return false;
    }
  }

  final public function insert($data)
  {

    $data_keys = array_fill_keys($this->fillable, '');
    $data = array_intersect_key($data, $data_keys);

    $fieldName = implode(', ', array_keys($data));
    $fieldValue = ":" . implode(', :', array_keys($data));
    $sql = "INSERT INTO $this->table ($fieldName) VALUES ($fieldValue)";

    $stmt = $this->prepare($sql);
    foreach ($data as $key => $value) {
      $stmt->bindValue(":$key", $value);
    }
    $stmt->execute();

    return $this->lastInsertId();
  }

  public function update($data, $id)
  {
    // Vérification basique
    if (empty($id)) {
      throw new \Exception("L'ID pour la mise à jour est manquant.");
    }

    // On garde uniquement les champs autorisés
    $data_keys = array_fill_keys($this->fillable, '');
    $data = array_intersect_key($data, $data_keys);

    if (empty($data)) {
      throw new \Exception("Aucune donnée valide à mettre à jour.");
    }

    // Construction du SQL dynamique
    $fieldName = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));

    $sql = "UPDATE {$this->table} SET {$fieldName} WHERE {$this->primaryKey} = :id";

    $stmt = $this->prepare($sql);

    // Lier les valeurs
    foreach ($data as $key => $value) {
      $stmt->bindValue(":{$key}", $value);
    }
    $stmt->bindValue(":id", $id);

    // Exécution
    $success = $stmt->execute();

    return $success;
  }

  public function delete($value)
  {


    $sql = "DELETE FROM $this->table WHERE $this->primaryKey = :$this->primaryKey";
    $stmt = $this->prepare($sql);
    $stmt->bindValue("$this->primaryKey", $value);
    $stmt->execute();
    if ($stmt) {
      return true;
    } else {
      return false;
    }
  }

  public function unique($field, $value)
  {
    $sql = "SELECT * FROM $this->table WHERE $field = :$field";
    $stmt = $this->prepare($sql);
    $stmt->bindValue(":$field", $value);
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($count == 1) {
      return $stmt->fetch();
    } else {
      return false;
    }
  }
}
