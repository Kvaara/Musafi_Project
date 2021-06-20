const volumeControlBar = document.querySelector("#volume-control-bar");

const volumeControlButton = document.querySelector("#volume-control-btn");

volumeControlBar.addEventListener("mouseenter", () => {
  volumeControlButton.style.transition = "all 200ms ease-in-out";
  volumeControlButton.style.transform = "scale(1.2)";
});

volumeControlBar.addEventListener("mouseleave", () => {
  volumeControlButton.style.transform = "scale(1.0)";
});

const navBarHome = document.querySelector("#nav-bar-home");
const navBarSearch = document.querySelector("#nav-bar-search");
const navBarBrowse = document.querySelector("#nav-bar-browse");
const navBarMymusic = document.querySelector("#nav-bar-mymusic");
const navBarSettings = document.querySelector("#nav-bar-settings");

const currentPage = window.location.href;

if (currentPage.includes("index.php") || currentPage.slice(-1) === "/") {
  navBarHome.firstElementChild.style.filter =
    "invert(99%) sepia(78%) saturate(2%) hue-rotate(7deg) brightness(112%) contrast(100%)";
  navBarHome.style.boxShadow = "inset 5px 0px 0px #6f0000";
  // navBarHome.style.borderBottom = "2px solid #6f0000";
} else if (currentPage.includes("search.php")) {
  navbarSearch.firstElementChild.style.filter =
    "invert(99%) sepia(78%) saturate(2%) hue-rotate(7deg) brightness(112%) contrast(100%)";
  navbarSearch.style.boxShadow = "inset 5px 0px 0px #6f0000";
} else if (currentPage.includes("browse.php")) {
  navBarBrowse.firstElementChild.style.filter =
    "invert(99%) sepia(78%) saturate(2%) hue-rotate(7deg) brightness(112%) contrast(100%)";
  navBarBrowse.style.boxShadow = "inset 5px 0px 0px #6f0000";
} else if (currentPage.includes("mymusic.php")) {
  navBarMymusic.firstElementChild.style.filter =
    "invert(99%) sepia(78%) saturate(2%) hue-rotate(7deg) brightness(112%) contrast(100%)";
  navBarMymusic.style.boxShadow = "inset 5px 0px 0px #6f0000";
} else if (currentPage.includes("settings.php")) {
  navBarSettings.firstElementChild.style.filter =
    "invert(99%) sepia(78%) saturate(2%) hue-rotate(7deg) brightness(112%) contrast(100%)";
  navBarSettings.style.boxShadow = "inset 5px 0px 0px #6f0000";
}
