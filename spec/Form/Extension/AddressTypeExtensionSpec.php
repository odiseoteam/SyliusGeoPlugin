<?php

declare(strict_types=1);

namespace spec\Odiseo\SyliusGeoPlugin\Form\Extension;

use Odiseo\SyliusGeoPlugin\Context\GeoContextInterface;
use Odiseo\SyliusGeoPlugin\Form\Extension\AddressTypeExtension;
use PhpSpec\ObjectBehavior;
use Sylius\Bundle\AddressingBundle\Form\Type\AddressType;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Form\AbstractTypeExtension;

final class AddressTypeExtensionSpec extends ObjectBehavior
{
    function let(GeoContextInterface $geoContext, RepositoryInterface $countryRepository)
    {
        $this->beConstructedWith($geoContext, $countryRepository, true, true);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AddressTypeExtension::class);
    }

    function it_should_be_abstract_type_extension_object()
    {
        $this->shouldHaveType(AbstractTypeExtension::class);
    }

    function it_get_extended_types()
    {
        $this->getExtendedTypes()->shouldReturn([AddressType::class]);
    }
}
