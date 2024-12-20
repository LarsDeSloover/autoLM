<?php include('include/startphp.inc.php');


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
    <script src="/js/scripts.js"></script>
    
        <style>
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .spinning {
            animation: spin 2s linear infinite;
        }
    </style>
    
    
</head>


<body>
<section class="section">
  <div class="container" id="container">

  </div>
</section>
</body>


</html>

<script>

project = <?php echo $_GET['project']; ?>;


var current_set = -99




function get_current_set(){
  $.get( "/ajax/student/get_current_set.php?project=<?php echo $_GET['project']; ?>", function( data ) {
    if (data!=current_set){
      current_set = data
      ajax_get('/ajax/student/screen.php?project='+project,'container')
    };
  });
}

get_current_set()
intervalId = setInterval(function() {
     get_current_set()
}, 2000);  
</script>