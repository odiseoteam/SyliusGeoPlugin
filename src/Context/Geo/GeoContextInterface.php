<?php

declare(strict_types=1);

namespace Odiseo\SyliusGeoPlugin\Context\Country;

interface GeoContextInterface
{
    /**
     * @return string
     */
    public function getCountryCode(): ? string;
}
