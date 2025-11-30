<?php

namespace App\Providers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class View
{
  public static function render(string $template, array $data = []): void
  {
    // Chemin absolu vers le dossier des vues
    $loader = new FilesystemLoader(__DIR__ . '/../views');

    $twig = new Environment($loader, [
      'cache' => false,
      'autoescape' => 'html',
    ]);

    // Variables globales disponibles dans tous les templates
    $twig->addGlobal('asset', ASSET);
    $twig->addGlobal('base', BASE);
    $twig->addGlobal('session', $_SESSION);
    if (isset($_SESSION['fingerPrint']) and $_SESSION['fingerPrint'] == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'])) {
      $guest = false;
    } else {
      $guest = true;
    }
    $twig->addGlobal('guest', $guest);

    // Si le template ne finit pas par .php, on l’ajoute
    if (!str_ends_with($template, '.php')) {
      $template .= '.php';
    }

    // Rendu Twig
    echo $twig->render($template, $data);
  }

  public static function redirect(string $url): void
  {
    header('Location: ' . BASE . '/' . ltrim($url, '/'));
    exit;
  }
}
