<?php include('../../include/startphp.inc.php');

check_admin();


if ($_GET['action']=="order"){
  $i=0;
  foreach ($_POST['order'] as $id){
    $arr = explode("_",$id);
    $id = $arr[1];
    q('update sets set nmbr = $1 where id = $2',[$i,$id]);
    $i++;
  }
}


if ($_GET['action']=="delete"){
    q('delete from sets where id = $1',[$_GET['id']]);
}

if ($_GET['action']=="new_name"){
    q('update projects set name = $1 where id = $2',[$_POST['name'],$_GET['project']]);
    echo '<script>ajax_get("/ajax/admin/projects.php","c1")</script>'; 
}


$project=q_select_1_row('select * from projects where id = $1',[$_GET['project']]);

$sets=q_select('select * from sets where project_id = $1 order by nmbr, id',[$_GET['project']]);


function vraag($set,$nmbr){
  return substr(q_select_1('select question from questions where nmbr=$1 and set_id=$2','question',[$nmbr,$set]),0,30);
}

?>

<div class="columns">
<div class="column is-8" id="t1">
<h3 class="subtitle is-2 mb-3"><?php echo $project['name']; ?><?php echo $optional; ?>

<button class="button mt-2" onclick="edit_title()">
    <span class="icon">
        <i class="fas fa-edit"></i>
    </span>
</button>
</h3>

</div>



<div class="column is-8" id="t2">
<div class="columns">
<div class="column is-8">
<input   class="input is-medium" type="text" value="<?php echo htmlentities($project['name']); ?>" id="new_name">
</div>
<div class="column">
<button class="button is-outlined is-success" onclick="new_name()">SAVE</button>
<button class="button" onclick="cancel_new_name()">cancel</button>
</div>
</div>
</div>




<div class="column">
<?php if ($sets[0]){ ?>
<a class='button is-success' href="/screen/<?php echo $project['id'];?>">OPEN SURVEY</a>
<a class='button' href="/download/<?php echo $project['id'];?>">download CSV</a>
<?php } ?>
</div>
</div>


<ul id="sortable" class="content">

<?php 

  foreach($sets as $set){
    echo '<li class="box pt-2 pb-2 mb-2" style="cursor: move" id="set_'.$set['id'].'">
    <div class="columns"><div class="column pt-5">
    '.vraag($set['id'],1).'
    </div><div class="column pt-5">
    '.vraag($set['id'],2).'
    </div><div class="column pt-5">
    '.vraag($set['id'],3).'
    </div><div class="column">
    <a class="button is-warning  is-outlined" onclick="edit('.$set['id'].')">Edit</a>
    <a class="button is-danger  is-outlined" onclick="del1('.$set['id'].')">Delete</a>
    </div></div>
    </li>';
    
  }
?>
</ul>

<button class="button is-success is-outlined" onclick='add()'>ADD QUESTION</button>

  <script>
  $('#t2').hide();
  
  function edit_title(){
    $('#t1').hide();
    $('#t2').show();
  }
  
  
  function new_name(){
    ajax_post('/ajax/admin/sets.php?action=new_name&project='+project,'c2',{name: $('#new_name').val()})
  }
  
  
  function cancel_new_name(){
    $('#t1').show();
    $('#t2').hide();
  }
  

  $( "#sortable" ).sortable({
    update: function( event, ui ) {geef_id_volgorde()}
  });
  
  var IDs = [];
  
  function geef_id_volgorde(){
    IDs = [];
    $("#sortable").find("li").each(function(){ IDs.push(this.id); });
    console.log(IDs)
    ajax_post('/ajax/admin/sets.php?action=order&project='+project,'c2',{order: IDs})
  }
  
  function edit(id){
    ajax_get("/ajax/admin/set.php?project="+project+"&id="+id, "c2")
  }
  
  function add(){
    ajax_get("/ajax/admin/set.php?action=add&project="+project, "c2")
  }
  
  function del1(id){
    $('#set_'+id).html('<b>Do you want to delete this question ???</b> <button class="button is-danger" onclick="del2('+id+')">yes</button> <button class="button is-success" onclick="refresh()">no</button> ')
  }
  
  function del2(id){
    ajax_get("/ajax/admin/sets.php?action=delete&id="+id+'&project='+project, "c2")
  }
  
  function refresh(){
    ajax_get("/ajax/admin/sets.php?project="+project, "c2")
  }
  
  </script>

