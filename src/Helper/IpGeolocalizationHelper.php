<?php

namespace Odiseo\SyliusGeoPlugin\Helper;

use GeoIp2\Database\Reader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;

class IpGeolocalizationHelper
{
    /** @var $requestStack */
    protected $requestStack;

    /** @var Session $session */
    protected $session;

    /** @var Session $reader */
    protected $reader;

    /**
     * @param RequestStack $requestStack
     * @param Session $session
     * @param Reader $reader
     */
    public function __construct(RequestStack $requestStack, Session $session, Reader $reader)
    {
        $this->requestStack = $requestStack;
        $this->session = $session;
        $this->reader = $reader;
    }

    /**
     * @return string
     */
    public function getContinentCode()
    {
        $continentCode = $this->getGeoParameter('continentCode');
        if(!$continentCode) {
            try {
                $continentCode = $this->getCityRecord()->continent->code;
            } catch (\Exception $e) {
                $continentCode = '';
            }
            $this->setGeoParameter('continentCode', $continentCode);
        }

        return $continentCode;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        $countryCode = $this->getGeoParameter('countryCode');
        if(!$countryCode) {
            try {
                $countryCode = $this->getCityRecord()->country->isoCode;
            } catch (\Exception $e) {
                $countryCode = '';
            }
            $this->setGeoParameter('countryCode', $countryCode);
        }

        return $countryCode;
    }

    /**
     * @return \GeoIp2\Model\City
     */
    protected function getCityRecord()
    {
        /** @var Request $request */
        $request = $this->requestStack->getMasterRequest();
        $ip = $request->getClientIp();

        return $this->reader->city($ip);
    }

    /**
     * @param string $parameter
     *
     * @return string
     */
    protected function getGeoParameter($parameter)
    {
        $sessionParameter = '_geo_.'.$parameter;

        if($this->session->has($sessionParameter))
            return $this->session->get($sessionParameter);

        return false;
    }

    /**
     * @param string $parameter
     * @param string $geo
     */
    protected function setGeoParameter($parameter, $geo)
    {
        $sessionParameter = '_geo_.'.$parameter;

        if($geo !== '')
            $this->session->set($sessionParameter, $geo);
    }
}