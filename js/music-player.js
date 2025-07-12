let audio = document.getElementById('audioPlayer');
let playIcon = document.getElementById('playIcon');
let progressBar = document.getElementById('progressBar');
let volumeSlider = document.getElementById('volumeSlider');
let currentTitle = document.getElementById('currentTitle');

let playlist = [
  { title: "Song 1", file: "assets/music/song1.mp3", cover: "assets/img/cover.jpg" },
  { title: "Song 2", file: "assets/music/song2.mp3", cover: "assets/img/cover2.jpg" },
  { title: "Song 3", file: "assets/music/song3.mp3", cover: "assets/img/cover3.jpg" }
];
let currentIndex = 0;

audio.addEventListener('timeupdate', () => {
  let progress = (audio.currentTime / audio.duration) * 100;
  progressBar.style.width = progress + '%';
});

volumeSlider.addEventListener('input', () => {
  audio.volume = volumeSlider.value;
});

function playPause() {
  if (audio.paused) {
    audio.play();
    playIcon.className = 'bi bi-pause-fill';
  } else {
    audio.pause();
    playIcon.className = 'bi bi-play-fill';
  }
}

function playThis(index) {
  currentIndex = index;
  audio.src = playlist[currentIndex].file;
  document.getElementById('coverArt').src = playlist[currentIndex].cover;
  currentTitle.textContent = playlist[currentIndex].title;
  audio.play();
  playIcon.className = 'bi bi-pause-fill';
}

function nextSong() {
  currentIndex = (currentIndex + 1) % playlist.length;
  playThis(currentIndex);
}

function prevSong() {
  currentIndex = (currentIndex - 1 + playlist.length) % playlist.length;
  playThis(currentIndex);
}