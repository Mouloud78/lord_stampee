{{ include('layouts/header.php', { title:'Registration' }) }}

<div style="display: flex; flex-direction:column;">
  <div class="container">

    <form method="post">
      <h2>Login</h2>

      <label>
        Votre Email
        {% if errors.email is defined %}
        <div class="field-error">{{ errors.email }}</div>
        {% endif %}
        <input type="email" name="email" value="{{ user.email }}">
      </label>

      <label>
        Votre mot de passe
        {% if errors.password is defined %}
        <div class="field-error">{{ errors.password }}</div>
        {% endif %}
        <input type="password" name="password">
      </label>

      <input type="submit" class="btn" value="login">
    </form>

  </div>
</div>
{{ include('layouts/footer.php') }}