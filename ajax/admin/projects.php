<?php include('../../include/startphp.inc.php');

check_admin();

if ($_GET['action']=='new'){
  $new_project_id = q_insert_returning('insert into projects(admin_id) VALUES($1) returning id','id',[$_SESSION['admin_id']]);
  q('update projects set name = $1 where id = $2',['New survey ('.$new_project_id.')',$new_project_id]);
}


?>


<nav class="panel">
  <p class="panel-heading">Surveys</p>



<?php

$projects = q_select('select * from projects where admin_id = $1 order by name',[$_SESSION['admin_id']]);


foreach ($projects as $project){


?>


  <a class="panel-block project" onclick="set_project(<?php echo $project['id']; ?>)" id="project_<?php echo $project['id']; ?>">
    <span class="panel-icon">
      <i class="fa-solid fa-file-circle-question"></i>
    </span>
    <?php echo $project['name']; ?>
  </a>

<?php

}

?>


  <div class="panel-block">
    <button  onclick="new_project()" class="button is-link is-outlined is-fullwidth">
      New survey
    </button>
  </a>


</nav>


<script>


function set_project(id){
  project = id;
  $('.project').removeClass('is-active');
  $('.project').removeClass('has-background-info');
  $('#project_'+id).addClass('is-active');
  $('#project_'+id).addClass('has-background-info');
  ajax_get('/ajax/admin/sets.php?project='+id,'c2')
}

function new_project(){
  ajax_get("/ajax/admin/projects.php?action=new","c1")
}


<?php if ($_GET['action']=='new'){
  echo "set_project(".$new_project_id.");";
}
?>

if (project > 0){
  set_project(project)
}

</script>