{{ include('layouts/header.php', { title:'Connexion' }) }}

<div style="display: flex; flex-direction:column;">
  <div class="container">

    <form method="post" class="form__user">
      <h2>Connexion</h2>

      <label>
        Votre Email

        <input type="email" name="email" value="{{ user.email }}">
        {% if errors.email is defined %}
        <div class="error">{{ errors.email }}</div>
        {% endif %}
      </label>

      <label>
        Votre mot de passe

        <input type="password" name="password">
        {% if errors.password is defined %}
        <div class="error">{{ errors.password }}</div>
        {% endif %}
      </label>

      <input type="submit" class="btn" value="login">
    </form>

  </div>
</div>
{{ include('layouts/footer.php') }}