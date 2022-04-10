<?php
include './db_config.php'; // plik konfiguracyjny bazy

// link do połączenia z bazą danych
$pol_db = mysqli_connect($dbhost, $dbusername, $dbuserpassword, $default_dbname);
// --------------------------------
?>