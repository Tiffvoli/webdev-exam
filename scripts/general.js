"use strict";
const year = new Date().getFullYear();

startSite();
function startSite() {
  document.querySelector(".year").textContent = year;
}
