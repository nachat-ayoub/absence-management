import "./bootstrap";

import Alpine from "alpinejs";
import "@fortawesome/fontawesome-free/css/all.css";
import "@fortawesome/fontawesome-free/js/all.js";
import { Chart } from "chart.js/auto";

window.Alpine = Alpine;
window.Chart = Chart;

Alpine.store("darkMode", {
    on: localStorage.getItem("darkMode") === "true",
    toggle() {
        this.on = !this.on;
        localStorage.setItem("darkMode", this.on);
    },
});

Alpine.start();

setTimeout(() => {
    document.getElementById("loginBox").style.display = "none";
}, 1000);
