<?php
if(!empty($_SESSION['log_id']) AND $_SESSION['log_ok'] == $_SESSION['log_id']) {

    if($_GET['auth'] == '1') {
        echo '
                    <h1 class="bazowy">Ustawienia</h1>
                    <p class="bazowy">
                        Na tej stronie dokonasz wszelkich modyfikacji związanych z Twoimi informacjami dotyczącymi użytkowników, podmiotów.
                    </p>                    
        ';
        // pobieranie podmiotów z bazy danych plus tworzenie formularza do edycji danych
        $q = "SELECT * FROM podmioty WHERE id_podmiotu LIKE '$_SESSION[podmiot_id]'";
        $sql = mysqli_query($pol_db, $q);

        while($query_data = mysqli_fetch_row($sql)) {
            echo '
                    <form method="post" action="">
                        <input type="hidden" name="id_podmiotu" value="'. $query_data[0] .'">
                        <fieldset class="us_bazowy">
                            <legend class="us_bazowy">Dane podmiotu</legend>
                            <table>
                                <tr>
                                    <td class="us_bazowy">Nazwa podmiotu:</td>
                                    <td><input class="us_pod_tekst" type="text" name="nazwa_podmiotu" value="'. $query_data[1] .'"></td>
                                    <td class="us_form_adn">Skrócona nazwa widoczna<br>tylko w panelu.</td>
                                </tr>
                                <tr>
                                    <td class="us_bazowy">Pełna nazwa podmiotu:</td>
                                    <td><textarea class="us_pel_nazwa_pod" name="pelna_nazwa_podmiotu" rows="4" cols="30">'. $query_data[2] .'</textarea></td>
                                    <td class="us_form_adn">Pełna nazwa podmiotu,<br>która jest widoczna na fakturach.</td>
                                </tr>
                                <tr>
                                    <td class="us_bazowy">Adres:</td>
                                    <td><input class="us_pod_tekst" type="text" name="adres_podmiotu" value="'. $query_data[3] .'"></td>
                                    <td class="us_form_adn">Nazwa ulicy, na której jest<br>prowadzona działalność.</td>
                                </tr>
                                <tr>
                                    <td class="us_bazowy">Numer domu/lokalu:</td>
                                    <td><input class="us_pod_tekst" type="text" name="numer_lok_podmiotu" value="'. $query_data[4] .'"></td>
                                    <td class="us_form_adn">Dopuszczalne różne formy numeracji.<br>Np: "24/5 lok 3".</td>
                                </tr>
                                <tr>
                                    <td class="us_bazowy">Kod pocztowy:</td>
                                    <td><input class="us_pod_tekst" type="text" name="kod_pocztowy_podmiotu" value="'. $query_data[5] .'"></td>
                                    <td class="us_form_adn">Kod pocztowy miasta.</td>
                                </tr>
                                <tr>
                                    <td class="us_bazowy">Miasto:</td>
                                    <td><input class="us_pod_tekst" type="text" name="miasto_podmiotu" value="'. $query_data[6] .'"></td>
                                    <td class="us_form_adn">Nazwa miasta, w którym prowadzona<br>jest działalność.</td>
                                </tr>
                                <tr>
                                    <td class="us_bazowy">NIP:</td>
                                    <td><input class="us_pod_tekst" type="text" name="nip_podmiotu" value="'. $query_data[7] .'"></td>
                                    <td class="us_form_adn">Numer NIP (w jednym ciągu znaków<br>bez myślników i spacji).</td>
                                </tr>
                                <tr>
                                    <td class="us_bazowy">REGON:</td>
                                    <td><input class="us_pod_tekst" type="text" name="regon_podmiotu" value="'. $query_data[8] .'"></td>
                                    <td class="us_form_adn">Numer REGON (w jednym ciągu znaków<br>bez myślników i spacji).</td>
                                </tr>
                                <tr>
                                    <td class="us_bazowy">Telefon:</td>
                                    <td><input class="us_pod_tekst" type="text" name="telefon_podmiotu" value="'. $query_data[9] .'"></td>
                                    <td class="us_form_adn">Numer telefonu do kontaktu.</td>
                                </tr>
                                <tr>
                                    <td class="us_bazowy">Adres e-mail:</td>
                                    <td><input class="us_pod_tekst" type="text" name="email_podmiotu" value="'. $query_data[10] .'"></td>
                                    <td class="us_form_adn">Adres e-mail do kontaktu.</td>
                                </tr>                                
                            </table>
                            <p class="bazowy"><input class="us_bazowy_sub" type="submit" value="Zapisz zmiany"></p>
                        </fieldset>
                    </form>
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