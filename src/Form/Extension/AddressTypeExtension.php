<?php

namespace Odiseo\SyliusGeoPlugin\Form\Extension;

use Odiseo\SyliusGeoPlugin\Context\Geo\GeoContextInterface;
use Sylius\Bundle\AddressingBundle\Form\Type\AddressType;
use Symfony\Component\Form\AbstractTypeExtension;
use Sylius\Bundle\AddressingBundle\Form\Type\CountryCodeChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class AddressTypeExtension extends AbstractTypeExtension
{
    /**
     * @var GeoContextInterface
     */
    private $geoContext;

    public function __construct(GeoContextInterface $geoContext)
    {
        $this->geoContext = $geoContext;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $countryCode = $this->geoContext->getCountryCode();

        $builder
            ->remove('countryCode')
            ->add('countryCode', CountryCodeChoiceType::class, [
                'label' => 'sylius.form.address.country',
                'data' => $countryCode
            ])
        ;
    }

    /**
     * @inheritdoc
     */
    public function getExtendedType()
    {
        return AddressType::class;
    }
}
