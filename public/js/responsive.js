function changeImage(imgElement) {
  var mainImage = document.querySelector(".main-image");
  mainImage.src = imgElement.src;
  var galleryImages = document.querySelectorAll(".timbres img");
  galleryImages.forEach(function (image) {
    image.classList.remove("active");
  });
  imgElement.classList.add("active");
}

// ouverture/fermeture du menu mobile
const burger = document.querySelector(".burger");
const nav = document.querySelector(".navigation-principale");

burger.addEventListener("click", () => {
  nav.classList.toggle("active");
});

// gestion des sous-menus sur mobile
document.querySelectorAll(".navigation-principale > li").forEach((li) => {
  li.addEventListener("click", (e) => {
    if (window.matchMedia("(max-width: 974px)").matches) {
      e.stopPropagation();
      li.classList.toggle("show-submenu");
    }
  });
});
