<?php

declare(strict_types=1);

namespace Odiseo\SyliusGeoPlugin\Context;

use Odiseo\SyliusGeoPlugin\Helper\IpGeolocalizationHelperInterface;

final class IpGeoBasedContext implements GeoContextInterface
{
    /** @var IpGeolocalizationHelperInterface */
    private $ipGeolocalizationHelper;

    public function __construct(
        IpGeolocalizationHelperInterface $ipGeolocalizationHelper
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
