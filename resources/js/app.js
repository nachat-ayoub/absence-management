import "./bootstrap";

import Alpine from "alpinejs";
import "@fortawesome/fontawesome-free/css/all.css";
import "@fortawesome/fontawesome-free/js/all.js";

window.Alpine = Alpine;

Alpine.store("darkMode", {
    on: localStorage.getItem("darkMode") === "true",
    toggle() {
        this.on = !this.on;
        localStorage.setItem("darkMode", this.on);
    },
});

Alpine.start();

// alert("hi Alpine.js DARK_MODE:", localStorage.getItem("darkMode") === "true");
