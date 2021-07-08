// let userSignedIn;

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
const navBarMymusic = document.querySelector("#nav-bar-your-music");
const navBarUploadMusic = document.querySelector("#nav-bar-upload-music");
const navBarSettings = document.querySelector("#nav-bar-settings");

const currentPage = window.location.href;

console.log(currentPage);

if (currentPage.includes("index.php") || currentPage.slice(-1) === "/") {
  navBarHome.firstElementChild.style.filter =
    "invert(99%) sepia(78%) saturate(2%) hue-rotate(7deg) brightness(112%) contrast(100%)";
  navBarHome.style.boxShadow = "inset 4px 0px 0px #6f0000";
} else if (currentPage.includes("search.php")) {
  navbarSearch.firstElementChild.style.filter =
    "invert(99%) sepia(78%) saturate(2%) hue-rotate(7deg) brightness(112%) contrast(100%)";
  navbarSearch.style.boxShadow = "inset 4px 0px 0px #6f0000";
} else if (currentPage.includes("browse.php")) {
  navBarBrowse.firstElementChild.style.filter =
    "invert(99%) sepia(78%) saturate(2%) hue-rotate(7deg) brightness(112%) contrast(100%)";
  navBarBrowse.style.boxShadow = "inset 4px 0px 0px #6f0000";
} else if (currentPage.includes("mymusic.php")) {
  navBarMymusic.firstElementChild.style.filter =
    "invert(99%) sepia(78%) saturate(2%) hue-rotate(7deg) brightness(112%) contrast(100%)";
  navBarMymusic.style.boxShadow = "inset 4px 0px 0px #6f0000";
} else if (currentPage.includes("settings.php")) {
  navBarSettings.firstElementChild.style.filter =
    "invert(99%) sepia(78%) saturate(2%) hue-rotate(7deg) brightness(112%) contrast(100%)";
  navBarSettings.style.boxShadow = "inset 4px 0px 0px #6f0000";
} else if (currentPage.includes("upload.php")) {
  navBarUploadMusic.firstElementChild.style.filter =
    "invert(99%) sepia(78%) saturate(2%) hue-rotate(7deg) brightness(112%) contrast(100%)";
  navBarUploadMusic.style.boxShadow = "inset 4px 0px 0px #6f0000";
}

navBarHome.addEventListener("click", () => {
  openPage("index.php");
  resetAllNavbarItemStyles(() => {
    navBarHome.firstElementChild.style.filter =
      "invert(99%) sepia(78%) saturate(2%) hue-rotate(7deg) brightness(112%) contrast(100%)";
    navBarHome.style.boxShadow = "inset 4px 0px 0px #6f0000";
  });
});

// navbarSearch.addEventListener("click", () => {});

navBarBrowse.addEventListener("click", () => {
  openPage("browse.php");
  resetAllNavbarItemStyles(() => {
    navBarBrowse.firstElementChild.style.filter =
      "invert(99%) sepia(78%) saturate(2%) hue-rotate(7deg) brightness(112%) contrast(100%)";
    navBarBrowse.style.boxShadow = "inset 4px 0px 0px #6f0000";
  });
});

navBarMymusic.addEventListener("click", () => {
  openPage("mymusic.php");
  resetAllNavbarItemStyles(() => {
    navBarMymusic.firstElementChild.style.filter =
      "invert(99%) sepia(78%) saturate(2%) hue-rotate(7deg) brightness(112%) contrast(100%)";
    navBarMymusic.style.boxShadow = "inset 4px 0px 0px #6f0000";
  });
});

navBarUploadMusic.addEventListener("click", () => {
  openPage("upload.php");
  resetAllNavbarItemStyles(() => {
    navBarUploadMusic.firstElementChild.style.filter =
      "invert(99%) sepia(78%) saturate(2%) hue-rotate(7deg) brightness(112%) contrast(100%)";
    navBarUploadMusic.style.boxShadow = "inset 4px 0px 0px #6f0000";
  });
});

// navBarSettings.addEventListener("click", () => {
//   openPage("settings.php");
// });

// Opens a page seamlessly (doesn't refresh the whole page or reset the current song)
const openPage = (url) => {
  if (url.indexOf("?") === -1) {
    url = url + "?";
  }

  const encodedUrl = encodeURI(url + "&userSignedIn=" + userSignedIn);
  $("#application-page").load(encodedUrl);
  window.scrollTo(0, 0);
  window.history.pushState(undefined, undefined, url);
};

const resetAllNavbarItemStyles = (callback) => {
  navBarHome.firstElementChild.style.filter = "";
  navBarHome.style.boxShadow = "";
  navBarSearch.firstElementChild.style.filter = "";
  navBarSearch.style.boxShadow = "";
  navBarBrowse.firstElementChild.style.filter = "";
  navBarBrowse.style.boxShadow = "";
  navBarMymusic.firstElementChild.style.filter = "";
  navBarMymusic.style.boxShadow = "";
  navBarUploadMusic.firstElementChild.style.filter = "";
  navBarUploadMusic.style.boxShadow = "";
  navBarSettings.firstElementChild.style.filter = "";
  navBarSettings.style.boxShadow = "";
  return callback();
};
