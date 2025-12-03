import Toast from "./Toast.js";

class ToastSucces extends Toast {
  constructor(conteneurHTML, message) {
    super(conteneurHTML, message);
  }

  injecterHTML() {
    const gabarit = `<div class="toast succes" data-toast><i class="fas fa-check-circle toast-icon"></i> ${this.message}</div>`;

    this._conteneurHTML.insertAdjacentHTML("beforeend", gabarit);
    this._elementHTML = this._conteneurHTML.lastElementChild;

    this._elementHTML.addEventListener("click", this.cacher.bind(this));
    setTimeout(this.cacher.bind(this), 2000);
  }
}

export default ToastSucces;
