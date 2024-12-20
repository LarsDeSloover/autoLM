<?php
include('../../include/startphp.inc.php');


if (!$_SESSION['student_session']){
  $_SESSION['student_session'] = q_insert_returning('insert into student_sessions DEFAULT VALUES returning id','id',[]);
}


$project = q_select_1_row('select * from projects where id = $1',[$_GET['project']]);

$set = $project['current_set'];
if ($project['current_set_admin']==0){$set = -1;}



if ($set == -1){

?>


<center>

<span class="icon title is-1 mt-5 spinning" style="color:#F08">
<i class="fa-solid fa-hourglass-half"></i>
</span>

<h1 class="subtitle is-1 mt-5">The survey is closed</h1>

</center>



<?php }elseif ($set == 0){

?>


<center>

<span class="icon title is-1 mt-5 spinning" style="color:#F08">
<i class="fa-solid fa-hourglass-half"></i>
</span>

<h1 class="subtitle is-1 mt-5">Waiting for the next questions ...</h1>

</center>



<?php }else{ 



if ($project['current_set'] == $_GET['set_sent']){
 ?>

<center>
<span class="icon title is-1 mt-5 has-text-primary">
<i class="fa-solid fa-thumbs-up"></i>
</span>
<h1 class="subtitle is-1 mt-5">Response submitted !</h1>

<button class="button" onclick="ajax_get('/ajax/student/screen.php?project=<?php echo $_GET['project']; ?>','container')">Edit response</button>

<br><br></br>


<span class="icon title is-1 mt-5 spinning" style="color:#F08">
<i class="fa-solid fa-hourglass-half"></i>
</span>

<h1 class="subtitle is-3 mt-5">Waiting for the next questions ...</h1>
</center>


<?php 
 
  
}else{

$Q1 = q_select_1_row('select * from questions where nmbr = 1 AND set_id = $1',[$project['current_set']]);
$Q2 = q_select_1_row('select * from questions where nmbr = 2 AND set_id = $1',[$project['current_set']]);
$Q3 = q_select_1_row('select * from questions where nmbr = 3 AND set_id = $1',[$project['current_set']]);



function response($id, $project){
  return q_select_1('select answer from answers where set_id = $1 and nmbr = $2 and student_session_id = $3','answer',[$project['current_set'],$id,$_SESSION['student_session']]);

}

?>



        <!-- Page Title -->

        <h1 class="title"><?php echo $project['name'];?> </h1>


        <!-- Question 1 -->
        <div class="field">
            <label class="label"><?php echo $Q1['question']; ?></label>
            <div class="control">
                <textarea class="textarea is-medium" style="height: 120px; min-height: 120px" placeholder="response" maxlength="<?php echo $Q1['max_characters_students']; ?>" oninput="updateCounter(event,1)" id="Q_1"><?php echo response(1, $project); ?></textarea>
                <p class="help">0/<?php echo $Q1['max_characters_students']; ?> characters</p>
            </div>
        </div>
        
        <!-- Question 2 -->
        
        <?php if ($Q2['question']!=""){ ?>
        <div class="field">
            <label class="label"><?php echo $Q2['question']; ?></label>
            <div class="control">
                <textarea class="textarea is-medium" style="height: 120px; min-height: 120px" placeholder="response" maxlength="<?php echo $Q2['max_characters_students']; ?>" oninput="updateCounter(event,2)" id="Q_2"><?php echo response(2, $project); ?></textarea>
                <p class="help">0/<?php echo $Q2['max_characters_students']; ?> characters</p>
            </div>
        </div>
        
        <?php } ?>
        <?php if ($Q3['question']!=""){ ?>
        <!-- Question 3 -->
        <div class="field">
            <label class="label"><?php echo $Q3['question']; ?></label>
            <div class="control">
                <textarea class="textarea is-medium" style="height: 120px; min-height: 120px" placeholder="response" maxlength="<?php echo $Q3['max_characters_students']; ?>" oninput="updateCounter(event,3)" id="Q_3"><?php echo response(3, $project); ?></textarea>
                <p class="help">0/<?php echo $Q3['max_characters_students']; ?> characters</p>
            </div>
        </div>
        <?php } ?>
        
        <button class="button is-primary" onclick='next_page = true;to_next_page()'>Submit answers</button>

        
<script>

modified = []
modified[1] = 0 
modified[2] = 0 
modified[3] = 0
var next_page = false;

function updateCounter(event,id) {
    const textarea = event.target;
    const maxLength = textarea.maxLength;
    const currentLength = textarea.value.length;
    const counterElement = textarea.nextElementSibling; // Assumes the counter <p> is right after the textarea
    if (counterElement) {
        counterElement.textContent = currentLength+'/400 characters';
    }
    $("#button").addClass("is-loading");
    modified[id] = 1 
}


var intervalId

function start_save_questions(){
   intervalId = setInterval(function() {
     save_questions()
  }, 2000);  
}



function save_questions() {
    update_Q(1)
    update_Q(2)
    update_Q(3)
    to_next_page();
}


function to_next_page(){
  if (next_page && modified[1] == 0 && modified[2] == 0 && modified[3] == 0){
    next_page = false
    clearInterval(intervalId);
    ajax_get('/ajax/student/screen.php?project=<?php echo $_GET['project']; ?>&set_sent=<?php echo $project['current_set']; ?>','container')
  } 
}


function update_Q(id){
  
      if (modified[id] == 1){
      modified[id] = 0
      // Your POST request URL
      var postUrl = '/ajax/student/post.php';

      // Data you want to send with the POST request
      var postData = {
        response: $('#Q_'+id).val(),
        nmbr: id,
        set: <?php echo $project['current_set']; ?>
      };

      $.post(postUrl, postData, function(response) {
      });
    }
  
}


start_save_questions();


</script>


<?php 





}} ?>