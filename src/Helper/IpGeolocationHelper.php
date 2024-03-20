<?php

declare(strict_types=1);

namespace Odiseo\SyliusGeoPlugin\Helper;

use GeoIp2\Database\Reader;
use GeoIp2\Model\City;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class IpGeolocationHelper implements IpGeolocationHelperInterface
{
    public function __construct(
        private RequestStack $requestStack,
        private Reader $reader,
    ) {
    }

    public function getContinentCode(): ?string
    {
        /** @var string|null $continentCode */
        $continentCode = $this->getGeoParameter('continentCode');
        if (null === $continentCode) {
            try {
                $continentCode = $this->getCityRecord()->continent->code;
            } catch (\Exception $e) {
                $continentCode = null;
            }

            $this->setGeoParameter('continentCode', $continentCode);
        }

        return $continentCode;
    }

    public function getCountryCode(): ?string
    {
        /** @var string|null $countryCode */
        $countryCode = $this->getGeoParameter('countryCode');
        if (null === $countryCode) {
            try {
                $countryCode = $this->getCityRecord()->country->isoCode;
            } catch (\Exception $e) {
                $countryCode = null;
            }

            $this->setGeoParameter('countryCode', $countryCode);
        }

        return $countryCode;
    }

    public function getCityName(): ?string
    {
        /** @var string|null $cityName */
        $cityName = $this->getGeoParameter('cityName');
        if (null === $cityName) {
            try {
                $cityName = $this->getCityRecord()->city->name;
            } catch (\Exception $e) {
                $cityName = null;
            }

            $this->setGeoParameter('cityName', $cityName);
        }

        return $cityName;
    }

    public function getPostalCode(): ?string
    {
        /** @var string|null $postalCode */
        $postalCode = $this->getGeoParameter('postalCode');
        if (null === $postalCode) {
            try {
                $postalCode = $this->getCityRecord()->postal->code;
            } catch (\Exception $e) {
                $postalCode = null;
            }

            $this->setGeoParameter('postalCode', $postalCode);
        }

        return $postalCode;
    }

    public function getLatitude(): ?float
    {
        /** @var float|null $latitude */
        $latitude = $this->getGeoParameter('latitude');
        if (null === $latitude) {
            try {
                $latitude = $this->getCityRecord()->location->latitude;
            } catch (\Exception $e) {
                $latitude = null;
            }

            $this->setGeoParameter('latitude', $latitude);
        }

        return $latitude;
    }

    public function getLongitude(): ?float
    {
        /** @var float|null $longitude */
        $longitude = $this->getGeoParameter('longitude');
        if (null === $longitude) {
            try {
                $longitude = $this->getCityRecord()->location->longitude;
            } catch (\Exception $e) {
                $longitude = null;
            }

            $this->setGeoParameter('longitude', $longitude);
        }

        return $longitude;
    }

    private function getCityRecord(): City
    {
        /** @var Request $request */
        $request = $this->requestStack->getMainRequest();

        $ip = $request->getClientIp() === '127.0.0.1' ? '110.33.122.75' : $request->getClientIp();

        $ip = $ip === null ? '' : $ip;

        return $this->reader->city($ip);
    }

    private function getGeoParameter(string $parameter): mixed
    {
        $sessionParameter = '_geo_' . $parameter;

        if ($this->requestStack->getSession()->has($sessionParameter)) {
            return $this->requestStack->getSession()->get($sessionParameter);
        }

        return null;
    }

    private function setGeoParameter(string $parameter, mixed $geo): void
    {
        $sessionParameter = '_geo_' . $parameter;

        if (null !== $geo) {
            $this->requestStack->getSession()->set($sessionParameter, $geo);
        }
    }
}
