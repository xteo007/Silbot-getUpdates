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
$rm = array('inline_keyboard' => $menu,
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
function em($chatID, $msg, $msgid, $menu= false, $keyboardtype = false, $parse_mode=false, $reply_to_message=false, $disablewebpreview = false) {
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
$rm = array('inline_keyboard' => $menu,
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
   "message_id" => $msgid,
	);
	sr("sendMessage", $args);
}
function cb_reply($id, $text, $alert = false, $cbmid = false, $ntext = false, $nmenu = false, $npm = "pred")
{
global $api;
global $chatID;
global $config;
if($npm == 'pred') $npm = $config['parse_mode'];
$args = array(
'callback_query_id' => $id,
'text' => $text,
'show_alert' => $alert
);
$r = sr("answerCallbackQuery", $args);
if($cbmid)
{
if($nmenu)
{
$rm = array('inline_keyboard' => $nmenu
);
$rm = json_encode($rm);
}
$args = array(
'chat_id' => $chatID,
'message_id' => $cbmid,
'text' => $ntext,
'parse_mode' => $npm,
);
if($nmenu) $args["reply_markup"] = $rm;
$r = sr("editMessageText", $args);
}
}