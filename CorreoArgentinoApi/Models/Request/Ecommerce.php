<?php

namespace CorreoArgentinoApi\Models\Request;

use Exception;

class Ecommerce implements RequestInterface
{
    private static $LIMIT = 11;
    private $shippingNumber;

    public function get(): array
    {
        return [
            'number_shipping' => $this->shippingNumber,
        ];
    }

    /**
     * Set Shipping Number
     *
     * @param string $trackingNumber
     *
     * @return Ecommerce
     * @throws Exception
     */
    public function setShippingNumber(string $trackingNumber): Ecommerce
    {
        if (strlen($trackingNumber) < self::$LIMIT) {
            throw new Exception('Invalid tracking length');
        }

        $this->shippingNumber = $trackingNumber;
        return $this;
    }
}
