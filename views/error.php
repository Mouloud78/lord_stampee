{{ include('layouts/header.php', { title: 'Erreur' }) }}

<div class="container_error" style="text-align: center; margin: 100px auto; max-width: 600px;">
  <h1 style="font-size: 3em; color: #e74c3c;">Erreur</h1>

  <p style="font-size: 1.2em; color: #333;">
    {% if msg %}
    {{ msg }}
    {% else %}
    Une erreur inattendue s'est produite.
    {% endif %}
  </p>

  <a href="{{ base }}/"
    style="display: inline-block; margin-top: 20px; padding: 10px 20px; 
            background: #3498db; color: white; text-decoration: none; border-radius: 4px;">
    Retour à l'accueil
  </a>
</div>

{{ include('layouts/footer.php') }}