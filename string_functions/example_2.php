<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wrap text</title>
</head>
<body>
    <?php
    $original_text = <<<END_TEXT
    I am Hein Kaung Khant, 23 years old right now. I started entering the IT field in 2016 as a freshman at WYTU, Myanmar. Although I have to attend for 6 years to graduate with a Bachelor of Engineering in IT, as the cases of COVID-19 and Military coup I cannot finish my goal. Now, I decided to dropout from WYTU and go abroad to start my career as a web developer. Since the second year of university, I have created many websites for my brother business and my brother's friends. With the money that get from working as a junior web developer, I will try to pursue a degree about IT. Especially, I really want to pursue a software developer degree.
    
    END_TEXT;

    $original_text = str_replace( "\r\n", "\n", $original_text ); // Make sure the line ending format into one standard
    $wrapped_text = '';

    define( 'LINE_OF_LENGTH', 50 ); // Define Line of length
    $number_of_lines = substr_count( $original_text, "\n" );
    $start_position = 0;

    // process line by line
    for( $i=0; $i < $number_of_lines; $i++ ) {
        $original_line_length = strpos( $original_text, "\n", $start_position ) - $start_position;
        $wrapped_line = substr( $original_text, $start_position, $original_line_length );
        
        $last_space_position = -1;

        // Find space characters and wrap the text line by the LINE_OF_LENGTH
        while( $last_space_position+1 < $original_line_length ) {
            $loop_start_pointer = $last_space_position + 1;
            $loop_end_pointer = $loop_start_pointer + LINE_OF_LENGTH;

            // Put end line character
            for( $j = $loop_start_pointer; $j < $loop_end_pointer ; $j++ ) {

                if( $j === $original_line_length ) {
                    $last_space_position = $original_line_length;
                    break;
                }

                if( $j === $loop_end_pointer-1 ) { 
                    if( $wrapped_line[$j] == ' ' )
                        $wrapped_line = substr_replace( $wrapped_line, "\n", $j, 1 );
                    else
                        $wrapped_line = substr_replace( $wrapped_line, "\n", $last_space_position, 1 );
                }

                if( $wrapped_line[$j] == ' ' )
                    $last_space_position = $j;
            }

        }

        $wrapped_text .= $wrapped_line . "\n";

        $start_position += $original_line_length + 1;
    }

    echo '<pre>' . $original_text . '</pre>';
    echo '<pre>' . $wrapped_text . '</pre>';

    ?>
</body>
</html>