<?php
if(!empty($_SESSION['log_id']) AND $_SESSION['log_ok'] == $_SESSION['log_id']) {

    if($_GET['auth'] == '1') {
        echo '
                    <h1 class="bazowy">Strona główna</h1>
                    <p class="bazowy">
                        Witam na stronie głównej systemu MY_ERP.<br><br>
                        Jest to prosty system do zarządzania sprzedażą oraz kontrahentami.<br><br>
                        Na stronie tej uzyskasz informacje statystyczne dotyczące twojego statusu. Odnajdziesz tu informację o nowych dodanych kontrahentach, fakturach sprzedaży i zakupu oraz o aktualnych płatnościach dotyczących wybranego podmiotu, na którym aktualnie pracujesz.<br><br>
                        Dziękuję za użytkowanie.
                    </p>
        ';
        // wyświetlanie systemowego dziennika zdarzeń
        
        // ------------------------------------------
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