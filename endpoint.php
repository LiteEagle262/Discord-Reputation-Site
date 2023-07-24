<?php
include_once('config.php');

function getCurrentDate() {
    return date("m-d-Y");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    if (json_last_error() === JSON_ERROR_NONE) {
        if (isset($data['discord_id'], $data['vouch_content'], $data['api_key'], $data['discord_tag'])) {
            if ($data['api_key'] === $apikey) {

                $discord_tag = $data['discord_tag'];

                $vouches_file = 'vouches.json';
                $vouch_data = json_decode(file_get_contents($vouches_file), true);

                $vouch_data['vouch_count'] += 1;

                $new_vouch = array(
                    'vouch_id' => $vouch_data['vouch_count'],
                    'discord_tag' => $discord_tag,
                    'discord_id' => $data['discord_id'],
                    'vouch_content' => array(
                        'message_id' => $data['vouch_content']['message_id'],
                        'content' => $data['vouch_content']['content']
                    ),
                    'date' => getCurrentDate()
                );

                $vouch_data['vouches'][] = $new_vouch;

                file_put_contents($vouches_file, json_encode($vouch_data, JSON_PRETTY_PRINT));

                echo json_encode(array('status' => 'success', 'message' => 'Vouch received and stored successfully.', 'vouch_count' => $vouch_data['vouch_count']));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Invalid API key.'));
            }
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Required fields missing.'));
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Invalid JSON data.'));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request method.'));
}
