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
