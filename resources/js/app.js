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

var login = document.getElementById("loginBox");
var previousPage = document.referrer;
if (previousPage.includes("/login")) {
    login.style.display = "block";
    setInterval(() => {
        login.style.display = "none";
    }, 1000);
} else {
    login.style.display = "none";
}
