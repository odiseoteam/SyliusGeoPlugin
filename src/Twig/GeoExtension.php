<?php

declare(strict_types=1);

namespace Odiseo\SyliusGeoPlugin\Twig;

use Odiseo\SyliusGeoPlugin\Helper\IpGeolocalizationHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class GeoExtension extends AbstractExtension
{
    /** @var IpGeolocalizationHelper */
    private $ipGeolocalizationHelper;

    public function __construct(
        IpGeolocalizationHelper $ipGeolocalizationHelper
    ) {
        $this->ipGeolocalizationHelper = $ipGeolocalizationHelper;
    }

    /**
     * @return array|TwigFunction[]
     */
    public function getFunctions(): array
    {
        return array(
            new TwigFunction('geo_continent_code', [$this, 'getContinentCode'])
        );
    }

    /**
     * @return string|null
     */
    public function getContinentCode(): ?string
    {
        return $this->ipGeolocalizationHelper->getContinentCode();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'geo';
    }
}
