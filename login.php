<?php
include './db_config.php'; // plik konfiguracyjny bazy

// link do połączenia z bazą danych
$pol_db = mysqli_connect($dbhost, $dbusername, $dbuserpassword, $default_dbname);
// --------------------------------
?>
<!DOCTYPE html>
<html lang="pl-PL">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <meta name="autor" content="Adam Jurewicz (proxweb@outlook.com)">
        <title>MY ERP - logowanie</title>
        <link rel="stylesheet" href="main_style.css">
    </head>
    <body>
        <div class="login_main_page">
            <div class="login_header">
                <h1 class="login_h1">MY ERP - logowanie</h1>
            </div>
            <div class="login_main_page">
                <div class="login_form">

                </div>
            </div>
            <div class="login_footer">
                
            </div>
        </div>
    </body>
</html>