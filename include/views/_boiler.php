<?php

include __DIR__ . "/_noticePopup.php";

function view_head(string $title, string $bodyClass = "")
{
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/index.css">
        <title><?= $title ?></title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    </head>

    <body class="<?= $bodyClass ?>">
    <?php
}

function view_foot()
{
    view_notice() ?>
    </body>

    </html>
<?php
}
