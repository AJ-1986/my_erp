<?php
session_start();
include './db_config.php'; // plik konfiguracyjny bazy

// link do połączenia z bazą danych
$pol_db = mysqli_connect($dbhost, $dbusername, $dbuserpassword, $default_dbname);
global $pol_db;
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
        <title>MY ERP</title>
        <link rel="stylesheet" href="main_style.css">
        <script>
            function form_ed_danych_uz(status1, status2) {
                document.getElementById('ed_danych_uz').style.display = status1;
                document.getElementById('form_nav_uz_a2').style.display = status2;
                document.getElementById('form_nav_uz_b2').style.display = status1;
            }
            function form_ed_hasla_uz(status1, status2) {
                document.getElementById('ed_hasla_uz').style.display = status1;
                document.getElementById('form_nav_uz_a3').style.display = status2;
                document.getElementById('form_nav_uz_b3').style.display = status1;
            } 
            function form_tw_nowego_uz(status1, status2) {
                document.getElementById('tworzenie_uz').style.display = status1;
                document.getElementById('form_nav_uz_a1').style.display = status2;
                document.getElementById('form_nav_uz_b1').style.display = status1;
            }                
        </script>
    </head>
    <body>        
        <?php
            if(!empty($_SESSION['log_id']) AND $_SESSION['log_ok'] == $_SESSION['log_id'])
            {
        ?>
        <div class="main_page">
            <div class="main_header">
                <span class="logo">MY_ERP</span>                
                <span class="right_nav_header">
                    <a class="link_header" href="index.php?auth=1&strona_glowna=1">Strona główna</a>&nbsp;&nbsp;|&nbsp;
                    <a class="link_header" href="index.php?auth=1&ustawienia=1">Ustawienia</a>&nbsp;&nbsp;|&nbsp;
                    <a class="link_header" href="function.php?wyloguj=1">Wyloguj</a>
                </span>                
            </div>            
            <div class="left_site">
                <span class="index_left_podmiot">
                    <p class="index_left">
                        Aktualnie pracujesz na podmiocie:
                        <?php
                            // pobieranie podmiotów z bazy danych
                                $q = "SELECT nazwa_podmiotu FROM podmioty WHERE id_podmiotu LIKE '$_SESSION[podmiot_id]'";
                                $sql = mysqli_query($pol_db, $q);

                                while($query_data = mysqli_fetch_row($sql)) {
                                    echo '<b>'. $query_data[0] .'</b>';
                                }                                
                            //-----------------------------------
                        ?>
                    </p>
                    <form method="post" action="function.php">
                        <p class="login_adn">
                        <input type="hidden" name="pod_f" value="1">
                        <label class="login_pod_adn" for="podmiot">Podmiot:</label>
                        <select class="login_pod_list" id="podmiot" name="podmiot">
                            <?php
                            // pobieranie podmiotów z bazy danych
                                $q2 = "SELECT *  FROM podmioty";
                                $sql2 = mysqli_query($pol_db, $q2);

                                while($query_data2 = mysqli_fetch_row($sql2)) {
                                    echo '
                                        <option value="'. $query_data2[0] .'">'. $query_data2[1] .'</option>                                        
                                    ';
                                }                                
                            //-----------------------------------
                            ?>
                        </select><br><br>
                        <input class="login_submit" type="submit" value="Zmień">
                        </p>
                    </form>
                </span><hr>
                <span class="left_main_navigation">
                    <a href="index.php"><img class="img_buttons" src="images/faktury_sprzedazy_button.jpg" alt="Faktury sprzedaży"></a><br><br>
                    <a href="index.php"><img class="img_buttons" src="images/faktury_zakupu_button.jpg" alt="Faktury zakupu"></a><br><br>
                    <a href="index.php"><img class="img_buttons" src="images/kontrahenci_button.jpg" alt="Kontrahenci"></a><br><br>
                    <a href="index.php"><img class="img_buttons" src="images/magazyn_button.jpg" alt="Magazyn"></a><br><br>
                    <a href="index.php"><img class="img_buttons" src="images/raporty_button.jpg" alt="Raporty"></a><br><br>
                </span>
            </div>
            <div class="right_site">
                <p class="demo">
                    <br>
                    Wersja DEMO. Narzędzie w trakcie rozwoju. Codziennie nowe funkcje!<br>
                    Więcej na <a href="https://github.com/AJ-1986/my_erp/tree/my_erp_1.0">https://github.com/AJ-1986/my_erp/tree/my_erp_1.0</a><br>&nbsp;
                </p>
                <?php
                    if($_GET['auth'] == '1') {
                        // strona główna
                        if($_GET['strona_glowna'] == '1') {
                            include './strona_glowna.php'; // podłączenie pliku strona_glowna.php
                        }
                        // ------------

                        // ustawienia
                        if($_GET['ustawienia'] == '1') {
                            include './ustawienia.php'; // podłączenie pliku ustawienia.php
                        }
                        // ------------

                        // historia zdarzeń
                        if($_GET['historia_zd'] == '1') {
                            include './historia_zd.php'; // podłączenie pliku historia_zd.php
                        }
                        // ------------
                    }
                ?>
            </div>
            <div class="spacer"></div>            
            <div class="footer">
                <p class="footer">&copy; MY_ERP <?php echo gmdate('Y'); ?></p>                    
            </div>            
        </div>        
        <?php
            mysqli_close($pol_db);
            }
            else
            {
        ?>
                <script>
                    document.location='login.php';
                </script>
        <?php
            }
        ?>
    </body>
</html>