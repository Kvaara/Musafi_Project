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
