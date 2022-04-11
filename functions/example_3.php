<?php
/**
 * This example is display the Fibonacci Sequence using Recusive Function method
 * 
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fibonacci Sequence with Recursive Function</title>
    <style>
        table{
            border-collapse: collapse;
            width: 10%;
        }

        table thead{
            background: #333;
            color: #efefef;
        }

        table tbody tr:nth-child(even){
            background: #aeaeae;
        }
    </style>
</head>
<body>
    <h1>Fibonacci sequence using recursive</h1>
    <table>
        <thead>
            <tr>
                <th>Sequence #</th>
                <th>Value</th>
            </tr>
        </thead>

        <?php

        $iterations = 10; // number of desire fibonacci sequence

        function fibonacci( $n ) {
            if( $n === 0 || $n === 1) return $n;
            return fibonacci( $n - 2 ) + fibonacci( $n - 1 );
        }

        for( $i=0; $i <= $iterations; $i++ ) { 
            echo '<tr><td>F<sub>' . $i . '</sub></td><td>' . fibonacci($i) . '</td></tr>';
        }
        ?>
    </table>
</body>
</html>