# SilverOSbase getUpdates
Base per bot telegram in php che usa il metodo getupdates.
La base funziona solo su VPS.
Versioni php testate: 5.0, 7.0

# Installazione:(Ubuntu e debian)
- - -
Installa i pacchetti `apt-get install screen php-json php php-curl -y`

 `wget https://github.com/SilverOS/silverosbase/archive/master.zip`

 `unzip master.zip`
 
 `cd silverosbase-master`
# DATABASE MYSQL
- - -
Dall'aggiornamento alla 0.5 la base supporta le connessioni a mysql integrate tramite PDO.

Installare il database è fondamentale per l'uso di alcuni plugin.
*SE NON SI VUOLE USARE IL DATABASE MYSQL BASTA IMPOSTARE A false IL CAMPO DB DEL CONFIG*
Installazione del database:
 `php db_install.php`
Avvia la procedura di installazione, compila tutti i campi come ti viene chiesto.
 A questo punto modificate le impostazioni nel config in start.php riguardanti mysql.
# Start del bot
 - - -
1) Cambia il token in start.php
2) Configura il config in start.php
3) Modifica il bot in comandi.php
4) Esegui `screen -S bot` per tenre il bot online
5) Esegui `php start.php`
	

