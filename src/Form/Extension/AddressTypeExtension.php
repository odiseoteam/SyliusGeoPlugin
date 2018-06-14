<?php

namespace Odiseo\SyliusGeoPlugin\Form\Extension;

use Odiseo\SyliusGeoPlugin\Context\Country\CountryContextInterface;
use Sylius\Bundle\AddressingBundle\Form\Type\AddressType;
use Symfony\Component\Form\AbstractTypeExtension;
use Sylius\Bundle\AddressingBundle\Form\Type\CountryCodeChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class AddressTypeExtension extends AbstractTypeExtension
{
    /**
     * @var CountryContextInterface
     */
    private $countryContext;

    public function __construct(CountryContextInterface $countryContext)
    {
        $this->countryContext = $countryContext;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $countryCode = $this->countryContext->getCountryCode();

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
