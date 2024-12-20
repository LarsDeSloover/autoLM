<?php 

include('../../include/startphp.inc.php');

if ($_GET['action']=="add"){
  $set_id = q_insert_returning('insert into sets(project_id) VALUES($1) returning id','id',[$_GET['project']]);
  $i=1;
  while($i<4){
    q('insert into questions (set_id, nmbr) VALUES($1,$2)',[$set_id,$i]);
    $i++;
  }
}else{
  $set_id = $_GET['id'];
}



if ($_GET['action']=="save"){
  $i=1;
  while($i<4){
    q('update questions set question=$1, prompt=$2 where set_id = $3 and nmbr =$4',[$_POST['question_'.$i],$_POST['prompt_'.$i],$set_id,$i]);
    $i++;
  }
  echo '<script>ajax_get("/ajax/admin/sets.php?project='.$_GET['project'].'", "c2")</script>';
  die;
    
}






?>

<form id="editform">


<?php

$prompt_templates=q_select('select * from prompt_templates order by name asc',[]);


$i=1;
while($i<4){
  
  $vraag = q_select_1_row('select * from questions where set_id = $1 and nmbr = $2',[$set_id,$i]);
   
  ?>
  <div class="box mb-5">
  
<h3 class="subtitle is-3 mb-3">Question <?php echo $i; ?><?php echo $optional; ?></h3>


<div class="field">
  <label class="label">Question</label>
  <div class="control">
    <input class="input" type="text" placeholder="Question<?php echo $optional; ?>" value="<?php echo htmlentities($vraag['question']); ?>" name="question_<?php echo $i; ?>" id="question_<?php echo $i; ?>">
  </div>
</div>


<div class="field">
  <label class="label">Prompt</label>
  <div class="control">
  <textarea class="textarea" placeholder="Enter prompt here<?php echo $optional; ?>"  name="prompt_<?php echo $i; ?>" id="prompt_<?php echo $i; ?>"><?php echo htmlentities($vraag['prompt']); ?></textarea>
  <i>Use $question to insert the question in the prompt</i>
  </div>
</div>


<div class="field is-grouped">
  <div class="control">
    <div class="select">
      <select id="template_q_<?php echo $i; ?>">
        <option>Select prompt template</option>
        <?php
          foreach ($prompt_templates as $prompt_template){
            echo "<option value=".$prompt_template['id'].">".$prompt_template['name']."</option>";
          }
        ?>
      </select>
    </div>
  </div>
  <p class="control">
    <button class="button" onclick="prompt(<?php echo $i; ?>)">
      overwrite current prompt with this template
    </button>
  </p>
</div>

</div>

<?php 

$optional = ' (optional)';
$i++;

}
?>
</form>

<div>
<button class="button is-success" onclick='save()'>SAVE</button>
<span class="has-text-danger ml-5 mt-4 has-text-weight-bold	" id="fout">PLEASE FILL IN THE RED FIELDS!</span>
</div>

<script>
$('#fout').hide();


function save(){
  
  $('#prompt_1').removeClass('is-danger')
  $('#prompt_2').removeClass('is-danger')
  $('#prompt_3').removeClass('is-danger')
  $('#question_1').removeClass('is-danger')
  
  
  fout=false
  if ($('#prompt_1').val()==''){fout=true;$('#prompt_1').addClass('is-danger')}
  if ($('#question_2').val()!='' && $('#prompt_2').val()==''){fout=true;$('#prompt_2').addClass('is-danger')}
  if ($('#question_3').val()!='' && $('#prompt_3').val()==''){fout=true;$('#prompt_3').addClass('is-danger')}
  if ($('#question_1').val()==''){fout=true;$('#question_1').addClass('is-danger')}
  
  if (fout==false){
    formdata = read_formdata("editform")
    ajax_post("/ajax/admin/set.php?action=save&project=<?php echo $_GET['project'];?>&id=<?php echo $set_id;?>",'c2',formdata)
  }else{
    $('#fout').show()
  }
} 


$("#editform").submit(function(e){
    return false;
});

function prompt(q){
  p = $('#template_q_'+q).val()
 
    $.get( '/ajax/admin/get_prompt_template.php?id='+p, function( data ) {
    $("#prompt_"+q).val( data );
  });
}

</script>