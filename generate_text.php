<?php

$data = array(
	'prompt' => $_POST['input_text'],
	'temperature' => $_POST['temperature'],
	'max_tokens' => $_POST['length'],
	'top_p' => $_POST['top_p'],
	'frequency_penalty' => $_POST['frequency_penalty'],
	'presence_penalty' => $_POST['presence_penalty']
);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://api.openai.com/v1/engines/davinci-3/completions');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Authorization: Bearer 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'
));

$response = curl_exec($curl);

if ($response === false) {
	echo 'Error: ' . curl_error($curl);
} else {
	$response_data = json_decode($response, true);

	if (isset($response_data['choices'][0]['text'])) {$text = $response_data['choices'][0]['text'];
		echo $text;
	} else {
		echo 'Error: Failed to generate text';
	}
}

curl_close($curl);