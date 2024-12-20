<?php include('../../include/startphp.inc.php');

check_admin();

if ($_SESSION['tg']=="") {$_SESSION['tg'] = 3;}

if ($_GET['action']=='gotoset'){
  q('update projects set current_set_admin = $1 where id = $2',[$_GET['id'],$_GET['project']]);
  q('update projects set current_set = $1 where id = $2',[$_GET['id'],$_GET['project']]);
}
if ($_GET['action']=='start'){
  $set_id = q_select_1('select id from sets where project_id = $1 order by nmbr, id limit 1','id',[$_GET['project']]);
  q('update projects set current_set_admin = $1 where id = $2',[$set_id,$_GET['project']]);
  q('update projects set current_set = $1 where id = $2',[$set_id,$_GET['project']]);
}
if ($_GET['action']=='stop'){
  q('update projects set current_set_admin = $1 where id = $2',[0,$_GET['project']]);
  q('update projects set current_set = $1 where id = $2',[0,$_GET['project']]);
}

if ($_GET['action']=='enable'){
  $set_id = sqlselect('current_set_admin','projects','id',$_GET['project']);
  q('update projects set current_set = $1 where id = $2',[$set_id,$_GET['project']]);
}

if ($_GET['action']=='disable'){
  q('update projects set current_set = $1 where id = $2',[0,$_GET['project']]);
}


if ($_GET['action']=='larger'){
  if ($_SESSION['tg']>1) {$_SESSION['tg'] = $_SESSION['tg']-1;};
}

if ($_GET['action']=='smaller'){
  if ($_SESSION['tg']<7) {$_SESSION['tg'] = $_SESSION['tg']+1;};
}


$project=q_select_1_row('select * from projects where id = $1',[$_GET['project']]);

$sets = q_select('select * from sets where project_id = $1 order by nmbr',[$_GET['project']]);
$sets = column_to_row($sets, 'id');

$position = array_search($project['current_set_admin'], $sets);

?>



<h1 class="title is-2">autoLM</h1>


<?php if ($project['current_set_admin']==0){ ?>
<button class="button is-outlined is-success is-fullwidth" onclick="control('start')">
  <span class="icon is-small">
    <i class="fa-solid fa-circle-play"></i>
  </span>
  <span>
    Start Survey
  </span>
</button>

<a class="button is-fullwidth mt-5" href="/admin">
  <span class="icon is-small">
    <i class="fa-regular fa-circle-xmark"></i>
  </span>
  <span>
    Back to adminpage
  </span>
</a>

<?php }else{ ?>

<button class="button is-outlined is-danger is-fullwidth" onclick="control('stop')">
  <span class="icon is-small">
    <i class="fa-solid fa-circle-stop"></i>
  </span>
  <span>
    Stop Survey
  </span>
</button>

<div class="columns mt-5">
<div class="column py-0">


<button class="button is-fullwidth" onclick="control('gotoset',<?php echo $sets[$position-1]; ?>)" <?php if ($sets[0]==$project['current_set_admin']){ echo ' disabled';}?>>
  <span class="icon is-small">
    <i class="fa-solid fa-backward"></i>
  </span>
  <span>
    Prv
  </span>
</button>


</div>

<div class="column  py-0">
<button class="button is-fullwidth" onclick="control('gotoset',<?php echo $sets[$position+1]; ?>)" <?php if (end($sets)==$project['current_set_admin']){ echo ' disabled';}?>>
  <span>
    Nxt
  </span>
  <span class="icon is-small">
    <i class="fa-solid fa-forward"></i>
  </span>
</button>
</div>

</div>





<?php if ($project['current_set']>0){ ?>
<button class="button is-fullwidth mt-5" onclick="control('disable')">
  <span class="icon is-small">
    <i class="fa-solid fa-ban"></i>
  </span>
  <span>
    Disable user input
  </span>
</button>
<?php }else{ ?>
<button class="button is-fullwidth mt-5" onclick="control('enable')">
  <span class="icon is-small">
    <i class="fa-solid fa-keyboard"></i>
  </span>
  <span>
    Enable user input
  </span>
</button>
<center class="has-text-danger">User input is disabled!</center>

<?php 

}?>

<div class="columns mt-5">
<div class="column py-0">
<button class="button is-fullwidth"  onclick="control('smaller')" <?php if($_SESSION['tg']==7){echo 'disabled';}?>>
  <span class="icon is-small">
    <i class="fa-solid fa-magnifying-glass-minus"></i>
  </span>

</button>
</div>

<div class="column  py-0">
<button class="button is-fullwidth" onclick="control('larger')" <?php if($_SESSION['tg']==1){echo 'disabled';}?>>
  <span class="icon is-small">
    <i class="fa-solid fa-magnifying-glass-plus"></i>
  </span>
</button>
</div>

</div>


<?php
} 
?>


<div id="qrcode" class="mt-5 py-2">

</div>

<div class="is-size-5">
<center>autoLM.ugent.be/<?php echo $_GET['project']; ?></center>
</div>

<script>
refresh_qa()


function control(action, id = 0){
  if (action == 'start'){
    show_answers = false;
  }
  url = "/ajax/admin/controls.php?project=<?php echo $_GET['project']; ?>&action="+action+"&id="+id
  ajax_get(url, "controls")
}



        qrcode = new QRCode(document.getElementById("qrcode"), {
            text: "https://autolm.ugent.be/<?php echo $_GET['project']; ?>",
            width: 300,
            height: 300,
        });




</script>

