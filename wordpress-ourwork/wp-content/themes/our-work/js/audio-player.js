document.addEventListener("DOMContentLoaded", function () {
    const audioPlayer = document.getElementById("audio-player");
    const playButton = document.getElementById("custom-play-toggle");
    const seekBar = document.getElementById("seek-bar");
    const durationDisplay = document.querySelector(".duration");
    const backward = document.querySelector(".backward");
    const forward = document.querySelector(".forward");

    if (!audioPlayer || !playButton || !seekBar) return;

    const playIcon = playButton.dataset.play;
    const pauseIcon = playButton.dataset.pause;

    playButton.addEventListener("click", () => {
        if (audioPlayer.paused) {
            audioPlayer.play();
            playButton.src = pauseIcon;
        } else {
            audioPlayer.pause();
            playButton.src = playIcon;
        }
    });

    audioPlayer.addEventListener("timeupdate", () => {
        if (!isNaN(audioPlayer.duration)) {
            seekBar.value = (audioPlayer.currentTime / audioPlayer.duration) * 100;
        }

        const minutes = Math.floor(audioPlayer.currentTime / 60);
        const seconds = Math.floor(audioPlayer.currentTime % 60).toString().padStart(2, '0');
        durationDisplay.textContent = `${minutes}:${seconds}`;
    });

    seekBar.addEventListener("input", () => {
        if (!isNaN(audioPlayer.duration)) {
            audioPlayer.currentTime = (seekBar.value / 100) * audioPlayer.duration;
        }
    });

    if (backward) {
        backward.addEventListener("click", () => {
            audioPlayer.currentTime = Math.max(0, audioPlayer.currentTime - 15);
        });
    }

    if (forward) {
        forward.addEventListener("click", () => {
            audioPlayer.currentTime = Math.min(audioPlayer.duration, audioPlayer.currentTime + 15);
        });
    }
});