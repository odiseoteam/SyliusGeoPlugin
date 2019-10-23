<?php

declare(strict_types=1);

namespace Odiseo\SyliusGeoPlugin\Context;

interface GeoContextInterface
{
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
