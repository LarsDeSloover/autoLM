<?php 
include('../../include/startphp.inc.php');

if (!$_SESSION['student_session']){
  $_SESSION['student_session'] = q_insert_returning('insert into student_sessions DEFAULT VALUES returning id','id',[]);
}




$tel = q_select_1('select count(id) as tel from answers where set_id = $1 and nmbr = $2 and student_session_id = $3','tel',[$_POST['set'], $_POST['nmbr'],$_SESSION['student_session']]);
if ($tel==0){
  q('insert into answers (set_id, nmbr, student_session_id, answer) VALUES($1,$2,$3,$4)',[$_POST['set'], $_POST['nmbr'],$_SESSION['student_session'], $_POST['antwoord']]);
}else{
  q('update answers set answer = $4 where set_id = $1 and nmbr = $2 and student_session_id = $3',[$_POST['set'], $_POST['nmbr'],$_SESSION['student_session'], $_POST['antwoord']]);
}


?>
