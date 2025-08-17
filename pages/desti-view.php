<?php
// desti-view.php
// A responsive destination selector page for Explore Lanka
// Expects: desti-view.css and desti-view.js in same folder
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Explore Lanka — Choose a Destination</title>

  <!-- Bootstrap 5 CSS (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Page CSS -->
  <link rel="stylesheet" href="desti-view.css">
</head>
<body>
  <header class="bg-primary text-white py-3 mb-4">
    <div class="container d-flex align-items-center justify-content-between">
      <h1 class="h4 mb-0">Explore Lanka — Find activities & destinations</h1>
      <div class="text-end small">Filter by what you want to do →</div>
    </div>
  </header>

  <main class="container mb-5">
    <section id="filters" class="card mb-4">
      <div class="card-body">
        <div class="row gy-3 align-items-center">

          <div class="col-12 col-md-5">
            <div class="input-group">
              <span class="input-group-text" id="search-label">🔎</span>
              <input id="searchInput" type="search" class="form-control" placeholder="Search destination, feature or tag" aria-label="Search" aria-describedby="search-label">
            </div>
          </div>

          <div class="col-12 col-md-3">
            <select id="regionSelect" class="form-select" aria-label="Select region">
              <option value="any" selected>All provinces / regions</option>
              <option value="western">Western Province</option>
              <option value="central">Central Province</option>
              <option value="southern">Southern Province</option>
              <option value="sabaragamuwa">Sabaragamuwa Province</option>
              <option value="uva">Uva Province</option>
              <option value="north">Northern Province</option>
              <option value="north-central">North Central Province</option>
              <option value="eastern">Eastern Province</option>
            </select>
          </div>

          <div class="col-12 col-md-2">
            <select id="difficultySelect" class="form-select" aria-label="Select difficulty">
              <option value="any" selected>Any difficulty</option>
              <option value="easy">Easy</option>
              <option value="moderate">Moderate</option>
              <option value="hard">Hard</option>
            </select>
          </div>

          <div class="col-12 col-md-2 d-flex justify-content-md-end">
            <button id="clearFilters" class="btn btn-outline-secondary">Clear</button>
          </div>

          <div class="col-12">
            <div class="activity-filters d-flex flex-wrap gap-2" aria-label="Activity filters">
              <!-- activities rendered as toggles -->
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="hiking">Hiking</button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="climbing">Climbing</button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="diving">Diving</button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="surfing">Surfing</button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="cycling">Cycling</button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="wildlife">Wildlife</button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="birdwatching">Birdwatching</button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="waterfalls">Waterfalls</button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="boat">Boat trips</button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="culture">Culture</button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="religious">Religious sites</button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="relax">Relax & spa</button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="food">Food & markets</button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="photospot">Photo spots</button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="adventurepark">Adventure park</button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="camping">Camping</button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="rafting">Whitewater</button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="snorkeling">Snorkeling</button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="kitesurfing">Kite surfing</button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="caveexplore">Caving</button>
            </div>
          </div>

        </div>
      </div>
    </section>

    <section class="d-flex align-items-center justify-content-between mb-3">
      <div><strong id="resultCount">0</strong> results</div>
      <div>
        <div class="btn-group" role="group" aria-label="Sort options">
          <button class="btn btn-outline-secondary btn-sm" id="sortName">Sort: Name</button>
          <button class="btn btn-outline-secondary btn-sm" id="sortDifficulty">Sort: Difficulty</button>
        </div>
      </div>
    </section>

    <section id="resultsGrid" class="row g-3">
      <!-- Sample destination cards. Each card has data- attributes used for filtering. Add as many as needed. -->

      <div class="col-12 col-sm-6 col-lg-4 destination-card" data-name="Adam's Peak" data-region="central" data-difficulty="hard" data-activities="hiking,climbing,religious,photospot,camping" data-duration="1-day">
        <div class="card h-100 shadow-sm">
          <img src="images/adams_peak.jpg" class="card-img-top" alt="Adam's Peak">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Adam's Peak</h5>
            <p class="card-text small text-muted mb-2">Known for sunrise pilgrimage & tough hike</p>
            <div class="mt-auto d-flex justify-content-between align-items-center">
              <div class="badge bg-light text-dark small">Hiking • Hard</div>
              <button class="btn btn-sm btn-primary btn-details" data-bs-toggle="modal" data-bs-target="#detailModal">Details</button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-4 destination-card" data-name="Hikkaduwa" data-region="southern" data-difficulty="easy" data-activities="surfing,diving,snorkeling,food,beach,photospot" data-duration="day-trip">
        <div class="card h-100 shadow-sm">
          <img src="images/hikkaduwa.jpg" class="card-img-top" alt="Hikkaduwa">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Hikkaduwa</h5>
            <p class="card-text small text-muted mb-2">Beaches, reef diving and lively markets</p>
            <div class="mt-auto d-flex justify-content-between align-items-center">
              <div class="badge bg-light text-dark small">Diving • Easy</div>
              <button class="btn btn-sm btn-primary btn-details" data-bs-toggle="modal" data-bs-target="#detailModal">Details</button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-4 destination-card" data-name="Knuckles Range" data-region="central" data-difficulty="moderate" data-activities="hiking,birdwatching,camping,photospot,waterfalls" data-duration="2-days">
        <div class="card h-100 shadow-sm">
          <img src="images/knuckles.jpg" class="card-img-top" alt="Knuckles Range">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Knuckles Range</h5>
            <p class="card-text small text-muted mb-2">Cloud forests, trails & rare birds</p>
            <div class="mt-auto d-flex justify-content-between align-items-center">
              <div class="badge bg-light text-dark small">Hiking • Moderate</div>
              <button class="btn btn-sm btn-primary btn-details" data-bs-toggle="modal" data-bs-target="#detailModal">Details</button>
            </div>
          </div>
        </div>
      </div>

      <!-- more sample cards... copy/paste and change data- attributes -->

    </section>

  </main>

  <!-- Detail Modal -->
  <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailModalLabel">Destination</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="modalContent">Loading...</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a id="modalMoreLink" href="#" class="btn btn-primary">More</a>
        </div>
      </div>
    </div>
  </div>

  <footer class="bg-light py-3 mt-5">
    <div class="container text-center small">Made for Explore Lanka — use the filters to refine results</div>
  </footer>

  <!-- Bootstrap Bundle JS (Popper included) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Page JS -->
  <script src="desti-view.js"></script>
</body>
</html>