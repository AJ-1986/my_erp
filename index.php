<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl-PL">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <meta name="autor" content="Adam Jurewicz (proxweb@outlook.com)">
        <title>MY ERP</title>
        <link rel="stylesheet" href="main_style.css">
    </head>
    <body>
        <?php
            if(!empty($_SESSION['log_id']) AND $_SESSION['log_ok'] == $_SESSION['log_id'])
            {
        ?>
        <div class="main_page">
            <div class="main_header">
                <div class="logo">MY_ERP</div>                
                <div class="right_nav_header">
                    <a class="link_header" href="index.php?auth=1&ustawienia=1">Ustawienia</a>&nbsp;&nbsp;|&nbsp;
                    <a class="link_header" href="function.php?wyloguj=1">Wyloguj</a>
                </div>                
            </div>            
            <div class="left_site">
                <div class="index_left_podmiot">
                    <p class="index_left">
                        Aktualnie pracujesz na podmiocie:
                    </p>
                </div>
            </div>
            <div class="right_site">
                Tymczasowy tekst...
            </div>            
            <div class="footer">
                &copy; MY_ERP <?php echo gmdate('Y'); ?>                    
            </div>            
        </div>        
        <?php
            }
            else
            {
        ?>
                <script>
                    document.location='login.php';
                </script>
        <?php
            }
        ?>
    </body>
</html>