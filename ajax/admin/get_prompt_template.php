<?php 

include('../../include/startphp.inc.php');

echo sqlselect('prompt','prompt_templates','id',$_GET['id'])

?>