<?php

namespace CorreoArgentinoApi;

use CorreoArgentinoApi\Models\Request\Ecommerce;
use CorreoArgentinoApi\Models\Request\Internacional;
use CorreoArgentinoApi\Models\Request\Mercadolibre;
use CorreoArgentinoApi\Models\Request\Nacional;
use CorreoArgentinoApi\Models\Request\RequestInterface;

abstract class AbstractCorreoArgentinoTracking
{
    private static $API_HOST = 'https://api.correoargentino.com.ar';
    private static $API_BASE = '/backendappcorreo/api/api/shipping-tracking-';

    private static $TRACK_NAC = 'nac';
    private static $TRACK_INTER_NAC = 'int-nac';
    private static $TRACK_ECOMMERCE = 'ec';
    private static $TRACK_MERCADOLIBRE = 'ml';
    private static $API_USA_PROXY       = false;
    private static $API_PROXY           = "";
    private static $API_PROXY_PORT      = "";
    public static function setProxy($proxy,$port) {
        self::$API_USA_PROXY = true;
        self::$API_PROXY = $proxy;
        self::$API_PROXY_PORT = $port;
    }
    private function request(string $url, array $headers = [], string $method = 'GET', array $params = []): string
    {
        $curl = curl_init();

        $params_curl = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POST => ($method == 'POST' ? 1 : 0),
            CURLOPT_POSTFIELDS => json_encode($params),
            CURLOPT_HTTPHEADER => $headers
        ];
        if ( self::$API_USA_PROXY == true ) {
            $params_curl[CURLOPT_PROXYPORT] = self::$API_PROXY_PORT;
            $params_curl[CURLOPT_PROXY] =self::$API_PROXY;

        }
        curl_setopt_array($curl,$params_curl);
        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode(json_encode($response, true)) ?? '';
    }
    private function getUrl(string $type): string
    {
        return self::$API_HOST . self::$API_BASE . $type;
    }

    private function requestTracking(string $url, RequestInterface $data): string
    {
        $url .= '?' . http_build_query($data->get());

        return $this->request($url);
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
        return $this->requestTracking($this->getUrl(self::$TRACK_NAC), $data);
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
        return $this->requestTracking($this->getUrl(self::$TRACK_INTER_NAC), $data);
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
        return $this->requestTracking($this->getUrl(self::$TRACK_ECOMMERCE), $data);
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
        return $this->requestTracking($this->getUrl(self::$TRACK_MERCADOLIBRE), $data);
    }
}
