<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sri Lanka District Map</title>
  <link rel="stylesheet" href="css/sl-full-map.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        
        <button id="popup-close">Close</button>
      </div>
    </div>

  </div>

  <script src="js/sl-full-map.js"></script>
</body>

</html>