<?php

declare(strict_types=1);

namespace Odiseo\SyliusGeoPlugin\Helper;

use GeoIp2\Database\Reader;
use GeoIp2\Model\City;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;

final class IpGeolocationHelper implements IpGeolocationHelperInterface
{
    private RequestStack $requestStack;
    private Session $session;
    private Reader $reader;

    public function __construct(
        RequestStack $requestStack,
        Session $session,
        Reader $reader
    ) {
        $this->requestStack = $requestStack;
        $this->session = $session;
        $this->reader = $reader;
    }

    public function getContinentCode(): ?string
    {
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

    /**
     * @return mixed
     */
    private function getGeoParameter(string $parameter)
    {
        $sessionParameter = '_geo_' . $parameter;

        if ($this->session->has($sessionParameter)) {
            return $this->session->get($sessionParameter);
        }

        return null;
    }

    /**
     * @param mixed $geo
     */
    private function setGeoParameter(string $parameter, $geo): void
    {
        $sessionParameter = '_geo_' . $parameter;

        if (null !== $geo) {
            $this->session->set($sessionParameter, $geo);
        }
    }
}
