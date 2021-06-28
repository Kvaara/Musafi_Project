const buildQueueList = (audioElement) => {
  const queueList = document.querySelector("#queue-ul-list");

  if (queueList.children.length === 2) {
    document.querySelector(
      "#songs-in-queue-span"
    ).textContent = `${audioElement.tracks.length} in queue`;

    audioElement.tracks.forEach((track, index) => {
      if (index === 0) {
        queueList.firstElementChild.style.display = "none";
        document.querySelector("#queue-list-column-names").style.display =
          "flex";
      }

      const liTrack = document.createElement("li");

      const orderInQueue = document.createElement("span");
      orderInQueue.textContent = `${index + 1}`;

      const trackTitle = document.createElement("span");
      trackTitle.textContent = `${track.title}`;

      const trackDuration = document.createElement("span");
      trackDuration.textContent = `${track.duration}`;

      liTrack.appendChild(orderInQueue);
      liTrack.appendChild(trackTitle);
      liTrack.appendChild(trackDuration);

      queueList.appendChild(liTrack);
    });
  } else {
    const queueListChildren = [...queueList.children];
    queueListChildren.forEach((li, index) => {
      if (index > 1) {
        li.remove();
      }
    });

    document.querySelector(
      "#songs-in-queue-span"
    ).textContent = `${audioElement.tracks.length} in queue`;

    audioElement.tracks.forEach((track, index) => {
      if (index === 0) {
        queueList.firstElementChild.style.display = "none";
        document.querySelector("#queue-list-column-names").style.display =
          "flex";
      }

      const liTrack = document.createElement("li");

      const orderInQueue = document.createElement("span");
      orderInQueue.textContent = `${index + 1}`;

      const trackTitle = document.createElement("span");
      trackTitle.textContent = `${track.title}`;

      const trackDuration = document.createElement("span");
      trackDuration.textContent = `${track.duration}`;

      liTrack.appendChild(orderInQueue);
      liTrack.appendChild(trackTitle);
      liTrack.appendChild(trackDuration);

      queueList.appendChild(liTrack);
    });
  }
};

const onAudioEnd = (audioElement) => {
  audioElement.onended = () => {
    const currentTrackIndex = audioElement.tracks.indexOf(
      audioElement.currentTrack
    );
    if (currentTrackIndex + 1 < audioElement.currentPlaylist.length) {
      // const nextTrack = audioElement.currentTrack.albumOrder + 1;
      // setNewTrack(audioElement, nextTrack, () => {
      //   resetButtonStates();
      //   doPlayAudio(audioElement, true);
      //   updateFooterPlayerTrackInfo(audioElement);
      // });
      audioElement.src = audioElement.currentPlaylist[currentTrackIndex + 1];
      audioElement.currentTrack = audioElement.tracks[currentTrackIndex + 1];
      resetButtonStates();
      doPlayAudio(audioElement, true);
      updateFooterPlayerTrackInfo(audioElement);
    } else {
      resetButtonStates();
    }
    // buildQueueList(audioElement);
  };
};

const updateCurrentTimeLeft = (audioElement) => {
  audioElement.oncanplay = () => {
    const duration = new Date(audioElement.duration * 1000)
      .toISOString()
      .substr(14, 5);
    document.querySelector("#current-time-left").textContent = duration;

    // Below checks if the current audio is the last in the playlist, if it is, it changes the next song button to replay playlist button
    const playlistLastIndex = audioElement.currentPlaylist.length - 1;
    const nextSongButton = document.querySelector("#player-right");
    if (
      audioElement.currentTrack["path"] ===
      audioElement.currentPlaylist[playlistLastIndex]
    ) {
      nextSongButton.title = "Replay playlist";
      nextSongButton.src = "./assets/img/replay_playlist_button.svg";
      nextSongButton.classList.add("replayPlaylist");
    } else {
      nextSongButton.title = "Next song";
      nextSongButton.src = "./assets/img/player_right2.svg";
      nextSongButton.classList.remove("replayPlaylist");
    }

    // Below keeps track of the song indexes and updates the queue list's currently playing song's li element background color
    const queueList = document.querySelector("#queue-ul-list");

    const getIndexOfCurrentSong = audioElement.tracks.indexOf(
      audioElement.currentTrack
    );

    // Last song
    queueList.children[getIndexOfCurrentSong + 1].style.backgroundColor = "";

    // Current song
    queueList.children[getIndexOfCurrentSong + 2].style.backgroundColor =
      "#ffffff15";

    // Next song and the background color reset of the last song
    console.log(audioElement.currentPlaylist.length);
    if (getIndexOfCurrentSong < audioElement.currentPlaylist.length - 1) {
      queueList.lastElementChild.style.backgroundColor = "";
      queueList.children[getIndexOfCurrentSong + 3].style.backgroundColor = "";
    }
  };
};

const updateCurrentTimeAndProgressBar = (audioElement) => {
  audioElement.ontimeupdate = () => {
    const currentTime = new Date(audioElement.currentTime * 1000)
      .toISOString()
      .substr(14, 5);
    document.querySelector("#current-time").textContent = currentTime;

    const currentPercentageAmount =
      (audioElement.currentTime / audioElement.duration) * 100;

    document.querySelector(
      "#progress"
    ).style.width = `${currentPercentageAmount}%`;
  };
};

const userProgressBarControl = (audioElement) => {
  let isMouseDown = false;

  const progressBar = document.querySelector("#progress-bar");

  progressBar.addEventListener("mousedown", () => {
    isMouseDown = true;
  });

  progressBar.addEventListener("mousemove", function (event) {
    if (isMouseDown) {
      const percentage = (event.offsetX / this.offsetWidth) * 100;
      const seconds = audioElement.duration * (percentage / 100);
      audioElement.currentTime = seconds;
    }
  });

  progressBar.addEventListener("click", function (event) {
    const percentage = (event.offsetX / this.offsetWidth) * 100;
    const seconds = audioElement.duration * (percentage / 100);
    audioElement.currentTime = seconds;
  });

  document.addEventListener("mouseup", () => {
    isMouseDown = false;
  });
};

const updateVolumeIcon = (percentage, doUpdateVolumeBarWidth) => {
  const volume100 = document.querySelector("#volume-100");
  const volume50 = document.querySelector("#volume-50");
  const volume0 = document.querySelector("#volume-0");

  if (doUpdateVolumeBarWidth) {
    document.querySelector(
      "#volume-control-bar-progress"
    ).style.width = `${percentage}%`;
  }

  if (percentage > 50) {
    volume100.style.display = "inline";
    volume50.style.display = "none";
    volume0.style.display = "none";
  } else if (percentage <= 50 && percentage > 0) {
    volume50.style.display = "inline";
    volume100.style.display = "none";
    volume0.style.display = "none";
  } else {
    volume0.style.display = "inline";
    volume100.style.display = "none";
    volume50.style.display = "none";
  }
};

const userVolumeBarControl = (audioElement) => {
  let isMouseDown = false;

  const volumeProgressBar = document.querySelector("#volume-control-bar");

  volumeProgressBar.addEventListener("mousedown", () => {
    isMouseDown = true;
  });

  const volumeProgressBarUpdate = function (event, bindedThis, click) {
    if (isMouseDown || click) {
      const percentage = (event.offsetX / bindedThis.offsetWidth) * 100;
      document.querySelector(
        "#volume-control-bar-progress"
      ).style.width = `${percentage}%`;
      audioElement.volume = percentage / 100;

      percentage < 0
        ? (audioElement.volume = 0)
        : (audioElement.volume = percentage / 100);

      updateVolumeIcon(percentage);
    }
  };
  volumeProgressBar.addEventListener("mousemove", function (event) {
    const bindedThis = this;
    volumeProgressBarUpdate(event, bindedThis);
  });
  volumeProgressBar.addEventListener("click", function (event) {
    const bindedThis = this;
    click = true;
    volumeProgressBarUpdate(event, bindedThis, click);
  });

  document.addEventListener("mouseup", () => {
    isMouseDown = false;
  });
};

let previousVolume;
const muteToggleVolume = (doMuteVolume) => {
  if (doMuteVolume) {
    previousVolume = audioElement.volume;
    audioElement.volume = 0;
    updateVolumeIcon(0, true);
  } else {
    audioElement.volume = previousVolume;
    updateVolumeIcon(previousVolume * 100, true);
  }
};

const doPlayAudio = (audioElement, doPlayAudio) => {
  if (doPlayAudio) {
    audioElement.play();
    document.querySelector("#player-pause").style.display = "inline";
    document.querySelector("#player-play").style.display = "none";

    if (audioElement.currentTime === 0) {
      $.post(
        "./includes/handlers/ajax/updatePlays.php",
        {
          trackId: audioElement.currentTrack.id,
        },
        () => {
          // console.log("Song's count updated by one");
        }
      );
    }
    updateButtonStates(audioElement.currentTrack, true);
  } else {
    audioElement.pause();
    document.querySelector("#player-play").style.display = "inline";
    document.querySelector("#player-pause").style.display = "none";
    updateButtonStates(audioElement.currentTrack, false);
  }
};

const isRepeatOn = (audioElement, putRepeatOn, bindedThis) => {
  if (putRepeatOn && !bindedThis.classList.contains("toggled")) {
    bindedThis.classList.add("toggled");
    audioElement.loop = true;
  } else {
    bindedThis.classList.remove("toggled");
    audioElement.loop = false;
  }
};

// TODO Make the shuffle button better (it's no more a toggle button. It only shuffles the current playlist the user has)
// TODO Clean out the code. Refactor the damnation out of this... Also think better on how you will implement this system
// TODO The user can choose their own playlist and that playlist will be saved in here
// TODO So immediately when the page loads don't do anything but CREATE THE AUDIO ELEMENT
// TODO SO FOOTER play bar will be empty UNTIL USER CLICKS PLAY ALL OR ADDS TO A PLAYLIST
// TODO PLAY ALL SIMPLY ADDS ALL SONGS TO A PLAYLIST
// TODO ADD TO PLAYLIST GIVES USER A CHOICE TO MAKE HIS/HER OWN PLAYLIST AND RENAME IT AND ADD ALL OF THE ALBUM'S SONGS IN THERE
// TODO FAVORITE ADDS THE ALBUM TO THE USERS FAVORITES. THE AMOUNT OF TIMES USERS HAVE FAVORITED ALBUMS WILL BE SHOWN!
// TODO SHARE OPENS UP DIFFERENT SOCIAL MEDIA PLACES WHERE THE USER CAN SHARE THE ALBUM

const isShuffleOn = (audioElement, putShuffleOn, bindedThis) => {
  //&& !bindedThis.classList.contains("toggled") inside below if statement
  if (putShuffleOn) {
    // bindedThis.classList.add("toggled");

    $.post(
      "./includes/handlers/ajax/shuffleAlbumSongsJson.php",
      {
        albumId: audioElement.currentTrack.album,
      },
      (result) => {
        const albumRandomized = JSON.parse(result);
        let newPlaylist = [];
        albumRandomized.forEach((song) => {
          newPlaylist.push(song.path);
        });
        audioElement.currentPlaylist = newPlaylist;
        audioElement.src = albumRandomized[0].path;
        audioElement.currentTrack = albumRandomized[0];
        audioElement.tracks = albumRandomized;
        resetButtonStates();
        doPlayAudio(audioElement, true);
        buildQueueList(audioElement);
      }
    );
  } else {
    // bindedThis.classList.remove("toggled");
    // addAlbumToQueue(audioElement, audioElement.currentTrack.album);
  }
};

const setNewTrack = (audioElement, trackId, albumId, callBack) => {
  $.post(
    "./includes/handlers/ajax/getSongJson.php",
    {
      trackId,
      albumId,
    },
    (result) => {
      const trackData = JSON.parse(result);
      audioElement.currentTrack = trackData;
      audioElement.tracks = [trackData];
      audioElement.src = trackData.path;
      audioElement.currentPlaylist = [trackData.path];
      return callBack();
    }
  );
};

const getCurrentTrack = (audioElement, callBack) => {
  $.post(
    "./includes/handlers/ajax/getSongJson.php",
    {
      trackId: audioElement.currentTrack.albumOrder,
      albumId: audioElement.currentTrack.album,
    },
    (result) => {
      const trackData = JSON.parse(result);
      return callBack(trackData);
    }
  );
};

const previousOrNextSong = (audioElement, isNext) => {
  if (audioElement.currentPlaylist.length > 0) {
    if (isNext) {
      const nextAudioIndex =
        audioElement.tracks.findIndex(
          (track) => track === audioElement.currentTrack
        ) + 1;
      if (nextAudioIndex === audioElement.tracks.length) {
        audioElement.src = audioElement.currentPlaylist[0];
        audioElement.currentTrack = audioElement.tracks[0];
        resetButtonStates();
        doPlayAudio(audioElement, true);
        updateFooterPlayerTrackInfo(audioElement);
      } else {
        audioElement.src = audioElement.currentPlaylist[nextAudioIndex];
        audioElement.currentTrack = audioElement.tracks[nextAudioIndex];
        resetButtonStates();
        doPlayAudio(audioElement, true);
        updateFooterPlayerTrackInfo(audioElement);
      }
    } else {
      const previousAudioIndex =
        audioElement.tracks.findIndex(
          (track) => track === audioElement.currentTrack
        ) - 1;

      if (previousAudioIndex < 0) {
        audioElement.src = audioElement.currentPlaylist[0];
        audioElement.currentTrack = audioElement.tracks[0];
        resetButtonStates();
        doPlayAudio(audioElement, true);
        updateFooterPlayerTrackInfo(audioElement);
      } else {
        audioElement.src = audioElement.currentPlaylist[previousAudioIndex];
        audioElement.currentTrack = audioElement.tracks[previousAudioIndex];
        resetButtonStates();
        doPlayAudio(audioElement, true);
        updateFooterPlayerTrackInfo(audioElement);
      }
    }
  }
};

const updateFooterPlayerTrackInfo = (audioElement) => {
  $.post(
    "./includes/handlers/ajax/getSongJson.php",
    {
      trackId: audioElement.currentTrack.albumOrder,
      albumId: audioElement.currentTrack.album,
    },
    (result) => {
      const trackData = JSON.parse(result);

      document.querySelector("#current-song-name").textContent =
        trackData.title;

      $.post(
        "./includes/handlers/ajax/getArtistJson.php",
        {
          artistId: trackData.artist,
        },
        (result) => {
          const artistName = JSON.parse(result);

          document.querySelector(
            "#current-song-author"
          ).textContent = `by ${artistName.name}`;
        }
      );

      $.post(
        "./includes/handlers/ajax/getAlbumJson.php",
        {
          albumId: trackData.album,
        },
        (result) => {
          const albumData = JSON.parse(result);

          document.querySelector("#current-song-img").src =
            albumData.artworkPath;
        }
      );
    }
  );
};

const setAlbumTracks = (audioElement, albumId) => {
  $.post(
    "./includes/handlers/ajax/getAllSongsJson.php",
    {
      albumId,
    },
    (result) => {
      const listOfSongsInAlbum = JSON.parse(result);
      audioElement.tracks = listOfSongsInAlbum;
    }
  );
};
