<?php

declare(strict_types=1);

namespace Odiseo\SyliusGeoPlugin\Twig;

use Odiseo\SyliusGeoPlugin\Helper\IpGeolocationHelperInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class GeoExtension extends AbstractExtension
{
    private IpGeolocationHelperInterface $ipGeolocationHelper;

    public function __construct(
        IpGeolocationHelperInterface $ipGeolocationHelper
    ) {
        $this->ipGeolocationHelper = $ipGeolocationHelper;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('geo_continent_code', [$this, 'getContinentCode']),
            new TwigFunction('geo_country_code', [$this, 'getCountryCode']),
            new TwigFunction('geo_city_name', [$this, 'getCityName']),
            new TwigFunction('geo_postal_code', [$this, 'getPostalCode'])
        ];
    }

    public function getContinentCode(): ?string
    {
        return $this->ipGeolocationHelper->getContinentCode();
    }

    public function getCountryCode(): ?string
    {
        return $this->ipGeolocationHelper->getCountryCode();
    }

    public function getCityName(): ?string
    {
        return $this->ipGeolocationHelper->getCityName();
    }

    public function getPostalCode(): ?string
    {
        return $this->ipGeolocationHelper->getPostalCode();
    }

    public function getName(): string
    {
        return 'geo';
    }
}
