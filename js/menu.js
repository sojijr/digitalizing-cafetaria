const menu = document.getElementById("menu");
const close = document.getElementById("close");
const menuBar = document.querySelector(".menubar");

menu.addEventListener("click", () => {
  menuBar.classList.contains("hidden")
    ? menuBar.classList.remove("hidden")
    : menuBar.classList.add("hidden");
});
close.addEventListener("click", () => {
  if (!menuBar.classList.contains("hidden")) {
    menuBar.classList.add("hidden");
  } else {
    menuBar.classList.remove("hidden");
  }
});
