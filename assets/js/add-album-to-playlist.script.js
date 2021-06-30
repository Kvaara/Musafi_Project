const addToNewOrExistingPlaylistModal = document.querySelector(
  ".add-to-existing-playlist-container"
);

const newButton = document.querySelector("#add-to-new-btn");
const existingButton = document.querySelector("#add-to-existing-btn");
const chooseSongs = document.querySelector("#choose-songs-btn");

const newPlaylistContainer = document.querySelector(
  "#to-new-playlist-container"
);
const existingPlaylistContainer = document.querySelector(
  "#to-existing-playlists-container"
);

const firstStepTitle = document.querySelector("#first-step-title");
const secondStepTitle = document.querySelector("#second-step-title");
const toNewPlaylistTitle = document.querySelector("#to-new-playlist-title");
const toExistingPlaylistTitle = document.querySelector(
  "#to-existing-playlist-title"
);

const chooseSongsListContainer = document.querySelector(
  "#choose-songs-list-container"
);

const toNewPlaylistInput = document.querySelector("#to-new-playlist-input");
const toNewPlaylistBtn = document.querySelector("#add-to-new-playlist-btn");

newButton.addEventListener("click", () => {
  newButton.classList.add("active");

  existingButton.classList.remove("active");
  chooseSongs.classList.remove("active");

  existingPlaylistContainer.style.display = "none";
  newPlaylistContainer.style.display = "flex";

  secondStepTitle.style.display = "none";

  toExistingPlaylistTitle.style.fontSize = "0px";
  toExistingPlaylistTitle.style.opacity = "0";
  toNewPlaylistTitle.style.fontSize = "32px";
  toNewPlaylistTitle.style.opacity = "1";

  toNewPlaylistInput.focus();
});

existingButton.addEventListener("click", () => {
  existingButton.classList.add("active");

  newButton.classList.remove("active");
  chooseSongs.classList.remove("active");

  newPlaylistContainer.style.display = "none";
  existingPlaylistContainer.style.display = "flex";

  secondStepTitle.style.display = "none";

  toNewPlaylistTitle.style.fontSize = "0px";
  toNewPlaylistTitle.style.opacity = "0";
  toExistingPlaylistTitle.style.fontSize = "32px";
  toExistingPlaylistTitle.style.opacity = "1";
});

// Choose songs hover functionality (shows the choose songs list)
chooseSongs.addEventListener("mouseenter", () => {
  chooseSongsListContainer.style.visibility = "visible";
  chooseSongsListContainer.style.opacity = "1";
  chooseSongs.classList.add("active");
});

chooseSongs.addEventListener("mouseleave", () => {
  chooseSongsListContainer.style.visibility = "hidden";
  chooseSongsListContainer.style.opacity = "0";
  chooseSongs.classList.remove("active");
});

chooseSongsListContainer.addEventListener("mouseenter", () => {
  chooseSongsListContainer.style.visibility = "visible";
  chooseSongsListContainer.style.opacity = "1";
  chooseSongs.classList.add("active");
});

chooseSongsListContainer.addEventListener("mouseleave", () => {
  chooseSongsListContainer.style.visibility = "hidden";
  chooseSongsListContainer.style.opacity = "0";
  chooseSongs.classList.remove("active");
});

// Check and uncheck all button functionality
const chooseSongsAddBtn = document.querySelector("#choose-songs-add");
const chooseSongsAddAllBtn = document.querySelector("#choose-songs-add-all");
const listOfSongs = document.querySelector("#choose-songs-list");
const songs = [...listOfSongs.children];
let didUserChooseSongs = false;

chooseSongsAddBtn.addEventListener("click", () => {
  songs.forEach((label, index) => {
    const isChecked = label.firstChild.checked;
    if (isChecked) {
      didUserChooseSongs = true;
      newButton.style.opacity = "1";
      newButton.style.visibility = "visible";

      existingButton.style.opacity = "1";
      existingButton.style.visibility = "visible";

      firstStepTitle.style.display = "none";
      secondStepTitle.style.visibility = "visible";
      secondStepTitle.style.opacity = "1";
      secondStepTitle.style.fontSize = "32px";
    }
  });
});

let isCurrentlyChecked = false;
chooseSongsAddAllBtn.addEventListener("click", () => {
  if (!isCurrentlyChecked) {
    songs.forEach((label, index) => {
      label.firstChild.checked = true;
      isCurrentlyChecked = true;
      chooseSongsAddAllBtn.textContent = "UNCHECK ALL";
    });
  } else {
    songs.forEach((label, index) => {
      label.firstChild.checked = false;
      isCurrentlyChecked = false;
      chooseSongsAddAllBtn.textContent = "CHECK ALL";
    });
  }
});

toNewPlaylistBtn.addEventListener("click", () => {
  alert(`${toNewPlaylistInput.value} has been created!`);
  addToNewOrExistingPlaylistModal.style.display = "none";
});

const existingPlaylistsList = document.querySelector(
  "#existing-playlists-list"
);
const existingPlaylistsArray = [...existingPlaylistsList.children];

existingPlaylistsArray.forEach((playlist) => {
  const playlistInfoPopupBtn = playlist.querySelector(
    ".existing-playlists-info-popup-btn"
  );
  if (playlistInfoPopupBtn) {
    playlistInfoPopupBtn.addEventListener("click", () => {
      console.log("clicked");
    });
  }
});
