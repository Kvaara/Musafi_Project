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
