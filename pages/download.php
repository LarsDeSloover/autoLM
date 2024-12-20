<?php include('../include/startphp.inc.php');

check_admin();

$data = q_select('select p.name as project_name, s.id as set_id, q.nmbr as question_id, q.question as question, 
an.answer as answer, an.student_session_id as student_id
from answers an, projects p, questions q, sets s
where p.id = s.project_id AND s.id = q.set_id 
AND q.set_id = an.set_id and q.nmbr = an.nmbr AND p.id =$1 
order by p.id, s.nmbr, s.id, q.nmbr',[$_GET['id']]);


// Set headers to force download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="export_data_autolm.csv"');

// Open a PHP output stream
$output = fopen('php://output', 'w');

// Write each row of the array to the CSV
fputcsv($output, ['project_name','set_id','question_id','question','answer','student_id']);
foreach ($data as $row) {
    fputcsv($output, [$row['project_name'],$row['set_id'],$row['question_id'],$row['question'],$row['answer'],$row['student_id']]);
}

// Close the output stream
fclose($output);
exit;

?>


