<?php
if(!empty($_SESSION['log_id']) AND $_SESSION['log_ok'] == $_SESSION['log_id']) {

    if($_GET['auth'] == '1') {
        echo '
                    <h1 class="bazowy">Ustawienia</h1>
                    <p class="bazowy">
                        Na tej stronie dokonasz wszelkich modyfikacji związanych z twoimi informacjami dotyczącymi użytkowników, podmiotów.
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