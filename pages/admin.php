<?php include('../include/startphp.inc.php');

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>autoLM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://kit.fontawesome.com/ad54cb37fc.js" crossorigin="anonymous"></script>
    <script src="/js/scripts.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
</head>


<body>
<section class="section">
  <div class="container">
  
<h1 class="title is-1">autoLM</h1>

<div class="columns">
<div class="column is-3" id="c1">


</div>
<div class="column" id="c2">


</div>


<script>ajax_get("/ajax/admin/projects.php","c1")</script>
</div>


  </div>
</section>
</body>

<script>
var project = 0;
</script>


</html>
