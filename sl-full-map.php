<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sri Lanka District Map</title>
  <link rel="stylesheet" href="css/sl-full-map.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* Eye-catching button */
    #view-desti-btn {
      font-size: 20px;
      padding: 15px 30px;
      font-weight: bold;
      color: #fff;
      background: linear-gradient(45deg, #ff6a00, #ffcc00);
      border: none;
      border-radius: 12px;
      box-shadow: 0 6px 15px rgba(255, 165, 0, 0.5);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      text-decoration: none;
      display: inline-block;
    }

    #view-desti-btn:hover {
      transform: scale(1.1);
      box-shadow: 0 10px 25px rgba(255, 165, 0, 0.7);
    }

    /* Center the button below the map */
    .desti-btn-wrapper {
      margin-top: 30px;
      text-align: center;
      animation: pulseBtn 2s infinite;
    }

    @keyframes pulseBtn {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
    }
  </style>
</head>

<body>

  <div class="text-center" style="width: 100%; height: 100%;">
    <h2>Sri Lanka Districts</h2>

    <!-- Map container with embedded SVG -->
    <div id="map-container">
      <?php include 'assets/map.svg'; ?>
    </div>

    <!-- Tooltip that shows district name on hover -->
    <div id="ghost-tooltip"></div>

    <!-- District popup -->
    <div id="district-popup" class="hidden">
      <div id="popup-content">
        <button id="popup-close" class="popup-close-x">&times;</button>

        <h3 id="popup-title">District Name</h3>
        <p id="popup-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio.</p>

        <!-- Popup gallery container -->
        <div id="popup-gallery">
          <img src="assets/sl-full-map-images/sample1.png" class="popup-image" alt="Sample 1">
          <img src="assets/sl-full-map-images/sample2.png" class="popup-image" alt="Sample 2">
          <img src="assets/sl-full-map-images/sample3.png" class="popup-image" alt="Sample 3">
          <img src="assets/sl-full-map-images/sample4.png" class="popup-image" alt="Sample 4">
          <img src="assets/sl-full-map-images/sample5.png" class="popup-image" alt="Sample 5">
          <img src="assets/sl-full-map-images/sample6.png" class="popup-image" alt="Sample 6">
        </div>
      </div>
    </div>

    <!-- Eye-catching button to view desti-view.php -->
    <div class="desti-btn-wrapper">
      <a id="view-desti-btn" href="pages/desti-view.php">View Desti Page</a>
    </div>

  </div>

  <script src="js/sl-full-map.js"></script>
</body>

</html>