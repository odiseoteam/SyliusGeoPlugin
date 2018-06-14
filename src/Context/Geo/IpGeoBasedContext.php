<?php

declare(strict_types=1);

namespace Odiseo\SyliusGeoPlugin\Context\Geo;

use Odiseo\SyliusGeoPlugin\Helper\IpGeolocalizationHelper;

class IpGeoBasedContext implements GeoContextInterface
{
    /** @var IpGeolocalizationHelper $ipGeolocalizationHelper */
    protected $ipGeolocalizationHelper;

    /**
     * @param IpGeolocalizationHelper $ipGeolocalizationHelper
     */
    public function __construct(IpGeolocalizationHelper $ipGeolocalizationHelper)
    {
        $this->ipGeolocalizationHelper = $ipGeolocalizationHelper;
    }

    /**
     * @return string
     */
    public function getCountryCode(): ? string
    {
        return $this->ipGeolocalizationHelper->getCountryCode();
    }
}
