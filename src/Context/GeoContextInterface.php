<?php

declare(strict_types=1);

namespace Odiseo\SyliusGeoPlugin\Context;

interface GeoContextInterface
{
    /**
     * @return string|null
     */
    public function getCountryCode(): ?string;
}
