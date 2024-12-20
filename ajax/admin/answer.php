<?php include('../../include/startphp.inc.php');

check_admin();

$Q = q_select_1_row("select * from questions where id = $1",[$_GET['Q_id']]);



function tobold($text){
  $pattern = '/\*\*(.*?)\*\*/';
  $replacement = '<b>$1</b>';
  return preg_replace($pattern, $replacement, $text);
}


if ($_GET['action']=="regen"){
  
  
  $prompt = $Q['prompt'];
  $prompt = str_replace("\$question", '"'.$Q['question'].'"', $prompt);
  
  $responses = q_select('select * from answers where set_id = $1 and nmbr =$2',[$Q['set_id'],$Q['nmbr']]);
  
  $prompt = $prompt . '\n';
  
 // echo "(".count($responses).") ";
  
  foreach($responses as $response){
    if ($response['answer']!=''){
      $prompt = $prompt . ' /// ' . $response['answer'];
    }
  }
  
  q('insert into requests(question_id,chars)VALUES($1,$2)',[$_GET['Q_id'],strlen($prompt)]);
  
  
  // The endpoint for the GPT model, adjust as necessary
$url = 'https://api.openai.com/v1/chat/completions';

// Prepare your prompt with the survey responses
$messages = [
    [
        "role" => "system",
        "content" => "You are a helpful assistant."
    ],
    [
        "role" => "user",
        "content" => $prompt
        ]
];

// Configure your request payload
$data = [
   // "model" => "gpt-4",
   // "model" => "gpt-3.5-turbo",
       "model" => "gpt-4o-mini",
    "messages" => $messages,
    "max_tokens" => 200
];

// Initialize a cURL session
$ch = curl_init($url);

// Set the request method to POST
curl_setopt($ch, CURLOPT_POST, true);

// Attach the encoded JSON data
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    "Authorization: Bearer {$apiKey}",
]);

// Return the transfer as a string of the return value of curl_exec() instead of outputting it
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the request and capture the response
$response = curl_exec($ch);

// Check for errors
if(curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    // Parse the response
    $response_data = json_decode($response, true);
    
    // Extract and print the summary if available
    if (isset($response_data['choices'][0]['message']['content'])) {
        $summary = trim($response_data['choices'][0]['message']['content']);
    } else {
        echo "Error: Unable to generate summary.";
        print_r($response_data);
    }
}

// Close the cURL session
curl_close($ch);



  
  
  
  
  
  $result = $summary;
  

$result = tobold($result);
$result = nl2br($result);
$result = str_replace("  - ", "&nbsp;&nbsp;-&nbsp;", $result);
  
  q('update questions set generated_answer = $1 where id = $2',[$result, $Q['id']]);
  
  
  
  
}


$amount = q_select_1('select count(id) as tel from answers where set_id = $1 and nmbr =$2','tel',[$Q['set_id'],$Q['nmbr']]);


$Q = q_select_1_row("select * from questions where id = $1",[$_GET['Q_id']]);


?>


<div class="has-text-right is-size-6"><strong><?php echo $amount; ?> users answerd this question</strong> <button class="button is-small " onclick="$('#regen_btn_<?php echo $_GET['nmbr']; ?>').addClass('is-loading');response(<?php echo $_GET['Q_id'] ?>,<?php echo $_GET['nmbr']; ?>,'regen')" id="regen_btn_<?php echo $_GET['nmbr']; ?>">Regenerate answer</button></div>



<?php echo $Q['generated_answer']; ?>
