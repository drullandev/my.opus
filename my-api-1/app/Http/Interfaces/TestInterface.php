<?php

echo 'Test consist in multiply the amount with the value on the class';

echo 
'The calculation of the amount for direct debit and credit card must be written in different
classes and both classes must implement an interface that will enforce a method called charge.';

$amount = 100;
$finalAmount = null;
$type = 'CC';

//Ok, i don't have those params match anywhere ejem... i'm lost on this point with interfaces lol
/*if ( $type == 'CC' ) {
    $finalAmount = $this->chargeRepo->charge('CreditCard', $amount ); 
    //I Wait 107 as $finalAmount
} else if ( $type == 'DD' ) {
    $finalAmount = $this->chargeRepo->charge('DebitDirect', $amount );
    //I Wait 110 as $finalAmount
}*/

return $finalAmount;
