<?php

echo "Database\n";

$tabella = $config['tabella'];
if ($chatID) {
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
exit;
}
}
}
