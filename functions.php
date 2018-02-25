<?php
echo "Funzioni\n";
function sr($method, $args){
global $token;
$query = http_build_query($args);
	file_get_contents("http://api.telegram.org/bot$token/$method?".$query);
}
function action($chatID, $action) {
$args = array(
"chat_id" => $chatID,
"action" => $action,
);
sr("sendChatAction", $args);
}
function sm($chatID, $msg, $menu= false, $keyboardtype = false, $parse_mode=false, $reply_to_message=false, $disablewebpreview = false) {
	global $token;
	global $config;
if (!$keyboardtype && $menu) {
$keyboardtype = $config['tastiera'];
}
if ($keyboardtype == "reply") {
	$rm = array('keyboard' => $menu,
'resize_keyboard' => true
);
} elseif ($keyboardtype == "inline") {
$rm = array('inline_keyboard' => $rmf,
);
} elseif ($keyboardtype == "nascondi") {

$rm = array('hide_keyboard' => true
);
}
$rm = json_encode($rm);
	
   if (!$parse_mode) {
	$parse_mode = $config['parse_mode'];
	}
	if (!$disablewebpreview) {
	$disablewebpreview = $config['disabilitapreview'];
		}
	$args = array(
	"chat_id" => $chatID,
	"text" => $msg,
	"parse_mode" => $parse_mode,
	"reply_to_message_id" => $reply_to_message,
	"disable_web_page_preview" => false,
	);
if($menu) $args['reply_markup'] = $rm;
	if ($config['action']) {
		action($chatID, "typing");
		}
	sr("sendMessage", $args);
	}