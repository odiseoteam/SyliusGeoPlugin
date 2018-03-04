<?php

namespace Odiseo\SyliusGeoPlugin\Twig;

use Odiseo\SyliusGeoPlugin\Helper\IpGeolocalizationHelper;

class GeoExtension extends \Twig_Extension
{
    /** @var IpGeolocalizationHelper $ipGeolocalizationHelper */
    protected $ipGeolocalizationHelper;

    public function __construct(IpGeolocalizationHelper $ipGeolocalizationHelper)
    {
        $this->ipGeolocalizationHelper = $ipGeolocalizationHelper;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('geo_continent_code', [$this, 'getContinentCode'])
        );
    }

    public function getContinentCode()
    {
        return $this->ipGeolocalizationHelper->getContinentCode();
    }

    public function getName()
    {
        return 'geo';
    }

}