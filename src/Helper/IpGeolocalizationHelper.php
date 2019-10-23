<?php

declare(strict_types=1);

namespace Odiseo\SyliusGeoPlugin\Helper;

use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use GeoIp2\Model\City;
use MaxMind\Db\Reader\InvalidDatabaseException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;

final class IpGeolocalizationHelper
{
    /** @var RequestStack */
    private $requestStack;

    /** @var Session */
    private $session;

    /** @var Reader */
    private $reader;

    public function __construct(
        RequestStack $requestStack,
        Session $session,
        Reader $reader
    ) {
        $this->requestStack = $requestStack;
        $this->session = $session;
        $this->reader = $reader;
    }

    /**
     * @return string|null
     */
    public function getContinentCode(): ?string
    {
        $continentCode = $this->getGeoParameter('continentCode');
        if (!$continentCode) {
            try {
                $continentCode = $this->getCityRecord()->continent->code;
            } catch (\Exception $e) {
                $continentCode = null;
            }

            $this->setGeoParameter('continentCode', $continentCode);
        }

        return $continentCode;
    }

    /**
     * @return string|null
     */
    public function getCountryCode(): ?string
    {
        $countryCode = $this->getGeoParameter('countryCode');
        if (!$countryCode) {
            try {
                $countryCode = $this->getCityRecord()->country->isoCode;
            } catch (\Exception $e) {
                $countryCode = null;
            }

            $this->setGeoParameter('countryCode', $countryCode);
        }

        return $countryCode;
    }

    /**
     * @return string|null
     */
    public function getCityName(): ?string
    {
        $cityName = $this->getGeoParameter('cityName');
        if (!$cityName) {
            try {
                $cityName = $this->getCityRecord()->city->name;
            } catch (\Exception $e) {
                $cityName = null;
            }

            $this->setGeoParameter('cityName', $cityName);
        }

        return $cityName;
    }

    /**
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        $postalCode = $this->getGeoParameter('postalCode');
        if (!$postalCode) {
            try {
                $postalCode = $this->getCityRecord()->postal->code;
            } catch (\Exception $e) {
                $postalCode = null;
            }

            $this->setGeoParameter('postalCode', $postalCode);
        }

        return $postalCode;
    }

    /**
     * @return City
     * @throws AddressNotFoundException
     * @throws InvalidDatabaseException
     */
    private function getCityRecord(): City
    {
        /** @var Request $request */
        $request = $this->requestStack->getMasterRequest();

        $ip = $request->getClientIp();

        return $this->reader->city($ip);
    }

    /**
     * @param string $parameter
     * @return string|null
     */
    private function getGeoParameter(string $parameter): ?string
    {
        $sessionParameter = '_geo_.'.$parameter;

        if ($this->session->has($sessionParameter)) {
            return $this->session->get($sessionParameter);
        }

        return null;
    }

    /**
     * @param string $parameter
     * @param string|null $geo
     */
    private function setGeoParameter(string $parameter, ?string $geo): void
    {
        $sessionParameter = '_geo_.'.$parameter;

        if ($geo) {
            $this->session->set($sessionParameter, $geo);
        }
    }
}
