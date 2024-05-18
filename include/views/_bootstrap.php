<?php

function view_head(string $title)
{
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/CSS/index.css">
        <title><?= $title ?></title>
    </head>

    <body>
    <?php
}

function view_foot()
{
    ?>
    </body>

    </html>
<?php
}