// const addToNewOrExistingPlaylistModal = document.querySelector(
//   ".add-to-existing-playlist-container"
// );

// const newButton = document.querySelector("#add-to-new-btn");
// const existingButton = document.querySelector("#add-to-existing-btn");
// const chooseSongs = document.querySelector("#choose-songs-btn");

// const newPlaylistContainer = document.querySelector(
//   "#to-new-playlist-container"
// );
// const existingPlaylistContainer = document.querySelector(
//   "#to-existing-playlists-container"
// );

// const firstStepTitle = document.querySelector("#first-step-title");
// const secondStepTitle = document.querySelector("#second-step-title");
// const toNewPlaylistTitle = document.querySelector("#to-new-playlist-title");
// const toExistingPlaylistTitle = document.querySelector(
//   "#to-existing-playlist-title"
// );

// const chooseSongsListContainer = document.querySelector(
//   "#choose-songs-list-container"
// );

// const toNewPlaylistInput = document.querySelector("#to-new-playlist-input");
// const toNewPlaylistBtn = document.querySelector("#add-to-new-playlist-btn");

// newButton.addEventListener("click", () => {
//   newButton.classList.add("active");

//   existingButton.classList.remove("active");
//   chooseSongs.classList.remove("active");

//   existingPlaylistContainer.style.display = "none";
//   newPlaylistContainer.style.display = "flex";

//   secondStepTitle.style.display = "none";

//   toExistingPlaylistTitle.style.fontSize = "0px";
//   toExistingPlaylistTitle.style.opacity = "0";
//   toNewPlaylistTitle.style.fontSize = "32px";
//   toNewPlaylistTitle.style.opacity = "1";

//   toNewPlaylistInput.focus();
// });

// existingButton.addEventListener("click", () => {
//   existingButton.classList.add("active");

//   newButton.classList.remove("active");
//   chooseSongs.classList.remove("active");

//   newPlaylistContainer.style.display = "none";
//   existingPlaylistContainer.style.display = "flex";

//   secondStepTitle.style.display = "none";

//   toNewPlaylistTitle.style.fontSize = "0px";
//   toNewPlaylistTitle.style.opacity = "0";
//   toExistingPlaylistTitle.style.fontSize = "32px";
//   toExistingPlaylistTitle.style.opacity = "1";
// });

// Choose songs hover functionality (shows the choose songs list)
// chooseSongs.addEventListener("mouseenter", () => {
//   chooseSongsListContainer.style.visibility = "visible";
//   chooseSongsListContainer.style.opacity = "1";
//   chooseSongs.classList.add("active");
// });

// chooseSongs.addEventListener("mouseleave", () => {
//   chooseSongsListContainer.style.visibility = "hidden";
//   chooseSongsListContainer.style.opacity = "0";
//   chooseSongs.classList.remove("active");
// });

// chooseSongsListContainer.addEventListener("mouseenter", () => {
//   chooseSongsListContainer.style.visibility = "visible";
//   chooseSongsListContainer.style.opacity = "1";
//   chooseSongs.classList.add("active");
// });

// chooseSongsListContainer.addEventListener("mouseleave", () => {
//   chooseSongsListContainer.style.visibility = "hidden";
//   chooseSongsListContainer.style.opacity = "0";
//   chooseSongs.classList.remove("active");
// });

// Check and uncheck all button functionality
// const chooseSongsAddBtn = document.querySelector("#choose-songs-add");
// const chooseSongsAddAllBtn = document.querySelector("#choose-songs-add-all");
// const listOfSongs = document.querySelector("#choose-songs-list");
// const songs = [...listOfSongs.children];
// let didUserChooseSongs = false;

// chooseSongsAddBtn.addEventListener("click", () => {
//   songs.forEach((label, index) => {
//     const isChecked = label.firstChild.checked;
//     if (isChecked) {
//       didUserChooseSongs = true;
//       newButton.style.opacity = "1";
//       newButton.style.visibility = "visible";

//       existingButton.style.opacity = "1";
//       existingButton.style.visibility = "visible";

//       firstStepTitle.style.display = "none";
//       secondStepTitle.style.visibility = "visible";
//       secondStepTitle.style.opacity = "1";
//       secondStepTitle.style.fontSize = "32px";
//     }
//   });
// });

// let isCurrentlyChecked = false;
// chooseSongsAddAllBtn.addEventListener("click", () => {
//   if (!isCurrentlyChecked) {
//     songs.forEach((label, index) => {
//       label.firstChild.checked = true;
//       isCurrentlyChecked = true;
//       chooseSongsAddAllBtn.textContent = "UNCHECK ALL";
//     });
//   } else {
//     songs.forEach((label, index) => {
//       label.firstChild.checked = false;
//       isCurrentlyChecked = false;
//       chooseSongsAddAllBtn.textContent = "CHECK ALL";
//     });
//   }
// });

// toNewPlaylistBtn.addEventListener("click", () => {
//   alert(`${toNewPlaylistInput.value} has been created!`);
//   addToNewOrExistingPlaylistModal.style.display = "none";
// });

// const existingPlaylistsList = document.querySelector(
//   "#existing-playlists-list"
// );
// const existingPlaylistsArray = [...existingPlaylistsList.children];

// existingPlaylistsArray.forEach((playlist) => {
//   const playlistInfoPopupBtn = playlist.querySelector(
//     ".existing-playlists-info-popup-btn"
//   );
//   if (playlistInfoPopupBtn) {
//     playlistInfoPopupBtn.addEventListener("click", () => {
//       console.log("clicked");
//     });
//   }
// });

/* const addAllCheckbox = document.querySelector("#add-all-checkbox"); */
const selectSongsList = document.querySelector("#album-select-songs-list");
const albumNewOrExisting = document.querySelector("#album-new-or-existing");
const songs = [...selectSongsList.children];

const previousBtn = document.querySelector("#previous-button");
const nextBtn = document.querySelector("#next-button");

const selectAllInput = document.querySelector("#album-select-all-input");

const albumToNewBtn = document.querySelector("#album-to-new");
const albumToExistingBtn = document.querySelector("#album-to-existing");

const albumToNewErrorMsg = document.querySelector("#album-to-new-error-msg");
const newPlaylistNameInput = document.querySelector("#album-to-new-input");
const albumToNewSuccessContent = document.querySelector(
  "#album-to-new-success-content"
);

const progressBar = document.querySelector("#album-to-playlist-progressbar");

let userSelectedSongs = [];

const checkIfUserSelectedSongs = () => {
  if (userSelectedSongs.length > 0) {
    nextBtn.classList.add("enabled");
  } else {
    nextBtn.classList.remove("enabled");
  }
};

songs.forEach((song, index) => {
  song.addEventListener("mouseup", (event) => {
    const input = event.target.querySelector("input");

    if (!input.checked) {
      userSelectedSongs.push(song.textContent);
    } else {
      const indexOfSong = userSelectedSongs.indexOf(song.textContent);
      userSelectedSongs.splice(indexOfSong, 1);
    }
    checkIfUserSelectedSongs();
    console.log(userSelectedSongs);
  });
});

selectAllInput.addEventListener("click", (event) => {
  songs.forEach((song) => {
    if (event.target.checked) {
      song.querySelector("input").checked = true;
      userSelectedSongs.push(song.textContent);
      selectAllInput.parentNode.classList.add("active");
    } else {
      song.querySelector("input").checked = false;
      const indexOfSong = userSelectedSongs.indexOf(song.textContent);
      userSelectedSongs.splice(indexOfSong, 1);
      selectAllInput.parentNode.classList.remove("active");
    }
  });

  checkIfUserSelectedSongs();
  console.log(userSelectedSongs);
});

const albumToNewContentPage = document.querySelector("#album-to-new-content");
const albumToExistingContentPage = document.querySelector(
  "#album-to-existing-content"
);

let noNewplaylistError = false;
nextBtn.addEventListener("click", () => {
  if (
    userSelectedSongs.length > 0 &&
    progressBar.classList.contains("progress-bar-0")
  ) {
    progressBar.classList.add("progress-bar-33");

    selectSongsList.style.display = "none";
    previousBtn.classList.add("enabled");
    albumNewOrExisting.classList.add("show");
    selectAllInput.parentNode.style.display = "none";
  } else {
    return alert("YOU MUST SELECT SONGS!");
  }

  if (progressBar.classList.contains("progress-bar-33")) {
    if (albumToNewBtn.classList.contains("selected")) {
      progressBar.classList.add("progress-bar-66");
      nextBtn.textContent = "Create";
      nextBtn.classList.add("createPlaylistBtn");

      albumNewOrExisting.classList.remove("show");
      albumToNewContentPage.classList.add("show");

      if (noNewplaylistError) {
        console.log("no errors");
        progressBar.classList.add("progress-bar-100");
        albumToNewContentPage.classList.remove("show");
        albumToNewSuccessContent.classList.add("show");
        nextBtn.classList.remove("enabled");
        previousBtn.classList.remove("enabled");
      }
    } else if (albumToExistingBtn.classList.contains("selected")) {
      progressBar.classList.add("progress-bar-66");
      nextBtn.textContent = "Add";

      albumNewOrExisting.classList.remove("show");
      albumToExistingContentPage.classList.add("show");
    }
  } else {
    return alert(
      "YOU MUST SELECT IF YOU WANT TO ADD TO A NEW OR EXISTING PLAYLIST!"
    );
  }
});

previousBtn.addEventListener("click", () => {
  albumNewOrExisting.classList.remove("show");
  selectSongsList.style.display = "grid";
  previousBtn.classList.remove("enabled");
  progressBar.classList.remove("progress-bar-33");
  selectAllInput.parentNode.style.display = "flex";
});

albumToNewBtn.addEventListener("click", (event) => {
  if (!event.target.classList.contains("selected")) {
    event.target.classList.add("selected");
    albumToExistingBtn.classList.remove("selected");
  } else {
    event.target.classList.remove("selected");
  }
});

albumToExistingBtn.addEventListener("click", (event) => {
  if (!event.target.classList.contains("selected")) {
    event.target.classList.add("selected");
    albumToNewBtn.classList.remove("selected");
  } else {
    event.target.classList.remove("selected");
  }
});

newPlaylistNameInput.addEventListener("keyup", (event) => {
  const playlistName = event.target.value;
  //Pattern checks all alphanumeric and spaces
  const regexPattern = /^([a-zA-Z0-9]+\s)*[a-zA-Z0-9]+$/;
  const isValid = regexPattern.test(playlistName);
  const spaceAmount = playlistName.split(" ").length - 1;
  let noErrors = true;
  if (playlistName.length < 3) {
    nextBtn.classList.remove("enabled");
    albumToNewErrorMsg.classList.remove("noErrors");
    albumToNewErrorMsg.classList.add("error");
    albumToNewErrorMsg.textContent = "Name is too short!";
    noErrors = false;
    noNewplaylistError = noErrors;
  } else if (playlistName.length > 20) {
    nextBtn.classList.remove("enabled");
    albumToNewErrorMsg.classList.remove("noErrors");
    albumToNewErrorMsg.classList.add("error");
    albumToNewErrorMsg.textContent = "Name is too long!";
    noErrors = false;
    noNewplaylistError = noErrors;
  } else if (spaceAmount > 1) {
    nextBtn.classList.remove("enabled");
    albumToNewErrorMsg.classList.remove("noErrors");
    albumToNewErrorMsg.classList.add("error");
    albumToNewErrorMsg.textContent = "Only one space allowed!";
    noErrors = false;
    noNewplaylistError = noErrors;
  } else if (!isValid && playlistName[playlistName.length - 1] === " ") {
    nextBtn.classList.remove("enabled");
    albumToNewErrorMsg.classList.remove("noErrors");
    albumToNewErrorMsg.classList.add("error");
    albumToNewErrorMsg.textContent = "There must be a character after a space!";
    noErrors = false;
    noNewplaylistError = noErrors;
  } else if (!isValid && playlistName[playlistName.length - 1] !== " ") {
    nextBtn.classList.remove("enabled");
    albumToNewErrorMsg.classList.remove("noErrors");
    albumToNewErrorMsg.classList.add("error");
    albumToNewErrorMsg.textContent =
      "Name can only contain letters and numbers!";
    noErrors = false;
    noNewplaylistError = noErrors;
  }

  if (noErrors) {
    nextBtn.classList.add("enabled");
    albumToNewErrorMsg.classList.remove("error");
    albumToNewErrorMsg.classList.add("noErrors");
    albumToNewErrorMsg.textContent = "Name is perfect!";
    noNewplaylistError = noErrors;
  }
});
