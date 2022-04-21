<?php
if(!empty($_SESSION['log_id']) AND $_SESSION['log_ok'] == $_SESSION['log_id']) {

    if($_GET['auth'] == '1') {
        echo '
                    <h1 class="bazowy">Ustawienia</h1>
                    <p class="bazowy">
                        Na tej stronie dokonasz wszelkich modyfikacji związanych z twoimi informacjami dotyczącymi użytkowników, podmiotów.
                    </p>                    
        ';
        // pobieranie podmiotów z bazy danych plus tworzenie formularza do edycji danych
        $q = "SELECT nazwa_podmiotu FROM podmioty WHERE id_podmiotu LIKE '$_SESSION[podmiot_id]'";
        $sql = mysqli_query($pol_db, $q);

        while($query_data = mysqli_fetch_row($sql)) {
            echo '
            
            ';
        }                                
        //-----------------------------------
    }
}
else {
    echo '
<!DOCTYPE html>
<html lang="pl-PL">
<body>
    <script>
        document.location="login.php";
    </script>
</body>
</html>
    ';
}
?>