<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Dark Music Player</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/music-player.css">
</head>

<body class="bg-dark text-light">

<div class="container py-5">
  <div class="player card bg-secondary bg-gradient shadow-lg mx-auto p-4" style="max-width: 500px;">
    
    <h3 class="text-center mb-3">🎵 My Music Player</h3>

    <div class="text-center mb-3">
      <img src="assets/img/cover.jpg" id="coverArt" class="img-fluid rounded">
    </div>

    <div class="text-center mb-2">
      <strong id="currentTitle">Song 1</strong>
    </div>

    <!-- TIME -->
    <div class="d-flex justify-content-between small mb-1">
      <span id="currentTime">0:00</span>
      <span id="duration">0:00</span>
    </div>

    <!-- PROGRESS -->
    <div class="progress mb-3" id="progressContainer" style="height: 6px; cursor: pointer;">
      <div id="progressBar" class="progress-bar bg-warning"></div>
    </div>

    <audio id="audioPlayer"></audio>

    <!-- CONTROLS -->
    <div class="controls d-flex justify-content-center mb-3">
      <button class="btn btn-dark mx-1" onclick="prevSong()">
        <i class="bi bi-skip-backward-fill"></i>
      </button>

      <button class="btn btn-warning mx-1" onclick="playPause()">
        <i id="playIcon" class="bi bi-play-fill"></i>
      </button>

      <button class="btn btn-dark mx-1" onclick="nextSong()">
        <i class="bi bi-skip-forward-fill"></i>
      </button>
    </div>

    <!-- VOLUME -->
    <div class="volume d-flex align-items-center mb-3">
      <i class="bi bi-volume-down-fill"></i>
      <input type="range" id="volumeSlider" class="form-range mx-2" min="0" max="1" step="0.01">
      <i class="bi bi-volume-up-fill"></i>
    </div>

    <!-- PLAYLIST -->
    <div id="playlist" class="playlist list-group"></div>

  </div>
</div>

<script src="assets/js/music-player.js"></script>
</body>
</html>
