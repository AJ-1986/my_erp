<?php
if(!empty($_SESSION['log_id']) AND $_SESSION['log_ok'] == $_SESSION['log_id']) {

    if($_GET['auth'] == '1') {
        echo '
                    <h1 class="bazowy">Dziennik zdarzeń</h1>
                    <p class="bazowy">
                        Poniżej zostały wyświetlone wszystkie zarejestrowane 
                        zdarzenia w systemie. Wyświetlone od najnowszego do najstarszego.
                    </p>
        ';
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