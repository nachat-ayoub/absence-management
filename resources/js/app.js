import "./bootstrap";

import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";
import { Chart } from "chart.js/auto";
import * as XLSX from "xlsx";

import "@fortawesome/fontawesome-free/js/all.js";
import "@fortawesome/fontawesome-free/css/all.css";

window.Chart = Chart;
window.XLSX = XLSX;





window.Alpine = Alpine;

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



// dark  mode for pagination  in  md and lg  and xl  screens

var linksDiv = document.querySelector('.pagination-container nav div:nth-child(2) div:nth-child(2) span');
var innerDiv = linksDiv.querySelectorAll('span');
var innerDivForA = linksDiv.querySelectorAll('a');
innerDiv.forEach(function (element) {
    element.classList.add('dark:bg-gray-800', 'dark:text-gray-200');
});
innerDivForA.forEach(function (element) {
    element.classList.add('dark:bg-gray-800', 'dark:text-gray-200');
});

//dark  mode in sm screen

document.querySelector('.pagination-container nav div:nth-child(1) span').classList.add('dark:bg-gray-800', 'dark:text-gray-200');
document.querySelector('.pagination-container nav div:nth-child(1) a').classList.add('dark:bg-gray-800', 'dark:text-gray-200');