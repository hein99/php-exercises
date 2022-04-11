<?php
/**
 * This example is for practicing concept of Loops(do, while and for) and decision code(if, else)
 * by creating a Pigeon(%) come back Home(+) project
 * 
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Returing home of a pigeon</title>

    <style>
        .container{
            display: flex;
        }

        .map{
            border: 2px solid #333;
            margin-left: 5px;
        }
    </style>
</head>
<body>
    
    <?php
        
        define( 'MAP_SIZE', 10 ); // define constant map size into 10(ie. widht = 10, height = 10)
        
        // Find the (x, y) position of Home and (x, y) position of Pigeon Randomly. The offset of X or Y points of these two object positons is not less than Half of Map Size.
        do {
            $homeX = rand( 0, MAP_SIZE-1 );
            $homeY = rand( 0, MAP_SIZE-1 );

            $pigeonX = rand( 0, MAP_SIZE-1 );
            $pigeonY = rand( 0, MAP_SIZE-1 );
        } while ( ( abs( $homeX - $pigeonX ) < MAP_SIZE/2 ) && ( abs( $homeY - $pigeonY ) < MAP_SIZE/2 ) );

        echo '<div class="container">';

        // Draw Maps one by one until the pigeon reached home.
        do {

            // Make the X position of pigeon nearer to home's X
            if( $homeX < $pigeonX )
                $pigeonX--;
            elseif( $homeX > $pigeonX )
                $pigeonX++;

            // Make the Y position of pigeon nearer to home's Y
            if( $homeY < $pigeonY )
                $pigeonY--;
            elseif( $homeY > $pigeonY )
                $pigeonY++;


            echo '<div class="map">';
            
            for( $y=0; $y<MAP_SIZE; $y++ ) {

                for( $x=0; $x<MAP_SIZE; $x++ ) {
                    if( $x == $homeX && $y == $homeY )
                        echo '+';
                    elseif( $x == $pigeonX && $y == $pigeonY )
                        echo "%";
                    else
                        echo '.';
                    
                    if( $x < MAP_SIZE-1 )
                        echo ' ';
                }

                echo '<br>';
            }

            echo '</div>';

        } while ( $homeX !== $pigeonX || $homeY !== $pigeonY );

        echo '</div>';

    ?>

</body>
</html>