<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface</title>
</head>
<body>
    <h1>Creating and Using an Interface</h1>

    <?php
    interface Sellable {
        public function addStock( $number_items );
        public function sellItem();
        public function getStockLevel();
    }

    class Television implements Sellable {
        private $_screenSize;
        private $_stockLevel;

        public function setScreenSize( $screenSize ) {
            $this->_screenSize = $screenSize;
        }

        public function getScreenSize() {
            return $this->_screenSize;
        }

        public function addStock( $number_items ) {
            $this->_stockLevel += $number_items;
        }

        public function sellItem() {
            if( $this->_stockLevel > 0 ) {
                $this->_stockLevel--;
                return true;
            } else {
                return false;
            }
        }

        public function getStockLevel() {
            return $this->_stockLevel;
        }
    }

    class TennisBall implements Sellable {
        private $_color;
        private $_ballLeft;

        public function setColor ( $color ) {
            $this->_color = $color;
        }

        public function getColor() {
            return $this->_color;
        }

        public function addStock( $number_items ) {
            $this->_ballLeft += $number_items;
        }

        public function sellItem() {
            if( $this->_ballLeft > 0 ) {
                $this->_ballLeft--;
                return true;
            } else {
                return false;
            }
        }

        public function getStockLevel() {
            return $this->_ballLeft;
        }
    }

    class StoreManager {
        private $_productList = [];

        public function addProduct( Sellable $product ) {
            $this->_productList[] = $product;
        }

        public function stockUp() {
            foreach( $this->_productList as $product )
                $product->addStock( 100 );
        }
    }

    $tv = new Television();
    $tv->setScreenSize( 42 );

    $ball = new TennisBall();
    $ball->setColor( "green" );

    $manager = new StoreManager();
    $manager->addProduct( $tv );
    $manager->addProduct( $ball );
    $manager->stockUp();

    echo '<p>There are ' . $tv->getStockLevel() . ' ' . $tv->getScreenSize() . '-inch televisions and ';
    echo  $ball->getStockLevel() . ' ' . $ball->getColor() . ' tennis balls in stock.</p>';

    $tv->sellItem();
    echo '<p>Selling a television...</p>';

    $ball->sellItem();
    $ball->sellItem();
    echo '<p>Selling a ball...</p>';
    echo '<p>Selling a ball...</p>';

    echo '<p>There are ' . $tv->getStockLevel() . ' ' . $tv->getScreenSize() . '-inch televisions and ';
    echo  $ball->getStockLevel() . ' ' . $ball->getColor() . ' tennis balls in stock.</p>';


    ?>
    
</body>
</html>