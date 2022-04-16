<?php
/**
 * This exercise is to practice using of constructor and destructor method
 * 
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constructor and Destructor</title>
</head>
<body>
    <h1>Constructor and Destructor</h1>
    <?php
    class Person {
        private $_firstName;
        private $_lastName;
        private $_age;

        public function __construct( $firstName, $lastName, $age ) {
            $this->_firstName = $firstName;
            $this->_lastName = $lastName;
            $this->_age = $age;
        }

        public function showDetails() {
            echo "$this->_firstName $this->_lastName, age $this->_age<br>";
        }

        public function save() {
            echo "Saving the object to the database...<br>";
            echo "Success save<br>";
        }

        public function __destruct() {
            $this->save();
        }
    }

    $p = new Person( "Hein", "Khant", 23 );
    $p->showDetails();

    unset( $p );

    $p1 = new Person( "Harry", "Bob", 30 );
    echo '<br>The program was suddenly stopped. But the object destruct function was automatically called before program stop.<br>';
    die( "Something went wrong!<br>" );
    ?>
</body>
</html>