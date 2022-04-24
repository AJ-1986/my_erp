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
        // wyświetlanie systemowego dziennika zdarzeń
        $q = "SELECT system_log.log_id, uzytkownicy.login, system_log.data, system_log.godzina, system_log.zdarzenie 
                FROM system_log 
                INNER JOIN uzytkownicy ON system_log.user_id=uzytkownicy.id_uz 
                ORDER BY system_log.log_id 
                DESC";
        $sql = mysqli_query($pol_db, $q);

            echo '
                    <fieldset class="historia_zd">
                        <legend class="historia_zd">Historia zdarzeń</legend>
                        <p class="bazowy">
                            (*) Zdarzenia zapisywane są według czasu systemowego serwera.<br>
                            Mogą zaistnieć różnice w czasie między Twoim, a serwerem.
                        </p>
                        <table class="historia_zd">
                        <tr>
                            <td class="historia_zd1">ID</td>
                            <td class="historia_zd1">Użytkownik</td>
                            <td class="historia_zd1">Data</td>
                            <td class="historia_zd1">*Godzina</td>
                            <td class="historia_zd1">Opis zdarzenia</td>
                        </tr>   
            ';

        while($query_data = mysqli_fetch_row($sql)) {
            echo '
                            <tr class="historia_zd2">
                                <td class="historia_zd2">'. $query_data[0] .'</td>
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