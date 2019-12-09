## Installation

1. Run `composer require odiseoteam/sylius-geo-plugin`.

2. Enable the plugin in bundles.php

```php
<?php
// config/bundles.php

return [
    // ...
    GpsLab\Bundle\GeoIP2Bundle\GpsLabGeoIP2Bundle::class => ['all' => true],
    Odiseo\SyliusGeoPlugin\OdiseoSyliusGeoPlugin::class => ['all' => true],
];
```

3. Import the plugin configurations

```yml
# config/packages/_sylius.yaml
imports:
    ...

    - { resource: "@OdiseoSyliusGeoPlugin/Resources/config/config.yaml" }
```

4. Execute `bin/console geoip2:update`.
