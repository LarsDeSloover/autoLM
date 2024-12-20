<?php include('../../include/startphp.inc.php');

if ($_POST['email']!=''){
  $admin = q_select_1_row('select * from admins where email = $1',[$_POST['email']]);
  if ($admin['id']>0 && password_verify($_POST['password'],$admin['password'])){
    $status=2;
    $_SESSION['admin_id'] = $admin['id'];
  }else{
    $status=1;
  };

}else{
  $status=0;
}


?>


<?php if ($status==2){?>
  
  
<div class="notification is-success">

  Login correct !
</div>

<script>
goto('/admin')
</script>


  
  
<?php }else{ 

if ($status==1){
  
?>
  
<div class="notification is-danger">
  Wrong email/password !
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

<button class="button is-warning mt-4" onclick="send()">Login</button>



<!--
<div class="content mt-3"><a href="logincas.php">or login using UGent-account</a></div>
-->


<div class="content mt-3 mb-0"><a href="/register">No account? Register now.</a></div>


<script>
function send(){
  data = {
    email: $('#email').val(),
    password: $('#password').val()
    
  }
  ajax_post('/ajax/account/login.php','cont', data)
  
}


</script>



<?php } ?>
