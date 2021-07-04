/* const addAllCheckbox = document.querySelector("#add-all-checkbox"); */
var selectSongsList = document.querySelector("#album-select-songs-list");
var albumNewOrExisting = document.querySelector("#album-new-or-existing");
var songs = [...selectSongsList.children];

var headerTitle = document.querySelector(
  "#album-to-playlist-header"
).firstElementChild;

var previousBtn = document.querySelector("#previous-button");
var nextBtn = document.querySelector("#next-button");

var selectAllInput = document.querySelector("#album-select-all-input");

var albumToNewBtn = document.querySelector("#album-to-new");
var albumToExistingBtn = document.querySelector("#album-to-existing");

var albumToNewErrorMsg = document.querySelector("#album-to-new-error-msg");
var newPlaylistNameInput = document.querySelector("#album-to-new-input");
var albumSuccessContent = document.querySelectorAll(".album-success-content");

var progressBar = document.querySelector("#album-to-playlist-progressbar");

var userSelectedSongs = [];

var checkIfUserSelectedSongs = () => {
  if (userSelectedSongs.length > 0) {
    nextBtn.classList.add("enabled");
  } else {
    nextBtn.classList.remove("enabled");
  }
};

songs.forEach((song, index) => {
  song.addEventListener("mouseup", (event) => {
    var input = event.target.querySelector("input");

    if (!input.checked) {
      userSelectedSongs.push(song.textContent);
    } else {
      var indexOfSong = userSelectedSongs.indexOf(song.textContent);
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
      var indexOfSong = userSelectedSongs.indexOf(song.textContent);
      userSelectedSongs.splice(indexOfSong, 1);
      selectAllInput.parentNode.classList.remove("active");
    }
  });

  checkIfUserSelectedSongs();
  console.log(userSelectedSongs);
});

var albumToNewContentPage = document.querySelector("#album-to-new-content");
var albumToExistingContentPage = document.querySelector(
  "#album-to-existing-content"
);

var noNewplaylistError = false;

nextBtn.addEventListener("click", () => {
  if (
    userSelectedSongs.length > 0 &&
    progressBar.classList.contains("progress-bar-0")
  ) {
    progressBar.classList.remove("progress-bar-0");
    progressBar.classList.add("progress-bar-33");

    selectSongsList.style.display = "none";
    previousBtn.classList.add("enabled");
    albumNewOrExisting.classList.add("show");
    selectAllInput.parentNode.style.display = "none";
    headerTitle.textContent = "To new or existing?";
  } else if (progressBar.classList.contains("progress-bar-33")) {
    if (albumToNewBtn.classList.contains("selected")) {
      progressBar.classList.remove("progress-bar-33");
      progressBar.classList.add("progress-bar-66");
      nextBtn.textContent = "Create";
      nextBtn.classList.add("createPlaylistBtn");

      albumNewOrExisting.classList.remove("show");
      albumToNewContentPage.classList.add("show");
      headerTitle.textContent = "Name your playlist";
    } else if (albumToExistingBtn.classList.contains("selected")) {
      progressBar.classList.remove("progress-bar-33");
      progressBar.classList.add("progress-bar-66");
      nextBtn.textContent = "Add";

      albumNewOrExisting.classList.remove("show");
      albumToExistingContentPage.classList.add("show");
      headerTitle.textContent = "Select your playlist";
    }
  } else if (progressBar.classList.contains("progress-bar-66")) {
    if (
      noNewplaylistError &&
      albumToNewContentPage.classList.contains("show")
    ) {
      console.log("no errors");
      progressBar.classList.add("progress-bar-100");
      albumToNewContentPage.classList.remove("show");
      albumSuccessContent[0].classList.add("show");
      nextBtn.classList.remove("enabled");
      previousBtn.classList.remove("enabled");
    } else if (albumToExistingContentPage.classList.contains("show")) {
      if (selectedAlbumIndex !== undefined) {
        progressBar.classList.add("progress-bar-100");
        albumToExistingContentPage.classList.remove("show");
        albumSuccessContent[1].classList.add("show");
        nextBtn.classList.remove("enabled");
        previousBtn.classList.remove("enabled");
        progressBar.classList.remove("progress-bar-100");
        progressBar.classList.add("progress-bar-0");
      } else {
        alert("you must select a playlist!");
      }
    }
  } else {
    return alert(
      "YOU MUST SELECT IF YOU WANT TO ADD TO A NEW OR EXISTING PLAYLIST!"
    );
  }
});

previousBtn.addEventListener("click", () => {
  if (progressBar.classList.contains("progress-bar-33")) {
    progressBar.classList.remove("progress-bar-33");
    progressBar.classList.add("progress-bar-0");
    albumNewOrExisting.classList.remove("show");
    selectSongsList.style.display = "grid";
    selectAllInput.parentNode.style.display = "flex";
    previousBtn.classList.remove("enabled");
    headerTitle.textContent = "Select songs";
  } else if (progressBar.classList.contains("progress-bar-66")) {
    progressBar.classList.remove("progress-bar-66");
    progressBar.classList.add("progress-bar-33");
    headerTitle.textContent = "To new or existing?";
    if (albumToNewBtn.classList.contains("selected")) {
      albumToNewContentPage.classList.remove("show");
      albumNewOrExisting.classList.add("show");
    } else {
      albumToExistingContentPage.classList.remove("show");
      albumNewOrExisting.classList.add("show");
    }
    nextBtn.textContent = "Next";
  } else if (progressBar.classList.contains("progress-bar-100")) {
    progressBar.classList.remove("progress-bar-100");
    progressBar.classList.add("progress-bar-66");
  }
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
  var playlistName = event.target.value;
  //Pattern checks all alphanumeric and spaces
  var regexPattern = /^([a-zA-Z0-9]+\s)*[a-zA-Z0-9]+$/;
  var isValid = regexPattern.test(playlistName);
  var spaceAmount = playlistName.split(" ").length - 1;
  var noErrors = true;
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

var albumElements = [...albumToExistingContentPage.children];

var selectedAlbumIndex;
albumElements.forEach((album, index) => {
  album.addEventListener("click", (event) => {
    if (selectedAlbumIndex === undefined) {
      selectedAlbumIndex = index;
      album.style.backgroundColor = "#6F0000";
      album.style.border = "2px solid #6F0000";
      album.style.letterSpacing = "0px";
    } else {
      albumElements[selectedAlbumIndex].style.backgroundColor = "";
      albumElements[selectedAlbumIndex].style.border = "";
      albumElements[selectedAlbumIndex].style.letterSpacing = "";
      selectedAlbumIndex = index;
      album.style.backgroundColor = "#6F0000";
      album.style.border = "2px solid #6F0000";
      album.style.letterSpacing = "0px";
    }
  });
});
