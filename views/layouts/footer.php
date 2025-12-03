<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
<footer class="footer">
  <p>&copy; 2025 Lord Stampee. Tous droits réservés.</p>
</footer>

{% if successMessage is defined %}
<script type="module">
  import ToastSucces from "{{asset}}js/ToastSucces.js";

  document.addEventListener("DOMContentLoaded", function() {
    const conteneurHTML = document.body;
    const message = "{{ successMessage }}";
    new ToastSucces(conteneurHTML, message);
  });
</script>
{% endif %}