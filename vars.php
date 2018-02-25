<?php
echo "Variabili";
$isedited = $update["edited_message"];
if ($isedited && $config["funziona_modificati"]) {
$chatID = $update["edited_message"]["chat"]["id"];
$userID = $update["edited_message"]["from"]["id"];
$msg = $update["edited_message"]["text"];
$msgid = $update["edited_message"]["message_id"];
$isbot = $update["edited_message"]["from"]["is_bot"];
$nome = $update["edited_message"]["from"]["first_name"];
$cognome = $update["edited_message"]["from"]["last_name"];
$fullname = $nome . " ". $cognome;
$username = $update["edited_message"]["from"]["username"];
$lingua = $update["edited_message"]["from"]["language_code"];
$chat_type = $update["edited_message"]["chat"]["type"];
if ($chatID < 0) {
$titolo = $update["edited_message"]["chat"]["title"];
$username = $update["edited_message"]["chat"]["username"];
}
if (!$config["funziona_modificati"]) {
return;
}
} else {
$chatID = $update["message"]["chat"]["id"];
$userID = $update["message"]["from"]["id"];
$msg = $update["message"]["text"];
$msgid = $update["message"]["message_id"];
$isbot = $update["message"]["from"]["is_bot"];
$nome = $update["message"]["from"]["first_name"];
$cognome = $update["message"]["from"]["last_name"];
$fullname = $nome . " ". $cognome;
$username = $update["message"]["from"]["username"];
$lingua = $update["message"]["from"]["language_code"];
$chat_type = $update["message"]["chat"]["type"];
if ($chatID < 0) {
$titolo = $update["message"]["chat"]["title"];
$username = $update["message"]["chat"]["username"];
}
}