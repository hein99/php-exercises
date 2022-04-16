<?php
/**
 * This is the learning of working with References
 * 
 */

// Reference variable
$myNum = 123;
$refNum = &$myNum;

$refNum++;

echo "\$myNum: $myNum <br>";

$globalNum = 5;

// Returning Reference
function &increaseOne() {
    global $globalNum;
    return $globalNum;
}

$numberRef = &increaseOne();
$numberRef++;

echo "\$numberRef: $numberRef <br>";
echo "\$globalNum: $globalNum <br>"; 


// Passing Reference
$num = 5;
$num1 = 5;

function numberReset( &$numRef, $normalNum ) {
    $numRef++;
    $normalNum--;
}

numberReset( $num, $num1 );

echo "(Ref)\$num: $num <br>";
echo '(not Ref)$num1: ' . $num1;

?>