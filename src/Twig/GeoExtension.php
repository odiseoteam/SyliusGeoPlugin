<?php

declare(strict_types=1);

namespace Odiseo\SyliusGeoPlugin\Twig;

use Odiseo\SyliusGeoPlugin\Helper\IpGeolocalizationHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class GeoExtension extends AbstractExtension
{
    /** @var IpGeolocalizationHelper */
    private $ipGeolocalizationHelper;

    public function __construct(
        IpGeolocalizationHelper $ipGeolocalizationHelper
    ) {
        $this->ipGeolocalizationHelper = $ipGeolocalizationHelper;
    }

    /**
     * @return array|TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('geo_continent_code', [$this, 'getContinentCode']),
            new TwigFunction('geo_country_code', [$this, 'getCountryCode']),
            new TwigFunction('geo_city_name', [$this, 'getCityName']),
            new TwigFunction('geo_postal_code', [$this, 'getPostalCode'])
        ];
    }

    /**
     * @return string|null
     */
    public function getContinentCode(): ?string
    {
        return $this->ipGeolocalizationHelper->getContinentCode();
    }

    /**
     * @return string|null
     */
    public function getCountryCode(): ?string
    {
        return $this->ipGeolocalizationHelper->getCountryCode();
    }

    /**
     * @return string|null
     */
    public function getCityName(): ?string
    {
        return $this->ipGeolocalizationHelper->getCityName();
    }

    /**
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        return $this->ipGeolocalizationHelper->getPostalCode();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'geo';
    }
}
