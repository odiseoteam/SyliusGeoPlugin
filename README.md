<h1 align="center">
    <a href="https://odiseo.com.ar/" target="_blank" title="Odiseo">
        <img src="https://github.com/odiseoteam/SyliusGeoPlugin/blob/master/sylius-geo-plugin.png" alt="Sylius Geo Plugin" width="200px" />
    </a>
    <br />
    <a href="https://packagist.org/packages/odiseoteam/sylius-geo-plugin" title="License" target="_blank">
        <img src="https://img.shields.io/packagist/l/odiseoteam/sylius-geo-plugin.svg" />
    </a>
    <a href="https://packagist.org/packages/odiseoteam/sylius-geo-plugin" title="Version" target="_blank">
        <img src="https://img.shields.io/packagist/v/odiseoteam/sylius-geo-plugin.svg" />
    </a>
    <a href="http://travis-ci.org/odiseoteam/SyliusGeoPlugin" title="Build status" target="_blank">
        <img src="https://img.shields.io/travis/odiseoteam/SyliusGeoPlugin/master.svg" />
    </a>
    <a href="https://scrutinizer-ci.com/g/odiseoteam/SyliusGeoPlugin/" title="Scrutinizer" target="_blank">
        <img src="https://img.shields.io/scrutinizer/g/odiseoteam/SyliusGeoPlugin.svg" />
    </a>
    <a href="https://packagist.org/packages/odiseoteam/sylius-geo-plugin" title="Total Downloads" target="_blank">
        <img src="https://poser.pugx.org/odiseoteam/sylius-geo-plugin/downloads" />
    </a>
</h1>

## Description

This is a Sylius Plugin that add GeoLocation to your store with GeoIP2 API features:
<a href="https://github.com/maxmind/GeoIP2-php" target="_blank" title="GeoIP2">https://github.com/maxmind/GeoIP2-php</a>

Some of that features are:

* Autocomplete fields: Add the country, city and postal code in the address form on the checkout page based on your ip.

* Twig helpers: Provides cool twig helpers to get continent, country, city and postal code.

Now supporting Sylius 1.6 with Symfony 4 + Flex structure.

## Demo

You can see this plugin in action in our Sylius Demo application.

- Frontend: [sylius-demo.odiseo.com.ar](https://sylius-demo.odiseo.com.ar).
- Administration: [sylius-demo.odiseo.com.ar/admin](https://sylius-demo.odiseo.com.ar/admin) with `odiseo: odiseo` credentials.

## Installation

1. Run `composer require odiseoteam/sylius-geo-plugin`.

2. Enable the plugin in bundles.php

```php
<?php

return [
    // ...
    GpsLab\Bundle\GeoIP2Bundle\GpsLabGeoIP2Bundle::class => ['all' => true],
    Odiseo\SyliusGeoPlugin\OdiseoSyliusGeoPlugin::class => ['all' => true],
    // ...
];
```

3. Import the plugin configurations

```yml
imports:
    - { resource: "@OdiseoSyliusGeoPlugin/Resources/config/config.yaml" }
```

4. Execute `bin/console geoip2:update`.

You can enable or disable some features in checkout addressing step

```yml
odiseo_sylius_geo_plugin:
    enabled_address_city_name: false
    enabled_address_postal_code: true
```

## Usage

This plugin comes with great twig functions.

#### Get the twig methods on your template

```twig
{% set continent = geo_continent_code() %}
{% set country = geo_country_code() %}
{% set city = geo_city_name() %}
{% set postal_code = geo_postal_code() %}
```

## Todo

* Get province, latitude and longitude.
* More cool twig helpers.

## Test the plugin

You can follow the instructions to test this plugins in the proper documentation page: [Test the plugin](doc/tests.md).

## Credits

This plugin is maintained by <a href="https://odiseo.com.ar">Odiseo</a>. Want us to help you with this plugin or any Sylius project? Contact us on <a href="mailto:team@odiseo.com.ar">team@odiseo.com.ar</a>.
