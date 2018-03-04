<?php

namespace Odiseo\SyliusGeoPlugin\Form\Extension;

use Odiseo\SyliusGeoPlugin\Context\Country\CountryContextInterface;
use Sylius\Bundle\AddressingBundle\Form\Type\AddressType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
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
            ->add('postcode', 'text', array_replace($builder->get('postcode')->getOptions(), [
                'help' => 'brandsof.ui.postcode_help',
            ]))
            ->add('phoneNumber', 'text', array_replace($builder->get('phoneNumber')->getOptions(), [
                'help' => 'brandsof.ui.phone_help',
            ]))
            ->remove('countryCode')
            ->add('countryCode', CountryType::class, [
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
