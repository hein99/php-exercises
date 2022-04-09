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
    I am Hein Kaung Khant, 23 years old right now.
    I started entering the IT field in 2016
    as a freshman at WYTU, Myanmar.
    Although I have to attend for 6 years to
    graduate with a Bachelor of Engineering in IT,
    as the cases of COVID-19 and Military coup
    I cannot finish my goal. Now, I decided to dropout
    from WYTU and go abroad to start my career
    as a web developer. Since the second year of
    university, I have created many websites for
    my brother business and my brother's friends.
    With the money that get from working
    as a junior web developer,
    I will try to pursue a degree about IT.
    Especially, I really want to pursue
    a software developer degree.

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