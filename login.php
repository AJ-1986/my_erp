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
                <div class="login_main_form">
                    <p class="login_adn">
                        Aby się zalogować wpisz login i hasło użytwkonika.
                    </p>
                    <div class="login_form">
                        <form method="post" action="function.php">
                            <table class="login_tbl_form">
                                <tr>
                                    <td class="login_tbl_form">Login:</td>
                                    <td class="login_tbl_form"><input type="text" name="login_uz"></td>
                                </tr>
                                <tr>
                                    <td class="login_tbl_form">Hasło:</td>
                                    <td class="login_tbl_form"><input type="password" name="haslo_uz"></td>
                                </tr>
                                <tr>
                                    <td class="login_tbl_form" colspan="2">
                                        <input class="login_reset" type="reset">&nbsp;&nbsp;|&nbsp;
                                        <input class="login_submit" type="submit" value="Zaloguj">
                                    </td>
                                </tr>
                            </table>
                        </form>                        
                    </div>
                    <div class="login_spacer"></div>
                </div>
            </div>
            <div class="login_footer">
                &copy MY_ERP <?php echo gmdate('Y'); ?>
            </div>
        </div>
    </body>
</html>