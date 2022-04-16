<?php
/**
 * This exercise is to practice the using of PHP's some magic functions ( __call() )
 * 
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Object Overloading with __call()</title>
</head>
<body>
    <h1>Object Overloading with Magic __call() funciton</h1>

    <?php
    class CleverString {
        private $_string = '';
        private static $_allowedFunctions = array( 'strlen', 'strtoupper', 'strpos' );

        public function setString( $text ) {
            $this->_string = $text;
        }

        public function getString( ) {
            return $this->_string;
        }

        public function __call( $method_name, $arguments ) {
            if( in_array( $method_name, CleverString::$_allowedFunctions ) ) {
                array_unshift( $arguments, $this->_string );
                return call_user_func_array( $method_name, $arguments );
            } else {
                return false;
            }
        }
    }

    $aString = new CleverString();
    $aString->setString( "hello, world!" );
    
    echo '<p>The string is ' . $aString->getString() . '.</p>';
    echo '<p>The string length is ' . $aString->strlen() . '.</p>';
    echo '<p>After the string use strtoupper function, it becomes like this ' . $aString->strtoupper() . '.</p>';
    echo '<p>The position of ! in the string is ' . $aString->strpos( '!' ) . '.</p>';

    ?>
    
</body>
</html>