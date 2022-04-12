<?php
/**
 * This example uses Anonymous Function syntax, Arrow Function syntax and Callback Function concept
 * 
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorting words in a paragraph by the length of word</title>
    <style>
        p{
            width: 50em;
        }
    </style>
</head>
<body>
    <h1>Sorting words in a paragraph by the length of words</h1>

    <?php
    $original_text = <<<END_TEXT
    Myanmar (formerly Burma) is a Southeast Asian
    nation of more than 100 ethnic groups, bordering
    India, Bangladesh, China, Laos and Thailand. 
    Yangon (formerly Rangoon), the country's largest
    city, is home to bustling markets, numerous parks
    and lakes, and the towering, gilded
    Shwedagon Pagoda, which contains Buddhist relics
    and dates to the 6th century.
    END_TEXT;

    echo "<h2>Original Text:</h2>";
    echo "<pre>$original_text</pre>";

    $original_text = preg_replace( "/[\,\.()]/", '', $original_text );
    $words_array = array_unique( preg_split( "/[ \n\r\t]+/", $original_text ) );
    // usort( $words_array, function( $a, $b ) { return strlen($a) - strlen($b); });
    usort( $words_array, fn( $a, $b ) => strlen($a) - strlen($b) );

    echo "<h2>The Sorted words:</h2>";
    echo "<p>";
    foreach( $words_array as $word ) {
        echo $word . ' ';
    }
    echo "</p>";
    ?>    


</body>
</html>