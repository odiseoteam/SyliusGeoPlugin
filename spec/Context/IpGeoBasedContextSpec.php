<?php

declare(strict_types=1);

namespace spec\Odiseo\SyliusGeoPlugin\Context;

use Odiseo\SyliusGeoPlugin\Context\GeoContextInterface;
use Odiseo\SyliusGeoPlugin\Context\IpGeoBasedContext;
use Odiseo\SyliusGeoPlugin\Helper\IpGeolocationHelperInterface;
use PhpSpec\ObjectBehavior;

final class IpGeoBasedContextSpec extends ObjectBehavior
{
    function let(IpGeolocationHelperInterface $ipGeolocationHelper)
    {
        $this->beConstructedWith($ipGeolocationHelper);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(IpGeoBasedContext::class);
    }

    function it_should_implement_geo_context_interface()
    {
        $this->shouldImplement(GeoContextInterface::class);
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
