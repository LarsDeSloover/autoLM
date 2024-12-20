<?php include('../../include/startphp.inc.php');

$project = q_select_1_row('select * from projects where id = $1',[$_GET['project']]);

$set = $project['current_set'];
if ($project['current_set_admin']==0){$set = -1;}

echo $set;?>