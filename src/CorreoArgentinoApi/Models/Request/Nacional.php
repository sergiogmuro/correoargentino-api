<?php

namespace CorreoArgentinoApi\Models\Request;

use Exception;

class Nacional implements RequestInterface
{
    const PRODUCTS = [
        "CC" => "CC",
        "CD" => "CD",
        "CL" => "CL",
        "CM" => "CM",
        "CO" => "CO",
        "CP" => "CP",
        "DE" => "DE",
        "DI" => "DI",
        "EC" => "EC",
        "EE" => "EE",
        "EO" => "EO",
        "EP" => "EP",
        "GC" => "GC",
        "GD" => "GD",
        "GE" => "GE",
        "GF" => "GF",
        "GO" => "GO",
        "GR" => "GR",
        "GS" => "GS",
        "IN" => "IN",
        "IS" => "IS",
        "JP" => "JP",
        "OL" => "OL",
        "PP" => "PP",
        "RD" => "RD",
        "RE" => "RE",
        "RR" => "RR",
        "SL" => "SL",
        "SP" => "SP",
        "SR" => "SR",
        "ST" => "ST",
        "TC" => "TC",
        "TL" => "TL",
        "UP" => "UP"
    ];
    const PRODUCTS_PLUS = [
        'CU' => 'CU',
        'SU' => 'SU',
        'EU' => 'EU',
        'PU' => 'PU',
    ];
    private static $LIMIT = 9;
    private $isPlus = false;
    private $productCode = 'EE';
    private $shippingId = 0;
    private $destination = 'Nac';
    private $destinationPlus = 'NacP';

    public function get(): array
    {
        return [
            'product_code' => $this->productCode,
            'id_shipping' => $this->shippingId,
            'destination' => $this->isPlus ? $this->destinationPlus : $this->destination
        ];
    }

    /**
     * Auto tracking recognition
     *
     * @param string $tracking
     *
     * @return $this
     * @throws Exception
     */
    public function setTrackingNumber(string $tracking): Nacional
    {
        if (strlen($tracking) <> self::$LIMIT + 4) {
            throw new Exception('Invalid tracking length');
        }
        $productCode = substr($tracking, 0, 2);
        $shippingId = substr($tracking, 2, -2);
        $this->setProductCode($productCode);
        $this->setShippingId($shippingId);
        return $this;
    }

    /**
     * @param string $productCode
     *
     * @return $this
     * @throws Exception
     */
    public function setProductCode(string $productCode): Nacional
    {
        $productCode = strtoupper($productCode);
        if (empty(self::PRODUCTS[$productCode]) && empty(self::PRODUCTS_PLUS[$productCode])) {
            throw new Exception('Product not exists');
        }
        $this->productCode = $productCode;
        return $this;
    }

    /**
     * Set Shipping Number
     *
     * @param int $number
     *
     * @return $this
     * @throws Exception
     */
    public function setShippingId(int $number): Nacional
    {
        if (strlen($number) <> self::$LIMIT) {
            throw new Exception('Invalid shipping id length');
        }
        $this->shippingId = $number;
        return $this;
    }

    /**
     * Set if is o not Nacional Plus
     *
     * @param bool $isPlus
     *
     * @return $this
     */
    public function setIsPlus(bool $isPlus = true): Nacional
    {
        $this->isPlus = $isPlus;
        return $this;
    }
}
