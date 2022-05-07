<?php
if(!empty($_SESSION['log_id']) AND $_SESSION['log_ok'] == $_SESSION['log_id']) {

    if($_GET['auth'] == '1') {
        echo '
                    <h1 class="bazowy">Ustawienia</h1>
                    <p class="bazowy">
                        Na tej stronie dokonasz wszelkich modyfikacji związanych z Twoimi informacjami dotyczącymi użytkowników, podmiotów.<br>
                        Funkcje takie jak tworzenie lub usuwanie użytkownika, podmiotu są dostępne tylko dla administratora.
                    </p>                    
        ';
        // zarządzanie użytkownikami
        echo '
                    <fieldset class="us_bazowy">
                        <legend class="us_bazowy">Zarządzanie użytkownikami</legend>
                        <p class="bazowy">Aby utworzyć nowego użytkownika lub edytować dane istniejącego wystarczy kliknąć w odpowiedni przycisk poniżej.</p>
                        <p class="bazowy">';
            if($_SESSION['user_SQL_type'] == '1') {
                echo '
                            <button id="form_nav_uz_a1" onClick="form_tw_nowego_uz(\'inline\', \'none\')">Utwórz nowego użytkownika</button><button id="form_nav_uz_b1" onClick="form_tw_nowego_uz(\'none\', \'inline\')">Ukryj</button>&nbsp;&nbsp;|&nbsp;
                ';
            }
        echo '                            
                            <button id="form_nav_uz_a2" onClick="form_ed_danych_uz(\'inline\', \'none\')">Edytuj swoje dane</button><button id="form_nav_uz_b2" onClick="form_ed_danych_uz(\'none\', \'inline\')">Ukryj</button>&nbsp;&nbsp;|&nbsp;
                            <button id="form_nav_uz_a3" onClick="form_ed_hasla_uz(\'inline\', \'none\')">Zmień swoje hasło</button><button id="form_nav_uz_b3" onClick="form_ed_hasla_uz(\'none\', \'inline\')">Ukryj</button>
                        </p>';
            if($_SESSION['user_SQL_type'] == '1') {
            echo '
                        <span id="tworzenie_uz">
                            <p class="bazowy">W celu utworzenia nowego użytkownika wypełnij wszystkie poniższe pola.</p>';
                            if($_GET['status'] == '5') {
                            echo '
                            <p class="bazowy"><font color="#025802"><b>Nowy użytkownik został utworzony!</b></font><br><br>
                            Dane utworzonego użytkownika:</p>
                            ';
                            $q = "SELECT * FROM `uzytkownicy` WHERE `login` LIKE '$_GET[logg_uz]'";
                            $sql = mysqli_query($pol_db, $q);

                            while($query_data = mysqli_fetch_row($sql)) {
                                echo '
                                <p class="bazowy">
                                <b>Login:</b> <i>'. $query_data[1] .'</i>.<br>
                                <b>Imię:</b> <i>'. $query_data[3] .'</i>.<br>
                                <b>Nazwisko:</b> <i>'. $query_data[4] .'</i>.<br>
                                <b>E-mail:</b> <i>'. $query_data[5] .'</i>.<br>
                                <b>Data rejestracji:</b> <i>'. $query_data[6] .'</i>.<br>
                                <b>Godzina rejestracji:</b> <i>'. $query_data[7] .'</i>.<br>
                                </p>
                                ';                                
                                }
                            }
                            echo '
                            <form method="post" action="function.php">
                                <input type="hidden" name="tworzenie_nowego_uzytkownika" value="1">
                                <table>
                                    <tr>
                                        <td class="us_bazowy">Login:</td>
                                        <td><input class="us_pod_tekst" type="text" name="login_uz" minlength="5" required></td>
                                        <td class="us_form_adn">Login musi mieć minimum 5 znaków.</td>
                                    </tr>
                                    <tr>
                                        <td class="us_bazowy">Hasło:</td>
                                        <td><input class="us_pod_haslo" type="password" name="haslo_uz1" minlength="5" required></td>
                                        <td class="us_form_adn">Hasło musi mieć minimum 5 znaków.</td>
                                    </tr>
                                    <tr>
                                        <td class="us_bazowy">Powtórz hasło:</td>
                                        <td><input class="us_pod_haslo" type="password" name="haslo_uz2" required></td>
                                        <td class="us_form_adn"></td>
                                    </tr>
                                    <tr>
                                        <td class="us_bazowy">Imię:</td>
                                        <td><input class="us_pod_tekst" type="text" name="imie_uz" required></td>
                                        <td class="us_form_adn"></td>
                                    </tr>
                                    <tr>
                                        <td class="us_bazowy">Nazwisko:</td>
                                        <td><input class="us_pod_tekst" type="text" name="nazwisko_uz" required></td>
                                        <td class="us_form_adn"></td>
                                    </tr>
                                    <tr>
                                        <td class="us_bazowy">E-mail:</td>
                                        <td><input class="us_pod_tekst" type="text" name="email_uz" required></td>
                                        <td class="us_form_adn"></td>
                                    </tr>
                                </table>
                                <p class="bazowy">
                                    <input class="us_bazowy_sub" type="submit" value="Utwórz nowego użytkownika">
                                </p>
                            </form>
                        </span>';
            }
        
        $q = "SELECT * FROM `uzytkownicy` WHERE `id_uz` LIKE '$_SESSION[user_SQL_id]'";
        $sql = mysqli_query($pol_db, $q);
        while($query_data = mysqli_fetch_row($sql)) {
            echo '
                        <span id="ed_danych_uz">
                            <form method="post" action="function.php">
                                <input type="hidden" name="aktualizacja_danych_uzytkownika" value="1">
                                <input type="hidden" name="id_uzytkownika" value="'. $query_data[0] .'">
                                <input type="hidden" name="login_uzytkownika" value="'. $query_data[1] .'">
                                <table>
                                    <tr>
                                        <td class="us_bazowy">Login:</td>
                                        <td class="us_bazowy2">'. $query_data[1] .' (nie podlega zmianom)</td>                                
                                    </tr>
                                    <tr>
                                        <td class="us_bazowy">Imię:</td>
                                        <td><input class="us_pod_tekst" type="text" name="imie_uz" value="'. $query_data[3] .'" required></td>                                
                                    </tr>
                                    <tr>
                                        <td class="us_bazowy">Nazwisko:</td>
                                        <td><input class="us_pod_tekst" type="text" name="nazwisko_uz" value="'. $query_data[4] .'" required></td>                                
                                    </tr>
                                    <tr>
                                        <td class="us_bazowy">E-mail:</td>
                                        <td><input class="us_pod_tekst" type="text" name="email_uz" value="'. $query_data[5] .'" required></td>                                
                                    </tr>
                                    <tr>
                                        <td class="us_bazowy">Data rejestracji:</td>
                                        <td class="us_bazowy2">'. $query_data[6] .'</td>                                
                                    </tr>
                                    <tr>
                                        <td class="us_bazowy">Godzina rejestracji:</td>
                                        <td class="us_bazowy2">'. $query_data[7] .'</td>                                
                                    </tr>
                                </table>
                                <p class="bazowy">
                                    <input class="us_bazowy_sub" type="submit" value="Zapisz zmiany">';    
            if($_GET['status'] == '2') {
                echo '
                                    &nbsp;&nbsp;|&nbsp;&nbsp; <font color="#025802"><b>Zmiany zostały zapisane!</b></font>
                ';
            }
            echo '
                                </p>
            ';
        }
        echo '
                        </form></span>
                        <span id="ed_hasla_uz">
                            <p class="bazowy">Zmiana hasła dostępu do konta.</p>
                            <form method="post" action="function.php">
                                <input type="hidden" name="aktualizacja_hasla_uz" value="1">
                                <input type="hidden" name="id_uzytkownika" value="'. $_SESSION['user_SQL_id'] .'">
                                <table>
                                    <tr>
                                        <td class="us_bazowy">Hasło:</td>
                                        <td><input class="us_pod_haslo" type="password" name="paswd_uz1" minlength="5" required></td>
                                    </tr>
                                    <tr>
                                        <td class="us_bazowy">Powtórz hasło:</td>
                                        <td><input class="us_pod_haslo" type="password" name="paswd_uz2" minlength="5" required></td>
                                    </tr>
                                </table>
                                <p class="bazowy">
                                    <input class="us_bazowy_sub" type="submit" value="Zapisz zmiany">';            
            if($_GET['status'] == '3') {
                echo '
                                    &nbsp;&nbsp;|&nbsp;&nbsp; <font color="#025802"><b>Zmiany zostały zapisane!</b></font>
                ';
            }
            if($_GET['status'] == '4') {
                echo '
                                    <br><br><font color="red"><b>Błąd! Pola formularza nie mogą być puste<br>oraz różnić się wprowadzonymi danymi</b></font>
                ';
            }
                echo '    
                            </form>
                        </span>';
                
                // lista zarejestrownych użytkowników (widoczna tylko dla admina)
                    if($_SESSION['user_SQL_type'] == '1') {
                        echo '
                        <hr>';
                        if($_POST['autoryzacja_edytuj_uz'] == '1') {
                            $q = "SELECT * FROM `uzytkownicy` WHERE `id_uz` LIKE '$_POST[id_uz]'";
                            $sql = mysqli_query($pol_db, $q);
                            while($query_data = mysqli_fetch_row($sql)) {
                                echo '
                                                <p class="bazowy">
                                                    Za pomocą tego formularza edytujesz dane użytkownika z poniższej listy.
                                                </p>                                            
                                                <form method="post" action="function.php">
                                                    <input type="hidden" name="aktualizacja_danych_uzytkownika2" value="1">
                                                    <input type="hidden" name="id_uzytkownika2" value="'. $query_data[0] .'">
                                                    <input type="hidden" name="login_uzytkownika2" value="'. $query_data[1] .'">
                                                    <table>
                                                        <tr>
                                                            <td class="us_bazowy">Login:</td>
                                                            <td class="us_bazowy2">'. $query_data[1] .' (nie podlega zmianom)</td>                                
                                                        </tr>
                                                        <tr>
                                                            <td class="us_bazowy">Imię:</td>
                                                            <td><input class="us_pod_tekst" type="text" name="imie_uz" value="'. $query_data[3] .'" required></td>                                
                                                        </tr>
                                                        <tr>
                                                            <td class="us_bazowy">Nazwisko:</td>
                                                            <td><input class="us_pod_tekst" type="text" name="nazwisko_uz" value="'. $query_data[4] .'" required></td>                                
                                                        </tr>
                                                        <tr>
                                                            <td class="us_bazowy">E-mail:</td>
                                                            <td><input class="us_pod_tekst" type="text" name="email_uz" value="'. $query_data[5] .'" required></td>                                
                                                        </tr>
                                                        <tr>
                                                            <td class="us_bazowy">Data rejestracji:</td>
                                                            <td class="us_bazowy2">'. $query_data[6] .'</td>                                
                                                        </tr>
                                                        <tr>
                                                            <td class="us_bazowy">Godzina rejestracji:</td>
                                                            <td class="us_bazowy2">'. $query_data[7] .'</td>                                
                                                        </tr>
                                                    </table>
                                                    <p class="bazowy">
                                                        <input class="us_bazowy_sub" type="submit" value="Zapisz zmiany">
                                                    </p></form>';    
                                
                                }                                
                        }
                        if($_GET['status'] == '6') {
                            echo '
                                            <p class="bazowy">
                                                <font color="#025802"><b>Modyfikacja danych dla użytkownika <font color="#ffffff"><u>'. $_GET['u_z'] .'</u></font> została zapisana!</b></font>
                                            </p>
                            ';
                        }   
                        echo '
                        <table class="uz_lista">
                            <tr>
                                <td class="uz_lista_tytul" colspan="9">Aktualna lista użytkowników systemu</td>
                            </tr>
                            <tr class="uz_lista">
                                <td class="uz_lista1">Login</td>
                                <td class="uz_lista1">Imię</td>
                                <td class="uz_lista1">Nazwisko</td>
                                <td class="uz_lista1">E-mail</td>
                                <td class="uz_lista1">Data rej.</td>
                                <td class="uz_lista1">Godzina rej.</td>
                                <td class="uz_lista1">Typ konta:</td>
                                <td class="uz_lista1" colspan="2">Akcja</td>
                            </tr>';
                        $q = "SELECT * FROM `uzytkownicy`";
                        $sql = mysqli_query($pol_db, $q);
                        while($query_data = mysqli_fetch_row($sql)) {
                            if($query_data[8] == '1') {
                                $typ_konta = 'Administrator';
                            }
                            else {
                                $typ_konta = 'Zwykły użytkownik';
                            }
                            echo '
                            <tr class="uz_lista">
                                <td class="uz_lista2">'. $query_data[1] .'</td>
                                <td class="uz_lista2">'. $query_data[3] .'</td>
                                <td class="uz_lista2">'. $query_data[4] .'</td>
                                <td class="uz_lista2">'. $query_data[5] .'</td>
                                <td class="uz_lista2">'. $query_data[6] .'</td>
                                <td class="uz_lista2">'. $query_data[7] .'</td>
                                <td class="uz_lista2">'. $typ_konta .'</td>
                                <td class="uz_lista2">';
                                    if($query_data[8] != '1') {
                                        echo '
                                    <form method="post" action="index.php?auth=1&ustawienia=1">
                                        <input type="hidden" name="autoryzacja_edytuj_uz" value="1">
                                        <input type="hidden" name="id_uz" value="'. $query_data[0] .'">
                                        <input class="us_bazowy_sub" type="submit" value="Edytuj">
                                    </form>';
                                    }
                                echo '
                                </td>
                                <td class="uz_lista2">';
                                    if($query_data[8] != '1') {
                                        echo '
                                    <form id="form_usun_uz" method="post" action="function.php">
                                        <input type="hidden" name="autoryzacja_usun_uz" value="1">
                                        <input type="hidden" name="id_uz" value="'. $query_data[0] .'">
                                        <input type="button" class="us_bazowy_usun_sub" onClick="usun_uz(\''. $query_data[1] .'\')" value="Usuń">
                                    </form>';
                                    }
                                echo '
                                </td>
                            </tr>
                            ';
                        }    
                        echo '
                        </table><hr>
                        ';
                    }
                // ----------------------------------

                echo '
                    </fieldset>
                    <p>&nbsp;</p>
        ';
        // -------------------------

        // pobieranie podmiotów z bazy danych plus tworzenie formularza do edycji danych
        $q = "SELECT * FROM `podmioty` WHERE `id_podmiotu` LIKE '$_SESSION[podmiot_id]'";
        $sql = mysqli_query($pol_db, $q);

        while($query_data = mysqli_fetch_row($sql)) {
            echo '
                    <form method="post" action="function.php">
                        <input type="hidden" name="aktualizacja_danych_podmiotu" value="1">
                        <input type="hidden" name="id_podmiotu" value="'. $query_data[0] .'">
                        <fieldset class="us_bazowy">
                            <legend class="us_bazowy">Dane podmiotu</legend>
                            <table>
                                <tr>
                                    <td class="us_bazowy">Nazwa podmiotu:</td>
                                    <td><input class="us_pod_tekst" type="text" name="nazwa_podmiotu" value="'. $query_data[1] .'" required></td>
                                    <td class="us_form_adn">Skrócona nazwa widoczna tylko w panelu.</td>
                                </tr>
                                <tr>
                                    <td class="us_bazowy">Pełna nazwa podmiotu:</td>
                                    <td><textarea class="us_pel_nazwa_pod" name="pelna_nazwa_podmiotu" rows="4" cols="20" required>'. $query_data[2] .'</textarea></td>
                                    <td class="us_form_adn">Pełna nazwa podmiotu, która jest widoczna na fakturach.</td>
                                </tr>
                                <tr>
                                    <td class="us_bazowy">Adres:</td>
                                    <td><input class="us_pod_tekst" type="text" name="adres_podmiotu" value="'. $query_data[3] .'" required></td>
                                    <td class="us_form_adn">Nazwa ulicy, na której jest prowadzona działalność.</td>
                                </tr>
                                <tr>
                                    <td class="us_bazowy">Numer domu/lokalu:</td>
                                    <td><input class="us_pod_tekst" type="text" name="numer_lok_podmiotu" value="'. $query_data[4] .'" required></td>
                                    <td class="us_form_adn">Dopuszczalne różne formy numeracji. Np: "24/5 lok 3".</td>
                                </tr>
                                <tr>
                                    <td class="us_bazowy">Kod pocztowy:</td>
                                    <td><input class="us_pod_tekst" type="text" name="kod_pocztowy_podmiotu" value="'. $query_data[5] .'" required></td>
                                    <td class="us_form_adn">Kod pocztowy miasta.</td>
                                </tr>
                                <tr>
                                    <td class="us_bazowy">Miasto:</td>
                                    <td><input class="us_pod_tekst" type="text" name="miasto_podmiotu" value="'. $query_data[6] .'" required></td>
                                    <td class="us_form_adn">Nazwa miasta, w którym prowadzona jest działalność.</td>
                                </tr>
                                <tr>
                                    <td class="us_bazowy">NIP:</td>
                                    <td><input class="us_pod_tekst" type="text" name="nip_podmiotu" value="'. $query_data[7] .'" required></td>
                                    <td class="us_form_adn">Numer NIP (w jednym ciągu znaków bez myślników i spacji).</td>
                                </tr>
                                <tr>
                                    <td class="us_bazowy">REGON:</td>
                                    <td><input class="us_pod_tekst" type="text" name="regon_podmiotu" value="'. $query_data[8] .'"></td>
                                    <td class="us_form_adn">Numer REGON (w jednym ciągu znaków bez myślników i spacji).</td>
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
                            <p class="bazowy">
                            <input class="us_bazowy_sub" type="submit" value="Zapisz zmiany">';
            if($_GET['status'] == '1') {
                echo '
                            &nbsp;&nbsp;|&nbsp;&nbsp; <font color="#025802"><b>Zmiany zostały zapisane!</b></font>
                ';
            }
            echo '
                            </p>
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