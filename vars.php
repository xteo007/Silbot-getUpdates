<?php
echo "Variabili";
$isedited = $update["edited_message"];
if ($isedited && $config["funziona_modificati"]) {
$update['message'] = $update['edited_message'];
if (!$config["funziona_modificati"]) {
return;
}
}
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
//media
$audio = $update["message"]["audio"]["file_id"];
$sticker = $update["message"]["sticker"]["file_id"];
$location = $update["message"]["location"];
$longitudine = $update["message"]["location"]["longitude"];
$latitudine = $update["message"]["location"]["latitude"];
$video = $update["message"]["video"]["file_id"];
$photo = $update["message"]["photo"][0]["file_id"];
$didascalia = $update["message"]["caption"];
//callback
if($update["callback_query"])
{
$cbid = $update["callback_query"]["id"];
$cbdata = $update["callback_query"]["data"];
$msg = $cbdata;
$cbmid = $update["callback_query"]["message"]["message_id"];
$chatID = $update["callback_query"]["message"]["chat"]["id"];
$userID = $update["callback_query"]["from"]["id"];
$nome = $update["callback_query"]["from"]["first_name"];
$cognome = $update["callback_query"]["from"]["last_name"];
$username = $update["callback_query"]["from"]["username"];
$fullname = $nome . " ". $cognome;
$lingua = $update["callback_query"]["from"]["language_code"];
}