<?php
session_start();
include './db_config.php'; // plik konfiguracyjny bazy
// link do połączenia z bazą danych
$pol_db = mysqli_connect($dbhost, $dbusername, $dbuserpassword, $default_dbname);
global $pol_db;
// --------------------------------

// funkcja odpowiadająca za poprawne logowanie
if($_POST['logowanie'] == '1') {
    
    if(!$pol_db) die('Błąd z połączeniem - sprawdź dane do bazy danych');
    else {
        $haslo_md5 = md5($_POST['haslo_uz']);        
        $q = "SELECT id_uz  FROM uzytkownicy WHERE login LIKE '$_POST[login_uz]' AND haslo LIKE '$haslo_md5'";
        $sql = mysqli_query($pol_db, $q);

        if(!$query_data = mysqli_fetch_row($sql)) {
            echo '
            <script>
                document.location="login.php?blad=1";
            </script>
            ';
        }
        else {

            // tworzenie zmiennej sesyjnej z id zalogowanego użytkownika
            $_SESSION['user_SQL_id'] = $query_data[0];
            // --------------------------------------------------------- 

            // zapis informacji o logowaniu w logu systemu zdarzeń
            $akt_data = gmdate('Y-m-d');
            $akt_godz = gmdate('H:i:s');
            $kom_zd = 'Udane logowanie użytkownika.';
            $q = "INSERT INTO system_log (log_id, user_id, data, godzina, zdarzenie)
                    VALUES (NULL, '$query_data[0]', '$akt_data', '$akt_godz', '$kom_zd')";
            $sql = mysqli_query($pol_db, $q);

            if(!$sql) die('Coś poszło nie tak z rejestracją logowania... sprawdź bazę danych');            
            // ---------------------------------------------------

            for ($licz=1; $licz<=10; $licz++)
            {
                $losowa_liczba = rand(1, 99);
                $liczba_wygenerowana .= $losowa_liczba;                
            }
            
            $id_ses = md5($_POST['login_uz'] .= $liczba_wygenerowana .= $_POST['haslo_uz']);
            $_SESSION['log_ok'] = $id_ses;
            $_SESSION['log_id'] = $id_ses;
            echo '
            <script>
                document.location="login.php";
            </script>';
        } 
    }

mysqli_close($pol_db);
}
// -------------------------------------------

// funkcja aktualizuje haslo uzytkownika
if(!empty($_SESSION['log_id']) AND $_SESSION['log_ok'] == $_SESSION['log_id']) {
    if($_POST['aktualizacja_hasla_uz'] == '1') {
        
        if(!empty($_POST['paswd_uz1']) AND !empty($_POST['paswd_uz2']) AND $_POST['paswd_uz1'] == $_POST['paswd_uz2']) {

        }
    }
}
// -------------------------------------

// funkcja aktualizuje dane uzytkownika
if(!empty($_SESSION['log_id']) AND $_SESSION['log_ok'] == $_SESSION['log_id']) {
    if($_POST['aktualizacja_danych_uzytkownika'] == '1') {

        $q = "UPDATE `uzytkownicy` SET `imie` = '$_POST[imie_uz]', 
                `nazwisko` = '$_POST[nazwisko_uz]', 
                `e-mail` = '$_POST[email_uz]' 
                WHERE `uzytkownicy`.`id_uz` = '$_POST[id_uzytkownika]'"; 
        
        $sql = mysqli_query($pol_db, $q);

        if(!$sql) die('Coś poszło nie tak z aktualizacją danych użytkownika - sprawdź połączenie z bazą danych '); 
        else {
            // zapis informacji o zmianach danych podmiotu w logu systemu zdarzeń
            $akt_data = gmdate('Y-m-d');
            $akt_godz = gmdate('H:i:s');
            $kom_zd = 'Zaktualizowano dane użytkownika o loginie: '. $_POST['login_uzytkownika'] .'.';
            $q = "INSERT INTO system_log (log_id, user_id, data, godzina, zdarzenie)
                    VALUES (NULL, '$_SESSION[user_SQL_id]', '$akt_data', '$akt_godz', '$kom_zd')";
            $sql = mysqli_query($pol_db, $q);

            if(!$sql) die('Coś poszło nie tak z aktualizacją danych podmiotu... sprawdź bazę danych');            
            // ---------------------------------------------------
            echo '
                <script>
                    document.location="index.php?auth=1&ustawienia=1&status=2";
                </script>
            ';
        }
        echo mysqli_error();
    }
}

// funkcja aktualizuje dane podmiotu
if(!empty($_SESSION['log_id']) AND $_SESSION['log_ok'] == $_SESSION['log_id']) {
    if($_POST['aktualizacja_danych_podmiotu'] == '1') {
        $q = "UPDATE podmioty SET nazwa_podmiotu = '$_POST[nazwa_podmiotu]',
                pelna_nazwa_podmiotu = '$_POST[pelna_nazwa_podmiotu]',
                adres = '$_POST[adres_podmiotu]',
                numer = '$_POST[numer_lok_podmiotu]',
                kod_pocztowy = '$_POST[kod_pocztowy_podmiotu]',
                miasto = '$_POST[miasto_podmiotu]',
                nip = '$_POST[nip_podmiotu]',
                regon = '$_POST[regon_podmiotu]',
                telefon = '$_POST[telefon_podmiotu]',
                email = '$_POST[email_podmiotu]'
                WHERE podmioty . id_podmiotu = '$_POST[id_podmiotu]'";
        
        $sql = mysqli_query($pol_db, $q);

        if(!$sql) die('Coś poszło nie tak - sprawdź połączenie z bazą danych'); 
        else {
            // zapis informacji o zmianach danych podmiotu w logu systemu zdarzeń
            $akt_data = gmdate('Y-m-d');
            $akt_godz = gmdate('H:i:s');
            $kom_zd = 'Zaktualizowano dane podmiotu: '. $_POST['nazwa_podmiotu'] .'.';
            $q = "INSERT INTO system_log (log_id, user_id, data, godzina, zdarzenie)
                    VALUES (NULL, '$_SESSION[user_SQL_id]', '$akt_data', '$akt_godz', '$kom_zd')";
            $sql = mysqli_query($pol_db, $q);

            if(!$sql) die('Coś poszło nie tak z aktualizacją danych podmiotu... sprawdź bazę danych');            
            // ---------------------------------------------------
            echo '
                <script>
                    document.location="index.php?auth=1&ustawienia=1&status=1";
                </script>
            ';
        }
        mysqli_close($pol_db);
    }
}
// ---------------------------------

// zapisuje w zmiennych sesyjnych podmiot na którym aktualnie się pracuje
if($_POST['pod_f'] == '1') {
    $_SESSION['podmiot_id'] = $_POST['podmiot'];    
    echo '
    <script>
    document.location="index.php?auth=1&strona_glowna=1";
    </script>';
}

// funkcja odpowiedzialna za wylogowanie
if($_GET['wyloguj'] == '1') {
    session_destroy();
    echo '
    <script>
    document.location="login.php";
    </script>';
}
?>