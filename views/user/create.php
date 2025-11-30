{{ include('layouts/header.php', { title: 'Créer un utilisateur' }) }}

<div class="container_user">
  {% if errors is defined %}
  <div class="error">
    <ul>
      {% for error in errors %}
      <li>{{ error }}</li>
      {% endfor %}
    </ul>
  </div>
  {% endif %}


  <form action="{{ base }}/user/create" method="post" class="form__user">
    <h1>Créer votre compte :</h1>
    {% if errors.username is defined %}
    <span class="error">{{ errors.username }}</span>
    {% endif %}
    <label for="username">
      Nom :
      <input type="text" name="username" id="username" required>
    </label>

    {% if errors.email is defined %}
    <span class="error">{{ errors.email }}</span>
    {% endif %}
    <label for="email">
      Email :
      <input type="email" name="email" id="email" required>
    </label>

    {% if errors.password is defined %}
    <span class="error">{{ errors.password }}</span>
    {% endif %}
    <label for="password">
      Mot de passe :
      <input type="password" name="password" id="password" required>
    </label>
    <input type="submit" value="Créer le compte">
  </form>
</div>

{{ include('layouts/footer.php') }}