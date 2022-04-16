<?php
/**
 * This exercise is to practise create array syntax, and manipulate array with foreach function
 * 
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multidimensional Array</title>
    <style>
        dl{
            overflow: hidden;
        }

        dt, dd{
            float: left;
            width: 40%;
            border-bottom: 2px solid #555;
            padding: 10px 5px;
        }

        dt{
            font-weight: bold;
        }

        dd{
            margin-left: 0;
        }
    </style>
</head>
<body>
    <h1>Looping Through a Two Dimentional Array</h1>

    <?php
    // Create a two dimensional array
    $books = [
        array( 
            'title' => 'Beginning PHP 5.3',
            'author' => 'Matt Doyle',
            'pubYear' => '2010'
        ),

        array( 
            'title' => 'Professional Web Developer 2022',
            'author' => 'Ei Maung',
            'pubYear' => '2022'
        ),

        array(
            'title' => 'The Diary of a Young Girl',
            'author' => 'Anne Frank',
            'pubYear' => '1999'
        ),

        array(
            'title' => 'War and Peace',
            'author' => 'Leo Tolstoy',
            'pubYear' => '1996'
        ),

        array(
            'title' => 'The Ugly Duckling',
            'author' => 'Hans Christian Andersen',
            'pubYear' => '2010'
        ),
    ];
    
    // Print details of books one by one

    $book_count = 0;
    foreach( $books as $book ) {
        // $book_count++;

        echo "<h2>Book #" . ++$book_count . "</h2>";

        echo "<dl>";

        foreach( $book as $key => $value ) {
            echo "<dt>" . ucwords($key) . "</dt> <dd>$value</dd>";
        }

        echo "</dl>";
    }   

    ?>
</body>
</html>