<?php include('../../include/startphp.inc.php');

if ($_POST['email']!=''){
  $idexists = sqlselect('id','admins','email',$_POST['email']);
  if($idexists>0){
    $status=1;
  }else{
    $status=2;
    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    q('insert into admins(email, password) VALUES($1,$2)',[$_POST['email'], $hash]);
  }
}else{
  $status=0;
}


?>


<?php if ($status==2){?>
  
  
<div class="notification is-success">

  Account created !
</div>

<a class="button" href="/">Login</a>
  
  
<?php }else{ 

if ($status==1){
  
?>
  
<div class="notification is-danger">
  Existing account !
</div>
  
  <?php } ?>

<div class="field">
  <label class="label">Email</label>
  <div class="control has-icons-left has-icons-right">
    <input class="input" type="email" placeholder="Email" id="email">
    <span class="icon is-small is-left">
      <i class="fas fa-envelope"></i>
    </span>
  </div>
</div>

<div class="field">
  <label class="label">Password</label>
  <div class="control has-icons-left has-icons-right">
    <input class="input" type="password" placeholder="Password" id="password">
    <span class="icon is-small is-left">
      <i class="fa-solid fa-lock"></i>
    </span>
  </div>
</div>

<button class="button is-warning mt-4" onclick="send()">Register</button>

<script>
function send(){
  data = {
    email: $('#email').val(),
    password: $('#password').val()
    
  }
  ajax_post('/ajax/account/register.php','cont', data)
  
}


</script>



<?php } ?>