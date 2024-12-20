<?php include('../include/startphp.inc.php');

check_admin();


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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
</head>


<body>
<section class="section p-5">

<div class="columns">
  
<div class="column is-2" id="controls">
</div>

<div class="column">
<div class="box" style="height:calc(100vh - 60px)" id="qa"></div>
</div>

</div>

</section>
</body>


<script>

ajax_get("/ajax/admin/controls.php?project=<?php echo $_GET['project']; ?>", "controls")

var show_answers = false;

function refresh_qa(){
    ajax_get("/ajax/admin/qa.php?project=<?php echo $_GET['project']; ?>&show_answers="+show_answers, "qa")
}



</script>


</html>