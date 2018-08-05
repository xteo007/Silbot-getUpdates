<?php
$token = "TOKEN";
$admin = array( //inserisci gli ID degli admin per il plugin utenti
141691961,
1123344,);
$config = array(
"db" => true, // true per usare un database mysql, false per non usarlo
"tipo_db" => "mysql", //"mysql" per un database mysql, "json" per un database attraverso file json

//DATABASE
"ip" => "localhost", // se non usi altervista metti l'indirizzo del database, di norma localhost se è hostato sullo stesso server
"user" => "root", //se non usi altervista inserisci il nome utente del DB
"password" => "psw", //se non usi altervista inserisci la password di mysql
"database" => "db", //se non usi altervista inserisci il nome del database
"tabella" => "tabella", //Tabella predefinita del bot
"antiflood" => false,//true per abilitare l'antiflood, false per disabilitarlo. Trovi il file in plugins/antiflood.php. Funziona solo con Mysql
//TELEGRAM
"debug_mode" => false, //Metti true per mostrare gli errori, false per non mostrarli
"action" => true, //true per mandare azioni come typing... e false per non mandare nulla
"parse_mode"=> "html" ,//Formattazione presefinita messaggio, HTML, Markdown o none
"disabilitapreview" => false, //False per permettere il web preview, true per disabilitarla
"tastiera" => "inline" ,//Tastiera preferita, inline per quella inline e reply per la replykeyboard
"funziona_modificati" => true, //Scegli se far eseguire i messaggi modificati
"funziona_inoltrati" => false, //Scegli se far eseguire i messaggi inoltrati
);
if ($config['db'] && $config['tipo_db'] == "mysql") {
	$db = new PDO("mysql:host=" . $config["ip"] . ";dbname=".$config['database'], $config['user'], $config['password']); 
}
if ($config['debug_mode']) {
error_reporting(E_ALL);
} else {
error_reporting(0);
}
$save = array(
"save","token", "config", "db", "disable", "offset", "admin"//lista di variabili da salvare fra un'esecuzione e l'altra
);
echo "Bot started\n";
include("functions.php");
$c1 = file_get_contents("http://api.telegram.org/bot$token/getUpdates?offset=-1");
$up1 = json_decode($c1, true);
$offset = $up1["result"][0]["update_id"];
if (!$offset) {
	echo "\nC'è stato un errore con l'offset, per risolverlo invia un update al bot e riavvia lo script\n";
	exit;
}
while(1) {
$l = file_get_contents("last.json");
$content = file_get_contents("http://api.telegram.org/bot$token/getUpdates?offset=$offset");
if ($l == $content || $content == '{"ok":true,"result":[]}') {
} else {
$offset++;
file_put_contents("last.json", $content);
$update = json_decode($content, true);
$update = $update["result"][0];
include("vars.php");
if (in_array($chatID, $admin))  {$isadmin = true;}
if ($config['db']) {
include("database.php");
if ($ban) {
$vars = array_keys(get_defined_vars());
foreach ($vars as $var) {
if (in_array($var, $save)) {
} else {
    unset($$var);
}
}
unset($vars);
continue;
}
}

include("comandi.php");
$plugins = scandir("plugins");
$disable = array("pluginno.php");
foreach ($plugins as $plugin) {
if (!in_array($plugin, $disable)) {
include("plugins/$plugin");
}
}
echo $content. "\n";	
echo "👥ChatID => $chatID
👤UserID => $userID
💬Message => $msg\n";

$vars = array_keys(get_defined_vars());
foreach ($vars as $var) {
if (in_array($var, $save)) {
} else {
    unset($$var);
}
}
unset($vars);
}
}
?>
