import "./bootstrap";

import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";
import { Chart } from "chart.js/auto";
import * as XLSX from "xlsx";

import "@fortawesome/fontawesome-free/js/all.js";
import "@fortawesome/fontawesome-free/css/all.css";

window.Alpine = Alpine;
window.Chart = Chart;
window.XLSX = XLSX;

Alpine.plugin(collapse);

Alpine.store("darkMode", {
    on: localStorage.getItem("darkMode") === "true",
    toggle() {
        this.on = !this.on;
        localStorage.setItem("darkMode", this.on);
    },
});

Alpine.start();

const login = document.getElementById("loginBox");
const previousPage = document.referrer;

if (previousPage.includes("/login")) {
    login.style.display = "block";
    setInterval(() => {
        login.style.display = "none";
    }, 1000);
} else {
    if (login) login.style.display = "none";
}
