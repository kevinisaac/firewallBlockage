<?php session_start() ?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="/index.css">
        <script src="/jquery-latest.js"></script>
        <title>
            Firewall Blockage Feedback System
        </title>
    </head>
    <body>
        <header>
            <?php
                include_once $_SERVER["DOCUMENT_ROOT"].'/includes/header.html';
            ?>
        </header>
        
        <article>
            <div id="content-wrapper">
                <div id="content">
                    
                    <?php
                        if(true)
                            include_once $_SERVER["DOCUMENT_ROOT"].'/includes/adminbody.php';
                        else
                            include_once $_SERVER["DOCUMENT_ROOT"].'/includes/body.php';
                    ?>
                    
                </div>
            </div>
        </article>
        
        <footer>
            <?php include_once $_SERVER["DOCUMENT_ROOT"].'/includes/footer.html'; ?>
        </footer>
        
    </body>
</html>
