const albumSongsListContainer = document.querySelector(
  "#album-songs-list-container"
);

const getSongElements = () => {
  const listOfSongElements = albumSongsListContainer.children;
  const listOfSongs = [...listOfSongElements];
  return listOfSongs;
};

const makeAlbumPlayPauseButtonsArray = () => {
  const listOfSongs = getSongElements();

  const playButtonsArray = [];
  const pauseButtonsArray = [];

  listOfSongs.forEach((songElement) => {
    playButtonsArray.push(songElement.children[0]);
    pauseButtonsArray.push(songElement.children[1]);
  });

  const albumButtonsArray = {
    playButtons: [...playButtonsArray],
    pauseButtons: [...pauseButtonsArray],
  };

  return albumButtonsArray;
};
