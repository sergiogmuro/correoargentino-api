# Correo Argentino API
Api para consultas en Correo Argentino basado en las consultas disponibles desde la app oficial

### Installation
```shell
composer require sergiomuro/correoargentino-api
```

### Make Request
```php
use CorreoArgentinoApi\CorreoArgentino;

$api = (new CorreoArgentino())
    ->getTrackingInfo($dataModel);
```
-----
### Models
Nacional
```php
use CorreoArgentinoApi\Models\Request\Nacional;

$data = (new Nacional())
    ->setProductCode(Nacional::PRODUCTS['EE'])
    ->setShippingId(123456789)
    ->setIsPlus(true);
# or
$data = (new Nacional())
    ->setTrackingNumber('EE188151547AR');
```
Internacional
```php
use CorreoArgentinoApi\Models\Request\Internacional;

$data = (new Internacional())
    ->setShippingId("RB123456789AR");
```
Ecommerce
```php
use CorreoArgentinoApi\Models\Request\Ecommerce;

$data = (new Ecommerce())
    ->setShippingNumber(string);
```
Mercadolibre
```php
use CorreoArgentinoApi\Models\Request\Mercadolibre;

$data = (new Mercadolibre())
    ->setShippingNumber(string);
```
----

## Example
Set Model
```php
$data = (new Nacional())
    ->setProductCode(Nacional::PRODUCTS['EE'])
    ->setShippingId(123456789);
```
Make Request
```php
$api = (new CorreoArgentino())
    ->getTrackingInfo($data);
```