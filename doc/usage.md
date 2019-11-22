## Usage

This plugin comes with great twig functions.

#### Get the twig methods on your template

```twig
{% set continent = geo_continent_code() %}
{% set country = geo_country_code() %}
{% set city = geo_city_name() %}
{% set postal_code = geo_postal_code() %}
```

You can enable or disable some features in checkout addressing step

```yml
# config/packages/odiseo_sylius_geo.yaml
odiseo_sylius_geo:
    enabled_address_city_name: false
    enabled_address_postal_code: true
```
