<?php
ins:
$config['tipo_db'] =readLine("Tipo database (json/mysql):");
if ($config['tipo_db'] == "json") {
	touch("database.json");
echo "DATABASE INSTALLATO";	
	
} elseif ($config['tipo_db'] == "mysql") {
$config['ip'] =readLine("IP database (def. Localhost):");
$config['user'] =readLine("User database (def. root):");
$config['database'] =readLine("Nome database:");
$config['password'] =readLine("Password database:");
$config['tabella'] =readLine("Tabella database :");
$dbh = new PDO("mysql:host=" . $config["ip"] . ";dbname=".$config['database'], $config['user'], $config['password']); 
$tabella = $config['tabella'];
$dbh->query("CREATE TABLE IF NOT EXISTS ".$tabella." (
id int(0) AUTO_INCREMENT,
chat_id bigint(0),
username varchar(200),
page varchar(200),
PRIMARY KEY (id))");
} else {
echo "Errore: Tipo Database non trovato\n";
goto ins;
}

