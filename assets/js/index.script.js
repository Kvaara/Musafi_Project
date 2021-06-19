const volumeControlBar = document.querySelector("#volume-control-bar");

const volumeControlButton = document.querySelector("#volume-control-btn");

volumeControlBar.addEventListener("mouseenter", () => {
  volumeControlButton.style.transition = "all 200ms ease-in-out";
  volumeControlButton.style.transform = "scale(1.2)";
});

volumeControlBar.addEventListener("mouseleave", () => {
  volumeControlButton.style.transform = "scale(1.0)";
});
