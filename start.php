<?php
$token = "token";

$config = array(
"db" => true, // true per usare un database mysql, false per non usarlo
//DATABASE
"ip" => "localhost", // se non usi altervista metti l'indirizzo del database, di norma localhost se è hostato sullo stesso server
"user" => "root", //se non usi altervista inserisci il nome utente del DB
"password" => "psw", //se non usi altervista inserisci la password di mysql
"database" => "db", //se non usi altervista inserisci il nome del database
"tabella" => "tabella", //Tabella predefinita del bot
//TELEGRAM
"debug_mode" => false, //Metti true per mostrare gli errori, false per non mostrarli
"action" => true, //true per mandare azioni come typing... e false per non mandare nulla
"parse_mode"=> "html" ,//Formattazione presefinita messaggio, HTML, Markdown o none
"disabilitapreview" => false, //False per permettere il web preview, true per disabilitarla
"tastiera" => "inline" ,//Tastiera preferita, inline per quella inline e reply per la replykeyboard
"funziona_modificati" => true, //Scegli se far eseguire i messaggi modificati
"funziona_inoltrati" => false, //Scegli se far eseguire i messaggi inoltrati
);
if ($config['db']) {
	$db = new PDO("mysql:host=" . $config["ip"] . ";dbname=".$config['database'], $config['user'], $config['password']); 
	}
if ($config['debug_mode']) {
error_reporting(E_ALL);
} else {
error_reporting(0);
}
$save = array(
"save","token", "config", "db", "disable"//lista di variabili da salvare fra un'esecuzione e l'altra
);
echo "Bot started\n";
include("functions.php");
while(1) {
$l = file_get_contents("last.json");
$content = file_get_contents("http://api.telegram.org/bot$token/getUpdates?offset=-1");
if ($l == $content) {
} else {
$update = json_decode($content, true);
$update = $update['result'][0];
file_put_contents("last.json", $content);
include("vars.php");
if ($config['db']) {
include("database.php");
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
