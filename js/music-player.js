let audio = document.getElementById('audioPlayer');
let playIcon = document.getElementById('playIcon');
let progressBar = document.getElementById('progressBar');
let volumeSlider = document.getElementById('volumeSlider');
let currentTitle = document.getElementById('currentTitle');

let progressContainer = document.getElementById('progressContainer');
let currentTimeEl = document.getElementById('currentTime');
let durationEl = document.getElementById('duration');

let playlist = [
  { title: "Song 1", file: "assets/music/song1.mp3", cover: "assets/img/cover.jpg" },
  { title: "Song 2", file: "assets/music/song2.mp3", cover: "assets/img/cover2.jpg" },
  { title: "Song 3", file: "assets/music/song3.mp3", cover: "assets/img/cover3.jpg" }
];

let currentIndex = 0;

// LOAD FIRST SONG
loadSong(currentIndex);

// UPDATE PROGRESS + TIME
audio.addEventListener('timeupdate', () => {
  if (!audio.duration) return;

  let progress = (audio.currentTime / audio.duration) * 100;
  progressBar.style.width = progress + '%';

  currentTimeEl.textContent = formatTime(audio.currentTime);
  durationEl.textContent = formatTime(audio.duration);
});

// CLICK TO SEEK
progressContainer.addEventListener('click', (e) => {
  let width = progressContainer.clientWidth;
  let clickX = e.offsetX;
  audio.currentTime = (clickX / width) * audio.duration;
});

// AUTO NEXT
audio.addEventListener('ended', () => {
  nextSong();
});

// VOLUME
volumeSlider.addEventListener('input', () => {
  audio.volume = volumeSlider.value;
});

// PLAY / PAUSE
function playPause() {
  if (audio.paused) {
    audio.play();
    playIcon.className = 'bi bi-pause-fill';
  } else {
    audio.pause();
    playIcon.className = 'bi bi-play-fill';
  }
}

// LOAD SONG
function loadSong(index) {
  audio.src = playlist[index].file;
  document.getElementById('coverArt').src = playlist[index].cover;
  currentTitle.textContent = playlist[index].title;
}

// PLAY SPECIFIC
function playThis(index) {
  currentIndex = index;
  loadSong(currentIndex);
  audio.play();
  playIcon.className = 'bi bi-pause-fill';
}

// NEXT
function nextSong() {
  currentIndex = (currentIndex + 1) % playlist.length;
  playThis(currentIndex);
}

// PREVIOUS
function prevSong() {
  currentIndex = (currentIndex - 1 + playlist.length) % playlist.length;
  playThis(currentIndex);
}

// FORMAT TIME
function formatTime(time) {
  if (isNaN(time)) return "0:00";
  let min = Math.floor(time / 60);
  let sec = Math.floor(time % 60).toString().padStart(2, '0');
  return `${min}:${sec}`;
}
