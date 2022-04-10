<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Justifying Lines of Texts</title>
</head>
<body>
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
    
    $original_text = str_replace( "\r\n", "\n", $original_text ); // before start: need to fix the end line standard

    define( 'LINE_OF_LENGTH', 50 ); // define the line of lenth to justify
    $justified_text = '';
    $number_of_lines = substr_count( $original_text, "\n" );
    $start_of_line = 0;

    // Process Line by line
    for( $i=0; $i < $number_of_lines; $i++) {
        $original_line_length = strpos( $original_text, "\n", $start_of_line) - $start_of_line;
        $justify_line = substr( $original_text, $start_of_line, $original_line_length );
        $justify_line_length = $original_line_length;

        // Process each space character in a line
        while( $i < $number_of_lines-1 && $justify_line_length < LINE_OF_LENGTH ) {
            for( $j=0; $j < $justify_line_length; $j++ ) {
                if( $justify_line_length < LINE_OF_LENGTH && $justify_line[$j] == ' ' ) {
                    $justify_line = substr_replace( $justify_line, ' ', $j, 0 );
                    $justify_line_length++;
                    $j++;
                }
            }
        }

        $justified_text .= "$justify_line\n";
        $start_of_line += $original_line_length + 1;
    }


    echo '<pre>' . $original_text . '</pre>';
    echo '<pre>' . $justified_text . '</pre>';
    ?>
</body>
</html>