<?php

function displayPageHeader( $page_title ) {

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $page_title ?></title>
        <link rel="stylesheet" href="common.css">
    </head>
    <body>
        <h1><?php echo $page_title ?></h1>

<?php
}

function displayPageFooter() {
?>
    </body>
    </html>
<?php
}
?>