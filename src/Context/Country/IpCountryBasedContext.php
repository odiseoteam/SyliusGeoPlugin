<?php

declare(strict_types=1);

namespace Odiseo\SyliusGeoPlugin\Context\Country;

use Odiseo\SyliusGeoPlugin\Helper\IpGeolocalizationHelper;

/**
 * Should not be extended, final removed to make this class lazy.
 */
/* final */ class IpCountryBasedContext implements CountryContextInterface
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
