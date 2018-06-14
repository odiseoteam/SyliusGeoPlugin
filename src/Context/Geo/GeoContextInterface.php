<?php

declare(strict_types=1);

namespace Odiseo\SyliusGeoPlugin\Context\Geo;

interface GeoContextInterface
{
    /**
     * @return string
     */
    public function getCountryCode(): ? string;
}
