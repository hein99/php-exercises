<?php
/**
 * This example is to practice concept of Inheritance, Abstract Classes and Methods
 * 
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inheritance</title>
</head>
<body>
    <h1>Creating Shapes Classes using Inheritance</h1>

    <?php
    // Abstract Classes and Methods
    abstract class Shape {
        private $_color;
        private $_isFilled;

        public function setColor( $color ) {
            $this->_color = $color;
        }

        public function getColor() {
            return $this->_color;
        }

        public function fill() {
            $this->_isFilled = true;
        }

        public function makeHollow() {
            $this->_isFilled = false;
        }

        public function isFilled() {
            return $this->_isFilled;
        }

        abstract public function getArea(); 
    }

    class Circle extends Shape {
        private $_radius;

        public function setRadius( $radius ) {
            $this->_radius = $radius;
        }

        public function getRadius() {
            return $this->_radius;
        }

        public function getArea() {
            return M_PI * pow( $this->_radius, 2 );
        }
    }

    class Square extends Shape {
        private $_sideLength;

        public function setSideLength( $sideLength ) {
            $this->_sideLength = $sideLength;
        }

        public function getSideLength() {
            return $this->_sideLength;
        }

        public function getArea() {
            return pow( $this->_sideLength, 2 );
        }
    }

    $aCircle = new Circle();
    $aCircle->setRadius( 5 );
    $aCircle->setColor('red');
    $aCircle->fill();

    echo '<h2>Circle:</h2>';
    echo '<p>This circle has a radius of ' . $aCircle->getRadius() . '.</p>';
    echo '<p>It is ' . $aCircle->getColor() . ' and it is ' . (( $aCircle->isFilled() ) ? "filled" : "hollow") . '.</p>';
    echo '<p>The area of the circle is ' . $aCircle->getArea() . '.</p>';

    $aSquare = new Square();
    $aSquare->setSideLength(5);
    $aSquare->setColor('green');
    $aSquare->makeHollow();

    echo '<h2>Square</h2>';
    echo '<p>This square has a side length of ' . $aSquare->getSideLength() . '.</p>';
    echo '<p>It is ' . $aSquare->getColor() . ' and it is ' . (( $aSquare->isFilled() ) ? "filled" : "hollow") . '.</p>';
    echo '<p>The area of the square is ' . $aSquare->getArea() . '.</p>';

    ?>
</body>
</html>