<?php
// Simple sample data. Replace this array by DB queries (PDO/MySQLi) when you connect to your database.
$events = [
    ["id"=>1, "name"=>"Duruthu Perahera", "month"=>"January", "district"=>"Kelaniya (Colombo)", "img"=>"../assets/event-images/event1.jpeg", "desc"=>"A colourful Buddhist procession at Kelaniya."],
    ["id"=>2, "name"=>"Thai Pongal", "month"=>"January", "district"=>"Jaffna, Batticaloa", "img"=>"../assets/event-images/event2.jpeg", "desc"=>"Tamil harvest festival with pongal offerings."],
    ["id"=>3, "name"=>"Galle Literary Festival", "month"=>"January", "district"=>"Galle", "img"=>"../assets/event-images/event3.jpeg", "desc"=>"Writers, talks and beachside culture at Galle Fort."],
    ["id"=>4, "name"=>"Independence Day", "month"=>"February", "district"=>"Colombo", "img"=>"../assets/event-images/event4.jpeg", "desc"=>"National parade on 4th February."],
    ["id"=>5, "name"=>"Sinhalese & Tamil New Year", "month"=>"April", "district"=>"Island-wide", "img"=>"../assets/event-images/event5.jpeg", "desc"=>"Traditional games, sweets and rituals."],
    ["id"=>6, "name"=>"Vesak Poya", "month"=>"May", "district"=>"Colombo, Kandy", "img"=>"../assets/event-images/event6.jpeg", "desc"=>"Lanterns, illuminated pandals and dana."],
    ["id"=>7, "name"=>"Poson Poya", "month"=>"June", "district"=>"Anuradhapura, Mihintale", "img"=>"../assets/event-images/event7.jpeg", "desc"=>"Commemorates arrival of Buddhism."],
    ["id"=>8, "name"=>"Esala Perahera", "month"=>"July", "district"=>"Kandy", "img"=>"../assets/event-images/event8.jpeg", "desc"=>"The grand Kandy procession with tuskers."],
    ["id"=>9, "name"=>"Kataragama Festival", "month"=>"July", "district"=>"Kataragama", "img"=>"../assets/event-images/event9.jpeg", "desc"=>"Devotional festival at Kataragama."],
    ["id"=>10, "name"=>"Nallur Festival", "month"=>"August", "district"=>"Jaffna", "img"=>"../assets/event-images/event10.jpeg", "desc"=>"Major Hindu festival with flag hoisting."],
    ["id"=>11, "name"=>"Deepavali", "month"=>"October", "district"=>"Jaffna, Batticaloa", "img"=>"../assets/event-images/event11.jpeg", "desc"=>"Festival of lights celebrated by Tamils."],
    ["id"=>12, "name"=>"Christmas", "month"=>"December", "district"=>"Negombo, Colombo", "img"=>"../assets/event-images/event12.jpeg", "desc"=>"Festive celebrations with decoration and mass."],
];

// months for filter order
$months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Event View • Sri Lanka</title>
  <!-- Bootstrap CSS (v5) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/event-view.css" />
</head>
<body>
  <header class="site-header py-3 shadow-sm sticky-top">
    <div class="container d-flex align-items-center justify-content-between">
      <h1 class="h4 mb-0 brand">Event View</h1>
      <div class="d-flex gap-2 align-items-center">
        <select id="monthFilter" class="form-select form-select-sm">
          <option value="all">All Months</option>
          <?php foreach($months as $m): ?>
            <option value="<?= $m ?>"><?= $m ?></option>
          <?php endforeach; ?>
        </select>
        <input id="searchInput" class="form-control form-control-sm" placeholder="Search event or district..." />
      </div>
    </div>
  </header>

  <main class="container py-4">
    <div class="row g-3" id="eventsGrid">
      <?php foreach($events as $ev): ?>
        <div class="col-12 col-sm-6 col-md-4 event-card-wrap" data-month="<?= $ev['month'] ?>" data-district="<?= htmlspecialchars($ev['district']) ?>">
          <article class="card event-card shadow-sm animate-card" tabindex="0">
            <div class="card-img-top media-wrap">
              <!-- Fixed this line here: use $ev['img'] directly -->
              <img loading="lazy" src="<?= htmlspecialchars($ev['img']) ?>" alt="<?= htmlspecialchars($ev['name']) ?>" class="img-fluid event-thumb" />
              <div class="media-overlay">
                <button class="btn btn-sm btn-light btn-detail" data-id="<?= $ev['id'] ?>">View</button>
              </div>
            </div>
            <div class="card-body">
              <h5 class="card-title mb-1"><?= htmlspecialchars($ev['name']) ?></h5>
              <p class="card-text small text-muted mb-1"><?= $ev['month'] ?> — <?= htmlspecialchars($ev['district']) ?></p>
              <p class="card-text desc"><?= htmlspecialchars($ev['desc']) ?></p>
            </div>
          </article>
        </div>
      <?php endforeach; ?>
    </div>
  </main>

  <!-- Detail Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
      
      <!-- Modal Header -->
      <div class="modal-header bg-primary text-white border-0">
        <h5 class="modal-title fw-bold" id="modalTitle">Event</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body p-4">
        <div class="row g-4 align-items-center">
          <div class="col-md-5">
            <img id="modalImg" src="" alt="" class="img-fluid rounded-3 shadow-sm" />
          </div>
          <div class="col-md-7">
            <p id="modalMonth" class="mb-1 text-primary fw-semibold"></p>
            <p id="modalDistrict" class="mb-2 text-muted"></p>
            <p id="modalDesc" class="lead"></p>
          </div>
        </div>
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer border-0 bg-light">
        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>const SAMPLE_EVENTS = <?= json_encode($events, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP) ?>;</script>
  <script src="../js/event-view.js"></script>
</body>
</html>