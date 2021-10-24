<?php
/***
 * TEST
 */
require_once "src/CorreoArgentinoApi/Models/Request/RequestInterface.php";
require_once "src/CorreoArgentinoApi/Models/Request/Nacional.php";
require_once "src/CorreoArgentinoApi/Models/Request/Internacional.php";
require_once "src/CorreoArgentinoApi/AbstractCorreoArgentino.php";
require_once "src/CorreoArgentinoApi/CorreoArgentino.php";

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