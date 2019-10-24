<?php

declare(strict_types=1);

namespace Odiseo\SyliusGeoPlugin\Helper;

interface IpGeolocalizationHelperInterface
{
    /**
     * @return string|null
     */
    public function getContinentCode(): ?string;

    /**
     * @return string|null
     */
    public function getCountryCode(): ?string;

    /**
     * @return string|null
     */
    public function getCityName(): ?string;

    /**
     * @return string|null
     */
    public function getPostalCode(): ?string;
}
