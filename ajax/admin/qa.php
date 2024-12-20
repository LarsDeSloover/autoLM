<?php include('../../include/startphp.inc.php');

check_admin();






$project=q_select_1_row('select * from projects where id = $1',[$_GET['project']]);


if ($project['current_set_admin'] == 0){
  
?>





<div class="is-flex is-justify-content-center is-align-items-center" style="height: 100%;">
  <p class="has-text-centered is-size-1">
    <?php echo $project['name']; ?>
  </p>
</div>

<?php 

 
  
}else{
  
?>
<script>
function response(Q_id, nmbr,action){
  url="/ajax/admin/answer.php?Q_id="+Q_id+"&action="+action+"&nmbr="+nmbr
  ajax_get(url, "response_"+nmbr)
}

</script>

<div class="columns">

<?php
$i=1;
while($i<4){
  
  $Q = q_select_1_row("select * from questions where set_id = $1 and nmbr = $2",[$project['current_set_admin'],$i]);
  
  if ($Q['question']!=""){
?>
<div class="column">

<div class="has-text-centered is-size-<?php echo $_SESSION['tg']; ?>">
<center><b>
<?php echo $Q['question']; ?>
</b></center>
</div>

</div>

<?php
  }
  
  
$i++;
}
?>

</div>


<div class="columns">

<?php
$i=1;
while($i<4){
  
  $Q = q_select_1_row("select * from questions where set_id = $1 and nmbr = $2",[$project['current_set_admin'],$i]);
  
  if ($Q['question']!=""){
?>
<div class="column">



    
<div class="notification is-success is-light is-size-<?php echo $_SESSION['tg']; ?> pr-5 pt-2 pl-5 pb-5" id="response_<?php echo $i; ?>">


</div>

<script>
response(<?php echo $Q['id']; ?>,<?php echo $i; ?>,"none");

</script>


</div>

<?php
  }
  
  
$i++;
}
?>

</div>






<?php


}


?>







