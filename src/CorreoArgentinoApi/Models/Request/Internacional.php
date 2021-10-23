<?php

namespace CorreoArgentinoApi\Models\Request;

use Exception;

class Internacional implements RequestInterface
{
    private static $LIMIT = 11;
    private $shippingId;

    public function get(): array
    {
        return [
            'id_shipping' => $this->shippingId,
        ];
    }

    /**
     * Set Shipping Number
     *
     * @param string $trackingNumber
     *
     * @return $this
     * @throws Exception
     */
    public function setShippingId(string $trackingNumber): Internacional
    {
        if (strlen($trackingNumber) < self::$LIMIT) {
            throw new Exception('Invalid tracking length');
        }

        $this->shippingId = $trackingNumber;
        return $this;
    }
}
