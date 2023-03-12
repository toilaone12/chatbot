<?php
// Define the URL of the DialoGPT API endpoint
$api_url = 'https://api-inference.huggingface.co/models/microsoft/DialoGPT-large';

// Define the authorization token for the API
$auth_token = 'Bearer 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';

// Define the input text to send to the API
$input_text = $_POST['question'];
// echo $input_text;
if($input_text !== ''){

    // Define the request data as an array
    $data = array(
        'inputs' => $input_text,
        'options' => array(
            'user_name' => 'John Doe'
        )
    );
    
    // Define the request headers, including the authorization token
    $headers = array(
        'Authorization: '.$auth_token,
        'Content-Type: application/json'
    );
    
    // Initialize a new cURL session
    $ch = curl_init($api_url);
    
    // Set the cURL options for the request
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    // Execute the cURL request and get the response
    $response = curl_exec($ch);
    
    // Close the cURL session
    curl_close($ch);
    
    // Parse the response JSON and print the chatbot's generated response
    $response_data = json_decode($response, true);
    echo $response_data['generated_text'];
}else{
    echo 'fail';
}
?>
