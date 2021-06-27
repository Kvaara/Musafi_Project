const addAlbumToQueue = (audioElement, albumId) => {
  $.post(
    "./includes/handlers/ajax/getAllSongsJson.php",
    {
      albumId,
    },
    (result) => {
      const albumPlaylist = JSON.parse(result);
      audioElement.tracks = albumPlaylist;

      const newPlaylist = [];
      albumPlaylist.forEach((song) => {
        newPlaylist.push(song.path);
      });
      audioElement.currentPlaylist = newPlaylist;

      audioElement.src = albumPlaylist[0].path;
      audioElement.currentTrack = albumPlaylist[0];
      //   updateButtonStates(albumPlaylist[0], true);
      resetButtonStates();
      doPlayAudio(audioElement, true);
    }
  );
};

const expandAlbumList = () => {
  const applicationAlbumPage = document.querySelector(
    "#application-page-album"
  );
  const buttonTextContent = document.querySelector(
    "#expand-list-btn-container"
  ).firstElementChild;

  if (!applicationAlbumPage.classList.contains("expanded")) {
    applicationAlbumPage.classList.add("expanded");
    buttonTextContent.classList.add("expanded");
    buttonTextContent.textContent = "Shrink list";
  } else {
    applicationAlbumPage.classList.remove("expanded");
    buttonTextContent.classList.remove("expanded");
    buttonTextContent.textContent = "Expand list";
  }
};
