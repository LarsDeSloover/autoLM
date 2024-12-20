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

<div class="box">

<h1 class="subtitle is-3">Login</h1>

<div class="columns">
<div class="column" id="cont">




</div>

<script>
ajax_get('/ajax/account/login.php','cont')

</script>

<div class="column">
</div>
</div>

<div class="notification is-light is-size-7">This tool is a test project developed by Ghent University, Department of Geography. It is intended solely for testing and research purposes and must not be used for commercial purposes or relied upon for professional or decision-making activities.
<br>
The tool is provided "as is," without any guarantees or warranties of any kind, express or implied. Ghent University and the Department of Geography disclaim all liability for any direct, indirect, incidental, or consequential damages arising from the use or inability to use this tool, including but not limited to inaccuracies, errors, or omissions.
<br>
This tool may collect test data for research and development purposes. All data collected will be handled in accordance with applicable data protection regulations. Users are advised to refrain from entering sensitive or personally identifiable information.
<br>
As this tool is under active development, features, functionality, and performance may change without prior notice. No formal support or maintenance is provided, and users assume all risks associated with its use.
<br>
All intellectual property rights, including but not limited to code, design, and content, remain the exclusive property of Ghent University. Unauthorized reproduction, modification, or distribution is strictly prohibited.
<br>
By using this tool, you acknowledge and accept these terms and conditions.</div>

</div>



</div>



</div>


  </div>
</section>
</body>



</html>