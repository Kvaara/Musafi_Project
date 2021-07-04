var albumSongsListContainer = document.querySelector(
  "#album-songs-list-container"
);

var getSongElements = () => {
  var listOfSongElements = albumSongsListContainer.children;
  var listOfSongs = [...listOfSongElements];
  return listOfSongs;
};

var makeAlbumPlayPauseButtonsArray = () => {
  var listOfSongs = getSongElements();

  var playButtonsArray = [];
  var pauseButtonsArray = [];

  listOfSongs.forEach((songElement) => {
    playButtonsArray.push(songElement.children[0]);
    pauseButtonsArray.push(songElement.children[1]);
  });

  var albumButtonsArray = {
    playButtons: [...playButtonsArray],
    pauseButtons: [...pauseButtonsArray],
  };

  return albumButtonsArray;
};
