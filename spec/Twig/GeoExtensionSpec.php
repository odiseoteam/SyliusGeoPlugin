<?php

declare(strict_types=1);

namespace spec\Odiseo\SyliusGeoPlugin\Twig;

use Odiseo\SyliusGeoPlugin\Helper\IpGeolocationHelperInterface;
use Odiseo\SyliusGeoPlugin\Twig\GeoExtension;
use PhpSpec\ObjectBehavior;
use Twig\Extension\AbstractExtension;

final class GeoExtensionSpec extends ObjectBehavior
{
    function let(IpGeolocationHelperInterface $ipGeolocationHelper)
    {
        $this->beConstructedWith($ipGeolocationHelper);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(GeoExtension::class);
    }

    function it_should_be_abstract_extension_object()
    {
        $this->shouldHaveType(AbstractExtension::class);
    }

    function it_get_continent_code_with_given_ip_geolocation_helper(
        IpGeolocationHelperInterface $ipGeolocationHelper
    ) {
        $ipGeolocationHelper->getContinentCode()->willReturn('NA');
        $this->getContinentCode()->shouldReturn('NA');
    }

    function it_get_country_code_with_given_ip_geolocation_helper(
        IpGeolocationHelperInterface $ipGeolocationHelper
    ) {
        $ipGeolocationHelper->getCountryCode()->willReturn('US');
        $this->getCountryCode()->shouldReturn('US');
    }

    function it_get_city_name_with_given_ip_geolocation_helper(
        IpGeolocationHelperInterface $ipGeolocationHelper
    ) {
        $ipGeolocationHelper->getCityName()->willReturn('Minneapolis');
        $this->getCityName()->shouldReturn('Minneapolis');
    }

    function it_get_postal_code_with_given_ip_geolocation_helper(
        IpGeolocationHelperInterface $ipGeolocationHelper
    ) {
        $ipGeolocationHelper->getPostalCode()->willReturn('55455');
        $this->getPostalCode()->shouldReturn('55455');
    }
}
