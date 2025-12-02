{{ include('layouts/header.php', { title: 'Créer un utilisateur' }) }}

<div class="container_user">


  <form action="{{ base }}/user/create" method="post" class="form__user">
    <h1>Créer un compte :</h1>
    <label for="username">
      Nom :
      <input type="text" name="username" id="username" value="{{ user.username }}">
      {% if errors.username is defined %}
      <span class="error">{{ errors.username }}</span>
      {% endif %}
    </label>

    <label for="email">
      Email :
      <input type="email" name="email" id="email" value="{{ user.email }}">
      {% if errors.email is defined %}
      <span class="error">{{ errors.email }}</span>
      {% endif %}
    </label>

    <label for="password">
      Mot de passe :
      <input type="password" name="password" id="password">
      {% if errors.password is defined %}
      <span class="error">{{ errors.password }}</span>
      {% endif %}
    </label>
    <input type="submit" value="Créer le compte">
  </form>
</div>

{{ include('layouts/footer.php') }}