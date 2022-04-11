<?php
session_start();
include './db_config.php'; // plik konfiguracyjny bazy

// funkcja odpowiadająca za poprawne logowanie
if($_POST['logowanie'] == '1') {
    
    // link do połączenia z bazą danych
    $pol_db = mysqli_connect($dbhost, $dbusername, $dbuserpassword, $default_dbname);
    // --------------------------------
    if(!$pol_db) die('Błąd z połączeniem - sprawdź dane do bazy danych');
    else {
        $haslo_md5 = md5($_POST['haslo_uz']);        
        $q = "SELECT login, haslo  FROM uzytkownicy WHERE login LIKE '$_POST[login_uz]' AND haslo LIKE '$haslo_md5'";
        $sql = mysqli_query($pol_db, $q);

        if(!$query_data = mysqli_fetch_row($sql)) {
            echo '
            <script>
                document.location="login.php?blad=1";
            </script>
            ';
        }
        else {
            $id_ses = md5($_POST['login_uz'], $_POST['haslo_uz']);
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

if($_POST['pod_f'] == '1') {
    $_SESSION['podmiot_id'] = $_POST['podmiot'];
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