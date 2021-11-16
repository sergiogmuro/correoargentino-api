# Correo Argentino API Track & Trace
Api para consultas en Correo Argentino basado en las consultas disponibles desde la app oficial

### Installation
```shell
composer require sergiomuro/correoargentino-api
```

### Make Request
```php
use CorreoArgentinoApi\CorreoArgentinoTracking;

$api = (new CorreoArgentinoTracking())
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

----
Ver tambien el proyecto [Epago](https://github.com/sergiogmuro/correoargentino-epago)

> Usar bajo su propia responsabilidad.   
> Teniendo en cuenta que este es un servicio gubernamiental y privado.   
> El proyecto es de uso personal...
