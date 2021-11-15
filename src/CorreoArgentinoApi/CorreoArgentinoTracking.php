<?php

namespace CorreoArgentinoApi;

use CorreoArgentinoApi\Models\Request\Ecommerce;
use CorreoArgentinoApi\Models\Request\Internacional;
use CorreoArgentinoApi\Models\Request\Mercadolibre;
use CorreoArgentinoApi\Models\Request\Nacional;
use CorreoArgentinoApi\Models\Request\RequestInterface;

/**
 * Class CorreoArgentinoTracking
 *
 * API For Corre Argentino Tracking
 *
 * @package App\CorreoArgentinoApi
 */
class CorreoArgentinoTracking extends AbstractCorreoArgentinoTracking
{
    public function getTrackingInfo(RequestInterface $data) {
        switch(get_class($data)) {
            default:
            case Nacional::class:
                $result = $this->getNacional($data);
                break;
            case Internacional::class:
                $result = $this->getInternacional($data);
                break;
            case Ecommerce::class:
                $result = $this->getEcommerce($data);
                break;
            case Mercadolibre::class:
                $result = $this->getMercadolibre($data);
                break;
        }

        return $result;
    }
}