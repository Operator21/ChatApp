<?php
function PageHeader($title = "Nadpis stránky"){
    ?>
    <!DOCTYPE html>
    <html lang="cs">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!-- jQuery JS 3.1.0 -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
            <!-- jQuery Modal -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
            <!-- Page title in  format of *Current Page | ChatApp* -->           
            <title><?= $title ?> | ChatApp</title>
            <!-- General style file -->
            <link rel="stylesheet" href="style.css">
            <!-- General script functions -->
            <script src="javascript.js"></script>
        </head>
        <body>
            <h1><?= $title ?></h1>
            <div id="body">
    <?php
}

function PageFooter(){
    ?>
            </div>
        </body>
    </html>
    <?php
}