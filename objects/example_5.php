<?php
/**
 * This example is to practice the overriding Methods
 * 
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overriding Methods</title>
</head>
<body>
    <h1>Overriding Methods</h1>

    <?php
    class Fruit {
        public function peel() {
            echo '<p>Peel the fruit.</p>';
        }

        public function slice() {
            echo '<p>Slice the fruit.</p>';
        }

        public function eat() {
            echo '<p>Eat the fruit.</p>';
        }

        public function consume() {
            $this->peel();
            $this->slice();
            $this->eat();
        }
    }

    //Method overriding
    class Grape extends Fruit {
        public function peel() {
            echo '<p>Don\'t need to peel.</p>';
        }

        public function slice() {
            echo '<p>Don\'t need to slice.</p>';
        }
    }

    // Use functionality of Parent Class
    class Banana extends Fruit {
        public function consume() {
            echo '<p>Break off a banana.</p>';
            parent::consume();
        }
    }

    echo '<h2>Apple:</h2>';
    $apple = new Fruit();
    $apple->consume();

    echo '<h2>Grape</h2>';
    $grape = new Grape();
    $grape->consume();

    echo '<h2>Banana</h2>';
    $banana = new Banana();
    $banana->consume();

    ?>

    
</body>
</html>