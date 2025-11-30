<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="{{ asset }}css/style.css">
  <title>{{ title ?? 'Lord Stampee' }}</title>
</head>

<body>
  <header>
    <nav class="navigation">
      <div class="logo">
        <a class="logo_accueil" href="{{BASE}}/">
          <img
            src="{{asset}}img/logo.webp"
            alt="Catalogue des Enchères"
            loading="lazy" />
        </a>
      </div>
      <button class="burger" aria-label="Menu mobile">☰</button>

      <ul class="navigation-principale">
        {% if session.username is defined %}
        <li class="nav-username">

          Bonjour :
          <span>
            {{ session.username }}
          </span>

        </li>
        {% endif %}

        <li><a href="{{BASE}}/">Accueil</a></li>
        <li>
          <a href="{{BASE}}/enchere">Enchères</a>
          <ul class="submenu" aria-haspopup="true" aria-expanded="false">
            <li><a href="{{BASE}}/enchere-encours">Enchères en cours</a></li>
            <li><a href="{{BASE}}/enchere-archive">Enchères archivées</a></li>
          </ul>
        </li>

        <li>
          <a href="#">À propos</a>
          <ul class="submenu" aria-haspopup="true" aria-expanded="false">
            <li><a href="{{BASE}}/histoire">Histoire de la collection</a></li>
            <li><a href="lord">Lord Reginald Stampee</a></li>
          </ul>
        </li>
        <li>
          <a href="#">Aide</a>
          <ul class="submenu" aria-haspopup="true" aria-expanded="false">
            <li><a href="{{BASE}}/participer">Comment participer</a></li>
            <li><a href="{{BASE}}/suivre-enchere">Suivre une enchère</a></li>
            <li><a href="{{BASE}}/trouver-enchere">Trouver une enchère</a></li>
          </ul>
        </li>
        <li>
          <a href="#">Mon compte</a>
          <ul class="submenu" aria-haspopup="true" aria-expanded="false">

            {% if guest == false %}

            <li><a href="{{BASE}}/logout">Se déconnecter</a></li>
            <li><a href="{{BASE}}/profil">Mon profil</a></li>

            {% else %}

            <li><a href="{{BASE}}/login">Se connecter</a></li>
            <li><a href="{{BASE}}/user/create">S'inscrire</a></li>
            {% endif %}

            <li>
              <a href="#">Paramètres</a>
              <ul class="submenu" aria-haspopup="true" aria-expanded="false">
                <li><a href="{{BASE}}/enchere-suivie">Enchères suivies</a></li>
                <li><a href="{{BASE}}/interets">Intérêts</a></li>
                <li><a href="{{BASE}}/preferences">Préférences</a></li>
              </ul>
            </li>

          </ul>
        </li>

        <li><a href="{{BASE}}/contact">Contact</a></li>
      </ul>
    </nav>
  </header>
  <main class="timbre__container">


  </main>