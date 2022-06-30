<?php

declare(strict_types=1);

namespace Odiseo\SyliusGeoPlugin\Context;

use Odiseo\SyliusGeoPlugin\Helper\IpGeolocationHelperInterface;

final class IpGeoBasedContext implements GeoContextInterface
{
    private IpGeolocationHelperInterface $ipGeolocationHelper;

    public function __construct(
        IpGeolocationHelperInterface $ipGeolocationHelper
    ) {
        $this->ipGeolocationHelper = $ipGeolocationHelper;
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

    public function getLatitude(): ?float
    {
        return $this->ipGeolocationHelper->getLatitude();
    }

    public function getLongitude(): ?float
    {
        return $this->ipGeolocationHelper->getLongitude();
    }
}
