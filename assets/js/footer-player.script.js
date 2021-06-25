const onAudioEnd = (audioElement) => {
  audioElement.onended = () => {
    if (
      audioElement.currentTrack.albumOrder < audioElement.currentPlaylist.length
    ) {
      const nextTrack = audioElement.currentTrack.albumOrder + 1;
      setNewTrack(audioElement, nextTrack, () => {
        resetButtonStates();
        doPlayAudio(audioElement, true);
        updateFooterPlayerTrackInfo(audioElement);
      });
    }
  };
};

const updateCurrentTimeLeft = (audioElement) => {
  audioElement.oncanplay = () => {
    const duration = new Date(audioElement.duration * 1000)
      .toISOString()
      .substr(14, 5);
    document.querySelector("#current-time-left").textContent = duration;
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
          console.log("Song's count updated by one");
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

const isShuffleOn = (audioElement, putShuffleOn, bindedThis) => {
  if (isShuffleOn && !bindedThis.classList.contains("toggled")) {
    bindedThis.classList.add("toggled");
  } else {
    bindedThis.classList.remove("toggled");
  }
};

const setNewTrack = (audioElement, trackId, callBack) => {
  $.post(
    "./includes/handlers/ajax/getSongJson.php",
    {
      trackId,
      albumId: audioElement.currentTrack.album,
    },
    (result) => {
      const trackData = JSON.parse(result);
      audioElement.currentTrack = trackData;
      audioElement.src = trackData.path;
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
  if (isNext) {
    const nextTrackInAlbum = audioElement.currentTrack.albumOrder + 1;

    if (nextTrackInAlbum > audioElement.currentPlaylist.length) {
      setNewTrack(audioElement, 1, () => {
        resetButtonStates();
        doPlayAudio(audioElement, true);
        updateFooterPlayerTrackInfo(audioElement);
      });
    } else {
      setNewTrack(audioElement, nextTrackInAlbum, () => {
        resetButtonStates();
        doPlayAudio(audioElement, true);
        updateFooterPlayerTrackInfo(audioElement);
      });
    }
  } else {
    const previousTrackInAlbum = audioElement.currentTrack.albumOrder - 1;

    if (previousTrackInAlbum <= 0) {
      audioElement.load();
      doPlayAudio(audioElement, true);
    } else {
      setNewTrack(audioElement, previousTrackInAlbum, () => {
        resetButtonStates();
        doPlayAudio(audioElement, true);
        updateFooterPlayerTrackInfo(audioElement);
      });
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
