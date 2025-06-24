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
  </div>

  <script src="js/sl-full-map.js"></script>
</body>
</html>