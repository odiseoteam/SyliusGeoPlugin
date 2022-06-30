<?php

declare(strict_types=1);

namespace spec\Odiseo\SyliusGeoPlugin\Helper;

use GeoIp2\Database\Reader;
use Odiseo\SyliusGeoPlugin\Helper\IpGeolocationHelper;
use Odiseo\SyliusGeoPlugin\Helper\IpGeolocationHelperInterface;
use PhpSpec\ObjectBehavior;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;

final class IpGeolocationHelperSpec extends ObjectBehavior
{
    function let(RequestStack $requestStack, Session $session, Reader $reader)
    {
        $this->beConstructedWith($requestStack, $session, $reader);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(IpGeolocationHelper::class);
    }

    function it_should_implement_geolocation_interface()
    {
        $this->shouldImplement(IpGeolocationHelperInterface::class);
    }

    function it_get_country_code_from_session(Session $session)
    {
        $session->has('_geo_countryCode')->shouldBeCalled()->willReturn(true);
        $session->get('_geo_countryCode')->shouldBeCalled()->willReturn('US');
        $this->getCountryCode()->shouldReturn('US');
    }
}
