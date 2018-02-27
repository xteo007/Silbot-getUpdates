<?php
$token = "TOKEN";
$config = array(
"action" => true, //true per mandare azioni come typing... e false per non mandare nulla
"parse_mode"=> "html" ,//Formattazione presefinita messaggio, HTML, Markdown o none
"disabilitapreview" => false, //False per permettere il web preview, true per disabilitarla
"tastiera" => "inline" ,//Tastiera preferita, inline per quella inline e reply per la replykeyboard
"funziona_modificati" => true, //Scegli se far eseguire i messaggi modificati
);
$save = array(
"save","token", "config", //lista di variabili da salvare fra un'esecuzione e l'altra
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
include("comandi.php");
echo $content. "\n";	
echo $msg;

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
