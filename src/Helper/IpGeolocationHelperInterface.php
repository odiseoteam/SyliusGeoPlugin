<?php

declare(strict_types=1);

namespace Odiseo\SyliusGeoPlugin\Helper;

interface IpGeolocationHelperInterface
{
    public function getContinentCode(): ?string;

    public function getCountryCode(): ?string;

    public function getCityName(): ?string;

    public function getPostalCode(): ?string;

    public function getLatitude(): ?float;

    public function getLongitude(): ?float;
}
