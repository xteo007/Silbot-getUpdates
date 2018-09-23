<?php

echo "Database\n";
if ($config['tipo_db'] == "json"){
	$dbcontent = json_decode(file_get_contents($config["jsondbname"]), true);
	if (!$dbcontent[$chatID]) {
		if ($chatID == $userID) {
		$dbcontent[$chatID] = array(
		"chat_id" => $chatID,
		"username" => "$username",
		"page" => "",
		);
		} else {
		$dbcontent[$chatID] = array(
		"chat_id" => $chatID,
		"username" => "$usernamechat",
		"page" => "",
		);
		if (!in_array($userID, $dbcontent)) {
		$dbcontent[$userID] = array(
		"chat_id" => $userID,
		"username" => "$username",
		"page" => "group",
		);
		}
		}
	} else {
		if ($dbcontent[$chatID]["page"] == "ban") {
			sm($chatID, "Sei bannato dall'utilizzo del Bot.");
			$ban = true;
		}
	}
jsonsave();
} elseif ($config['tipo_db'] == "mysql") {
$tabella = $config['tabella'];
if ($chatID < 0) {
$q = $db->query("select * from $tabella where chat_id = $chatID");
if(!$q->rowCount())
{
$db->query("insert into `$tabella` (chat_id, page, username) values ($chatID, ''," . '"'. $usernamechat.'"'.")");
}
}
if($userID)
{
$q = $db->query("select * from $tabella where chat_id = $userID");
if(!$q->rowCount())
{
if ($userID == $chatID) {
$db->query("insert into `$tabella` (chat_id, page, username) values ($chatID, ''," . '"'. $username.'"'.")");
} else {
$db->query("insert into `$tabella` (chat_id, page, username) values ($userID, 'group'," . '"'. $username.'"'.")");
}
}else{
$u = $q->fetch(PDO::FETCH_ASSOC);

if($u['page'] == "disable")
{
$db->query("update $tabella set page = '' where chat_id = $chatID");
}
if($u['page'] == "ban")
{
sm($chatID, "Sei bannato dall'utilizzo del Bot.");
$ban = true;
}
}
}
}
