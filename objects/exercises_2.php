<?php
/**
 * This exercise is to practice the using of PHP's some magic functions( __get(), __set() )
 * 
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Object Overloading with __get(), __set()</title>
</head>
<body>
    <h1>Object Overloading with __get(), __set()</h1>

    <?php
    class Car {
        public $manufacturer;
        public $model;
        public $color;
        private $_extraData = [];

        public function __get( $property_name ) {
            if( array_key_exists( $property_name, $this->_extraData ) ) {
                return $this->_extraData[ $property_name ];
            } else {
                return null;
            }
        }

        public function __set( $property_name, $property_value ) {
            $this->_extraData[ $property_name ] = $property_value;
        }
    }

    $myCar = new Car();
    $myCar->manufacturer = 'Nissan';
    $myCar->model = "Cedric";
    $myCar->color = "red";
    $myCar->engineType = 3.0;
    $myCar->otherColors = array( 'black', 'gray' );

    echo '<h2>Some Properties:</h2>';
    echo "<p>My car's manufacturer is $myCar->manufacturer.</p>";
    echo "<p>My car's engine type is $myCar->color.</p>";
    echo "<p>My car's engine type is $myCar->engineType.</p>";
    echo "<p>My car's fuel type is " .  $myCar->fuelType . ". There is no output value because fuelType was not defined before.</p>";
    
    echo '<h2>$myCar Object:</h2><pre>';
    print_r( $myCar );
    echo '</pre>';

    ?>
    
</body>
</html>