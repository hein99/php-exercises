<?php
/**
 * This example is to practice the basic concept of OOP by creating simple car simulator
 * 
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Car Simulator</title>
</head>
<body>
    <?php
    class Car{
        public $color;
        public $manufacturer;
        public $model;
        private $_speed = 0;

        public function accelerate() {
            if( $this->_speed >= 100 ) return false;
            
            $this->_speed += 10;
            return true;
        }

        public function brake() {
            if( $this->_speed <= 0 ) return false;

            $this->_speed -= 10;
            return true;
        }

        public function getSpeed() {
            return $this->_speed;
        }
    }

    $myCar = new Car();
    $myCar->color = 'white';
    $myCar->manufacturer = 'Nissan';
    $myCar->model = 'Cedric';

    echo "<p>I am driving a <b>$myCar->color $myCar->manufacturer $myCar->model</b>.</p>";

    echo '<p>Stepping on the gas...</p>';

    while( $myCar->accelerate() ) {
        echo 'Current speed: ' . $myCar->getSpeed() . 'mph <br>';
    }

    echo '<p><b>Oops!</b> My car reached top speed! I have to slow down...</p>';

    while( $myCar->brake() ) {
        echo 'Current speed: ' . $myCar->getSpeed() . 'mph <br>';
    }

    ?>
</body>
</html>

