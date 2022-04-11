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
                <div class="logo"><h1 class="main_slogan">MY_ERP</h1></div>
                <div class="right_nav_header">
                    
                </div>
            </div>
            <div class="main_page">
                <div class="left_site">
                </div>
                <div class="right_site">
                </div>
            </div>
            <div class="main_footer">
                <div class="footer">
                    
                </div>
            </div>
        </div>
        <a href="function.php?wyloguj=1">Wyloguj</a>
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