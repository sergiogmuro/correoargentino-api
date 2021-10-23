<?php

namespace CorreoArgentinoApi;

use CorreoArgentinoApi\Models\Request\Ecommerce;
use CorreoArgentinoApi\Models\Request\Internacional;
use CorreoArgentinoApi\Models\Request\Mercadolibre;
use CorreoArgentinoApi\Models\Request\Nacional;
use CorreoArgentinoApi\Models\Request\RequestInterface;

abstract class AbstractCorreoArgentino
{
    private static $API_HOST = 'https://api.correoargentino.com.ar';
    private static $API_BASE = '/backendappcorreo/api/api/shipping-tracking-';

    private static $TRACK_NAC = 'nac';
    private static $TRACK_INTER_NAC = 'int-nac';
    private static $TRACK_ECOMMERCE = 'ec';
    private static $TRACK_MERCADOLIBRE = 'ml';

    private function request(string $type, RequestInterface $data)
    {
        $url = self::$API_HOST . self::$API_BASE . $type . '?' . http_build_query($data->get());

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'User-Agent: User-Agent: Dalvik/2.1.0 (Linux; U; Android 6.0; Android SDK built for x86 Build/MASTER)',
                'Host: api.correoargentino.com.ar'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode(json_encode($response, true));
    }


    /**
     * Get Nacional Track & Trace
     *
     * @param Nacional $data
     *
     * @return mixed
     */
    protected function getNacional(Nacional $data)
    {
        return $this->request(self::$TRACK_NAC, $data);
    }

    /**
     * Get Interational Track & Trace
     *
     * @param Internacional $data
     *
     * @return mixed
     */
    protected function getInternacional(Internacional $data)
    {
        return $this->request(self::$TRACK_INTER_NAC, $data);
    }

    /**
     * Get Tracking for Ecommerce Service
     *
     * @param Ecommerce $data
     *
     * @return mixed
     */
    protected function getEcommerce(Ecommerce $data)
    {
        return $this->request(self::$TRACK_ECOMMERCE, $data);
    }

    /**
     * Get Tracking for Mercadolibre Service
     *
     * @param Mercadolibre $data
     *
     * @return mixed
     */
    protected function getMercadolibre(Mercadolibre $data)
    {
        return $this->request(self::$TRACK_MERCADOLIBRE, $data);
    }
}
