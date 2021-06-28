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
      buildQueueList(audioElement);
      resetButtonStates();
      doPlayAudio(audioElement, true);
      updateFooterPlayerTrackInfo(audioElement);
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
  const expandListBtnContainer = document.querySelector(
    "#expand-list-btn-container"
  );

  if (!expandListBtnContainer.classList.contains("expanded")) {
    applicationAlbumPage.classList.add("expanded");
    expandListBtnContainer.classList.add("expanded");
    buttonTextContent.textContent = "SHRINK LIST";
  } else {
    applicationAlbumPage.classList.remove("expanded");
    expandListBtnContainer.classList.remove("expanded");
    buttonTextContent.textContent = "EXPAND LIST";
  }
};
