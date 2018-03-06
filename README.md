<h1 align="center">
    <a href="https://odiseo.com.ar/" target="_blank" title="Odiseo">
        <img src="https://github.com/odiseoteam/SyliusGeoPlugin/blob/master/logo_odiseo.png" alt="Odiseo" width="200px" />
    </a>
    <br />
    Odiseo Sylius Geo Plugin
</h1>

## Description

This plugin add GeoLocation features to Sylius. 

## Installation

1. Run `composer require odiseoteam/sylius-geo-plugin`.

2. Add the plugin to the AppKernel:

```php
public function registerBundles(): array
{
    $bundles = [
        ...
        new \GpsLab\Bundle\GeoIP2Bundle\GpsLabGeoIP2Bundle(),
        new \Odiseo\SyliusGeoPlugin\OdiseoSyliusGeoPlugin(),
    ];
}
```

3. Execute `php bin/console geoip2:update`.

## Credits

This plugins is maintained by <a href="https://odiseo.com.ar">Odiseo</a>, a team of senior developers. Contact us: <a href="mailto:team@odiseo.com.ar">team@odiseo.com.ar</a>.
