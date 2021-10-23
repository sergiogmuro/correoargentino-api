# Correo Argentino API
Api para consultas en Correo Argentino basado en las consultas disponibles desde la app oficial

## Make Request
```php
$api = (new CorreoArgentino())
    ->getTrackingInfo($dataModel);
```
-----
## Models
Nacional
```php
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
$data = (new Internacional())
    ->setShippingId("RB123456789AR");
```
Ecommerce
```php
$data = (new Ecommerce())
    ->setShippingNumber(string);
```
Mercadolibre
```php
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