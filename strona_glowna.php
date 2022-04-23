<?php
if(!empty($_SESSION['log_id']) AND $_SESSION['log_ok'] == $_SESSION['log_id']) {

    if($_GET['auth'] == '1') {
        echo '
                    <h1 class="bazowy">Strona główna</h1>
                    <p class="bazowy">
                        Witam na stronie głównej systemu MY_ERP.<br><br>
                        Jest to prosty system do zarządzania sprzedażą oraz kontrahentami.<br><br>
                        Na stronie tej uzyskasz informacje statystyczne dotyczące twojego statusu. Odnajdziesz tu informację o nowych dodanych kontrahentach,
                        fakturach sprzedaży i zakupu oraz o aktualnych płatnościach dotyczących wybranego podmiotu, na którym aktualnie pracujesz.<br><br>
                        Wszystkie funkcje związane z aktualizacją danych Twojego podmiotu jak i dodawaniem nowych użytkowników systemu znajdują się w "Ustawieniach".
                        Dziękuję za użytkowanie.
                    </p>
        ';
        // wyświetlanie systemowego dziennika zdarzeń
        $q = "SELECT system_log.log_id, uzytkownicy.login, system_log.data, system_log.godzina, system_log.zdarzenie 
                FROM system_log 
                INNER JOIN uzytkownicy ON system_log.user_id=uzytkownicy.id_uz 
                ORDER BY system_log.log_id 
                DESC LIMIT 15";
        $sql = mysqli_query($pol_db, $q);

            echo '
                    <fieldset class="historia_zd">
                        <legend class="historia_zd">Historia zdarzeń</legend>
                        <p class="bazowy">Lista wyświetla aktualne 15 zdarzeń w systemie.
                        <a href="index.php?auth=1&historia_zd=1">Zobacz wszystkie zdarzenia.</a></p>
                        <table class="historia_zd">
                        <tr>
                        <td class="historia_zd1">Użytkownik</td>
                        <td class="historia_zd1">Data</td>
                        <td class="historia_zd1">*Godzina</td>
                        <td class="historia_zd1">Opis zdarzenia</td>
                        </tr>   
            ';

        while($query_data = mysqli_fetch_row($sql)) {
            echo '
                            <tr class="historia_zd2">
                                <td class="historia_zd2">'. $query_data[1] .'</td>
                                <td class="historia_zd2">'. $query_data[2] .'</td>
                                <td class="historia_zd2">'. $query_data[3] .'</td>
                                <td class="historia_zd2">'. $query_data[4] .'</td>
                            </tr>   
            ';
        }
        echo '
                        </table>
                        <p class="bazowy">(*) Zdarzenia zapisywane są według czasu systemowego serwera.<br>
                        Mogą zaistnieć różnice w czasie między Twoim, a serwerem.</p>
                    </fieldset>
        ';        
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