<?php

namespace App\Providers;

class Validator
{
  private $errors = [];
  private $key;
  private $value;
  private $name;

  public function field($key, $value, $name = null)
  {
    $this->key = $key;
    $this->value = $value;
    $this->name = ucfirst($name ?? $key);
    return $this;
  }

  public function required()
  {
    if (empty($this->value)) {
      $this->errors[$this->key] = "$this->name is required.";
    }
    return $this;
  }

  public function max($length)
  {
    if (strlen($this->value) > $length) {
      $this->errors[$this->key] = "$this->name must be less than $length characters.";
    }
    return $this;
  }

  public function min($length)
  {
    if (strlen($this->value) < $length) {
      $this->errors[$this->key] = "$this->name must be more than $length characters.";
    }
    return $this;
  }

  public function int()
  {
    if (!filter_var($this->value, FILTER_VALIDATE_INT)) {
      $this->errors[$this->key] = "$this->name must be an integer.";
    }
    return $this;
  }

  public function email()
  {
    if (!empty($this->value) && !filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
      $this->errors[$this->key] = "Invalid $this->name format.";
    }
    return $this;
  }

  public function isSuccess(): bool
  {
    return empty($this->errors);
  }

  public function getErrors(): array
  {
    return $this->errors;
  }

  public function justeLettre()
  {
    if (!preg_match('/^[a-zA-ZÀ-ÿ\s]+$/u', $this->value)) {
      $this->errors[$this->key] = "$this->name ne doit contenir que des lettres.";
    }
    return $this;
  }

  public function lettreEtChiffre()
  {
    if (!preg_match('/^[a-zA-Z0-9À-ÿ\s\-_\'"?!.,;:()]+$/u', $this->value)) {
      $this->errors[$this->key] = "$this->name ne doit contenir que des lettres, chiffres ou ponctuation autorisée.";
    }
    return $this;
  }

  public function unique($model)
  {
    $model = 'App\\Models\\' . $model;
    $model = new $model;
    $unique = $model->unique($this->key, $this->value);
    if ($unique) {
      $this->errors[$this->key] = "$this->name must be unique.";
    }
    return $this;
  }
}
