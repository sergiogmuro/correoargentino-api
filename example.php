<?php
/***
    TEST
 */
require_once "vendor/autoload.php";

use CorreoArgentinoApi\CorreoArgentino;
use CorreoArgentinoApi\Models\Request\Internacional;
use CorreoArgentinoApi\Models\Request\Nacional;


$co = new CorreoArgentino();
$ship = (new Nacional())
    ->setProductCode(Nacional::PRODUCTS['EE'])
    ->setShippingId(188151547);
print_r($co->getTrackingInfo($ship)); echo PHP_EOL;

$ship = (new Nacional())
    ->setTrackingNumber("EE188151547AR");
print_r($co->getTrackingInfo($ship)); echo PHP_EOL;

$ship = (new Internacional())
    ->setShippingId("RB123456789AR");
print_r($co->getTrackingInfo($ship)); echo PHP_EOL;