<?php
function sqlselect($a,$b,$c,$d){
	$r = "";
	$query = "SELECT ".$a." as out from ".$b." where ".$c."=$1";
	$result = pg_query_params($GLOBALS['dbconn'], $query, array(
	          $d
		)) or die ("error: ".pg_last_error($GLOBALS['dbconn']).' in functie sqlselect');                                
	while($var_gegevens = pg_fetch_array($result)) {
		$r = $var_gegevens['out'];
	}
	return $r;
}

function q_select($query, $ar = array()){
	$r = [];
	$result = pg_query_params($GLOBALS['dbconn'], $query, $ar) or die ("error in q_select: // ".$query." // ".pg_last_error($GLOBALS['dbconn']));              
	while($var_gegevens = pg_fetch_array($result)) {
		array_push($r, $var_gegevens);
	}
	return $r;
}

function q_select_1_row($query, $ar = array()){
	$result = pg_query_params($GLOBALS['dbconn'], $query, $ar) or die ("error in q_select_1_row: // ".$query." // ".pg_last_error($GLOBALS['dbconn']));              
	while($var_gegevens = pg_fetch_array($result)) {
		$r = $var_gegevens;
	}
	return $r;
}

function q_select_1($query, $column, $ar = array()){
	$result = pg_query_params($GLOBALS['dbconn'], $query, $ar) or die ("error in q_select_1: // ".$query." // ".pg_last_error($GLOBALS['dbconn']));
	while($var_gegevens = pg_fetch_array($result)) {
		$r = $var_gegevens[$column];
	}
  return $r;
}

function q($query, $ar = array()){
	@pg_query_params($GLOBALS['dbconn'], $query, $ar) or die ("error in q: // ".$query." // ".pg_last_error($GLOBALS['dbconn']));	
}

function q_insert_returning($query, $id, $ar = array()){
	$result = pg_query_params($GLOBALS['dbconn'], $query, $ar) or die ("error in q_insert_returning: // ".$query." // ".pg_last_error($GLOBALS['dbconn']));
	while($var_gegevens = pg_fetch_array($result)) {
		$r = $var_gegevens[$id];
	}
  return $r;
}

function stuurdoor($link){
      header("Location: ".$link);
      die;      
}

function column_to_row($in, $column){
  $out = [];
  foreach ($in as $row){
    array_push($out, $row[$column]);
  }
  return($out);
}

function check_admin(){
  if (!$_SESSION['admin_id']){
    echo 'no admin';
    die;
  }
}

?>