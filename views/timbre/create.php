{{ include('layouts/header.php', { title: "Créer un timbre" }) }}

<div class="timbre-form-page">

  <div class="timbre-form-wrapper">

    <h1 class="timbre-title">Créer un nouveau Timbre</h1>

    {% if error %}
    <div class="error">{{ error }}</div>
    {% endif %}

    <form class="timbre-form" action="{{ base }}/timbre/create" method="post" enctype="multipart/form-data">

      <label>
        Nom du timbre :
        <input type="text" name="nom" value="{{ timbre.nom ?? '' }}" required>
      </label>

      <label>
        Catégorie :
        <select name="categorie_id" required>
          <option value="">Sélectionner une catégorie</option>
          {% for c in categorie %}
          <option value="{{ c.id }}" {% if timbre and timbre.categorie_id == c.id %}selected{% endif %}>{{ c.nom }}</option>

          {% endfor %}
        </select>
      </label>

      <label>
        Pays :
        <select name="pays_id" required>
          <option value="">Sélectionner un pays</option>
          {% for p in pays %}
          <option
            value="{{ p.id }}"
            {% if timbre and timbre.pays_id == p.id %}selected{% endif %}>
            {{ p.nom }}
          </option>
          {% endfor %}
        </select>
      </label>


      <label>
        État :
        <select name="etat_id" required>
          <option value="">Sélectionner un état</option>
          {% for e in etat %}
          <option
            value="{{ e.id }}"
            {% if timbre and timbre.etat_id == e.id %}selected{% endif %}>
            {{ e.nom }}
          </option>
          {% endfor %}
        </select>
      </label>


      <label>
        Couleur :
        <input type="text" name="couleur" value="{{ timbre.couleur ?? '' }}" required>
      </label>

      <label>
        Dimension :
        <input type="text" name="dimention" value="{{ timbre.dimention ?? '' }}" required>
      </label>

      <label>
        Certifié :
        <select name="certifie" required>
          <option value="">Certifié ?</option>
          <option value="1" {% if timbre.certifie == 1 %}selected{% endif %}>Oui</option>
          <option value="0" {% if timbre.certifie == 0 %}selected{% endif %}>Non</option>
        </select>
      </label>

      <label>
        Image principale :
        <input type="file" name="image_principale" accept="image/*">
      </label>

      <input type="submit" value="Créer le timbre">

    </form>

  </div>

</div>

{{ include('layouts/footer.php') }}