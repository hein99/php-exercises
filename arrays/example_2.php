<?php
/**
 * This example is for learning a powerful array manipulate function array_splice();
 * 
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Using array_splice()</title>
    <style>
        h1{
            font-family: sans-serif;
            text-align: center;
            border-radius: 5px;
            background: #333;
            color: #fff;
            padding: 10px 0;
        }

        table{
            width: 100%;
            border-collapse: collapse;
        }

        th, td{
            border: 1px solid #333;
            padding: 0 1em;
            vertical-align: top;
        }

        th{
            padding: 1em 1em;
            font-size: 1.5em;
        }

        h2{
            color: #777;
        }

        pre{
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h1>Using array_splice()</h1>
    <table>
        <tr>
            <th>Original array</th>
            <th>Removed</th>
            <th>Added</th>
            <th>New array</th>
        </tr>

        <?php

        $heading_start = '<tr><td colspan="4"><h2>';
        $heading_end = '</h2></td></tr>';
        $row_start = '<tr><td><pre>';
        $next_cell = '</pre></td><td><pre>';
        $row_end = '</pre></td></tr>';

        // First Row

        echo "{$heading_start}1. Adding two new elements to the middle{$heading_end}";

        $original_array = array( 'Steinbeck', 'Kafka', 'Tolkien' );
        $array_to_add = array( 'Melville', 'Hardy' );
        
        echo $row_start;

        print_r( $original_array );

        echo $next_cell;

        print_r( array_splice( $original_array, 2, 0, $array_to_add ) );

        echo $next_cell;

        print_r( $array_to_add );

        echo $next_cell;

        print_r ( $original_array );

        echo $row_end;

        // Second Row

        echo "{$heading_start}2. Replacing two elements with a new element{$heading_end}";

        $original_array = array( 'Steinbeck', 'Kafka', 'Tolkien' );
        $array_to_add = array( 'Bronte' );
        
        echo $row_start;

        print_r( $original_array );

        echo $next_cell;

        print_r( array_splice( $original_array, 0, 2, $array_to_add ) );

        echo $next_cell;

        print_r( $array_to_add );

        echo $next_cell;

        print_r ( $original_array );

        echo $row_end;


        // Third Row

        echo "{$heading_start}3. Removing the last two elements{$heading_end}";

        $original_array = array( 'Steinbeck', 'Kafka', 'Tolkien' );
        
        echo $row_start;

        print_r( $original_array );

        echo $next_cell;

        print_r( array_splice( $original_array, 1, 2 ) );

        echo "$next_cell Nothing $next_cell";

        print_r ( $original_array );

        echo $row_end;


        // Fourth Row

        echo "{$heading_start}4. Inserting a string instead of an array{$heading_end}";

        $original_array = array( 'Steinbeck', 'Kafka', 'Tolkien' );
        $string_to_add = 'Orwell';
        
        echo $row_start;

        print_r( $original_array );

        echo $next_cell;

        print_r( array_splice( $original_array, 1, 0, $string_to_add ) );

        echo "$next_cell $string_to_add $next_cell";

        print_r ( $original_array );

        echo $row_end;
    

        ?>

    </table>

</body>
</html>