<?php

declare(strict_types=1);

namespace Odiseo\SyliusGeoPlugin\Context;

use Odiseo\SyliusGeoPlugin\Helper\IpGeolocalizationHelper;

final class IpGeoBasedContext implements GeoContextInterface
{
    /** @var IpGeolocalizationHelper */
    private $ipGeolocalizationHelper;

    public function __construct(
        IpGeolocalizationHelper $ipGeolocalizationHelper
    ) {
        $this->ipGeolocalizationHelper = $ipGeolocalizationHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function getCountryCode(): ?string
    {
        return $this->ipGeolocalizationHelper->getCountryCode();
    }

    /**
     * {@inheritdoc}
     */
    public function getCityName(): ?string
    {
        return $this->ipGeolocalizationHelper->getCityName();
    }

    /**
     * {@inheritdoc}
     */
    public function getPostalCode(): ?string
    {
        return $this->ipGeolocalizationHelper->getPostalCode();
    }
}
