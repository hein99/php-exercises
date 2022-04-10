<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adding element into associated array in two dimensional array</title>
</head>
<body>
    <?php
    $author = array( 'Matt Doyle', 'Ei Maung', 'Anne Frank', 'Leo Tolstoy', 'Hans Christian Andersen' );

    $books = array(
        [
            'title' => 'Professional Web Developer 2022',
            'authorId' => 1,
            'pubYear' => 2022
        ],

        [
            'title' => 'Beginning PHP 5.3',
            'authorId' => 0,
            'pubYear' => 2010
        ],

        [
            'title' => 'War and Peace',
            'authorId' => 3,
            'pubYear' => 1996
        ],

        [
            'title' => 'The Diary of a Young Girl',
            'authorId' => 2,
            'pubYear' => 1999
        ],

        [
            'title' => 'The Ugly Duckling',
            'authorId' => 4,
            'pubYear' => 2010
        ]
    );

    echo "<h1>Original Books</h1>";

    echo "<pre>";
    print_r( $books );
    echo "</pre>";

    foreach( $books as &$book ) {
        $book['authorName'] = $author[$book['authorId']];
    }
    unset($book);

    echo "<h1>After adding Author Name into respective book information</h1>";

    echo "<pre>";
    print_r( $books );
    echo "</pre>";

    ?>
</body>
</html>