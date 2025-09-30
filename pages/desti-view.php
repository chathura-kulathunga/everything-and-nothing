<!-- FILE: desti-view.php -->
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
  <!-- Leaflet CSS for small maps in modal -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

  <!-- Page CSS -->
  <link rel="stylesheet" href="../css/desti-view.css">
</head>
<body>
  <header class="bg-gradient-primary text-white py-3 mb-4">
    <div class="container d-flex align-items-center justify-content-between gap-3">
      <div>
        <h1 class="h5 mb-0">Explore Lanka — Find activities & destinations</h1>
        <small class="text-white-50">Choose by activity, difficulty, region or mood</small>
      </div>
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

          <div class="col-12 col-md-2 d-flex justify-content-md-end gap-2">
            <button id="saveFilters" class="btn btn-outline-success btn-sm" title="Save filters">Save</button>
            <button id="clearFilters" class="btn btn-outline-secondary btn-sm">Clear</button>
          </div>

          <div class="col-12">
            <div class="activity-filters d-flex flex-wrap gap-2" aria-label="Activity filters">
              <!-- activities rendered as toggles. counts will be filled by JS -->
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="hiking">Hiking <span class="badge bg-transparent activity-count">0</span></button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="climbing">Climbing <span class="badge bg-transparent activity-count">0</span></button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="diving">Diving <span class="badge bg-transparent activity-count">0</span></button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="surfing">Surfing <span class="badge bg-transparent activity-count">0</span></button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="cycling">Cycling <span class="badge bg-transparent activity-count">0</span></button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="wildlife">Wildlife <span class="badge bg-transparent activity-count">0</span></button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="birdwatching">Birdwatching <span class="badge bg-transparent activity-count">0</span></button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="waterfalls">Waterfalls <span class="badge bg-transparent activity-count">0</span></button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="boat">Boat trips <span class="badge bg-transparent activity-count">0</span></button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="culture">Culture <span class="badge bg-transparent activity-count">0</span></button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="religious">Religious <span class="badge bg-transparent activity-count">0</span></button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="relax">Relax <span class="badge bg-transparent activity-count">0</span></button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="food">Food <span class="badge bg-transparent activity-count">0</span></button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="photospot">Photo spots <span class="badge bg-transparent activity-count">0</span></button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="adventurepark">Adventure park <span class="badge bg-transparent activity-count">0</span></button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="camping">Camping <span class="badge bg-transparent activity-count">0</span></button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="rafting">Whitewater <span class="badge bg-transparent activity-count">0</span></button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="snorkeling">Snorkeling <span class="badge bg-transparent activity-count">0</span></button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="kitesurfing">Kite surfing <span class="badge bg-transparent activity-count">0</span></button>
              <button class="btn btn-sm btn-outline-primary activity-toggle" data-activity="caveexplore">Caving <span class="badge bg-transparent activity-count">0</span></button>
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

      <div class="col-12 col-sm-6 col-lg-4 destination-card" data-name="Adam's Peak" data-region="central" data-difficulty="hard" data-activities="hiking,climbing,religious,photospot,camping" data-duration="1-day" data-lat="7.2906" data-lng="80.5490">
        <div class="card h-100 shadow-sm">
          <img src="images/adams_peak.jpg" loading="lazy" class="card-img-top" alt="Adam's Peak">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Adam's Peak</h5>
            <p class="card-text small text-muted mb-2">Known for sunrise pilgrimage & tough hike</p>
            <div class="mt-auto d-flex justify-content-between align-items-center gap-2">
              <div class="d-flex gap-2 align-items-center">
                <div class="badge bg-light text-dark small">Hiking • Hard</div>
                <button class="btn btn-sm btn-outline-danger btn-fav" title="Save to favorites">♡</button>
              </div>
              <div class="d-flex gap-2">
                <button class="btn btn-sm btn-primary btn-details" data-bs-toggle="modal" data-bs-target="#detailModal">Details</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-4 destination-card" data-name="Hikkaduwa" data-region="southern" data-difficulty="easy" data-activities="surfing,diving,snorkeling,food,beach,photospot" data-duration="day-trip" data-lat="6.1609" data-lng="80.1010">
        <div class="card h-100 shadow-sm">
          <img src="images/hikkaduwa.jpg" loading="lazy" class="card-img-top" alt="Hikkaduwa">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Hikkaduwa</h5>
            <p class="card-text small text-muted mb-2">Beaches, reef diving and lively markets</p>
            <div class="mt-auto d-flex justify-content-between align-items-center gap-2">
              <div class="d-flex gap-2 align-items-center">
                <div class="badge bg-light text-dark small">Diving • Easy</div>
                <button class="btn btn-sm btn-outline-danger btn-fav" title="Save to favorites">♡</button>
              </div>
              <div class="d-flex gap-2">
                <button class="btn btn-sm btn-primary btn-details" data-bs-toggle="modal" data-bs-target="#detailModal">Details</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-4 destination-card" data-name="Knuckles Range" data-region="central" data-difficulty="moderate" data-activities="hiking,birdwatching,camping,photospot,waterfalls" data-duration="2-days" data-lat="7.4667" data-lng="80.6500">
        <div class="card h-100 shadow-sm">
          <img src="images/knuckles.jpg" loading="lazy" class="card-img-top" alt="Knuckles Range">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Knuckles Range</h5>
            <p class="card-text small text-muted mb-2">Cloud forests, trails & rare birds</p>
            <div class="mt-auto d-flex justify-content-between align-items-center gap-2">
              <div class="d-flex gap-2 align-items-center">
                <div class="badge bg-light text-dark small">Hiking • Moderate</div>
                <button class="btn btn-sm btn-outline-danger btn-fav" title="Save to favorites">♡</button>
              </div>
              <div class="d-flex gap-2">
                <button class="btn btn-sm btn-primary btn-details" data-bs-toggle="modal" data-bs-target="#detailModal">Details</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- more sample cards... copy/paste and change data- attributes -->

    </section>

  </main>

  <!-- Detail Modal (now shows small map + share link + copy) -->
  <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailModalLabel">Destination</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="modalContent">Loading...</div>
          <div id="modalMap" style="height:250px; margin-top:12px; display:none;"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button id="copyLinkBtn" type="button" class="btn btn-outline-primary">Copy link</button>
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
  <!-- Leaflet JS -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <!-- Page JS -->
  <script src="../js/desti-view.js"></script>
</body>
</html>