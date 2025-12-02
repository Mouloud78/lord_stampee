class MobileNavigation {
  constructor() {
    this.burger = document.querySelector(".burger");
    this.nav = document.querySelector(".navigation-principale");
    this.menuItems = document.querySelectorAll(".navigation-principale > li");

    this.init();
  }

  init() {
    if (!this.burger || !this.nav) return;

    this.burger.addEventListener("click", (e) => {
      e.stopPropagation();
      this.toggleNav();
    });

    this.menuItems.forEach((li) => {
      const link = li.querySelector("a");

      link.addEventListener("click", (e) => {
        if (this.isMobile()) {
          const submenu = li.querySelector(".submenu");

          if (submenu) {
            e.preventDefault();
            li.classList.toggle("show-submenu");
          }
        }
      });
    });
  }

  toggleNav() {
    this.nav.classList.toggle("active");
  }

  isMobile() {
    return window.matchMedia("(max-width: 990px)").matches;
  }
}

document.addEventListener("DOMContentLoaded", () => {
  new MobileNavigation();
});
