<?php

declare(strict_types=1);

namespace Odiseo\SyliusGeoPlugin\Form\Extension;

use Odiseo\SyliusGeoPlugin\Context\GeoContextInterface;
use Sylius\Bundle\AddressingBundle\Form\Type\AddressType;
use Sylius\Bundle\AddressingBundle\Form\Type\CountryCodeChoiceType;
use Sylius\Component\Addressing\Model\CountryInterface;
use Sylius\Component\Core\Model\AddressInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class AddressTypeExtension extends AbstractTypeExtension
{
    private GeoContextInterface $geoContext;
    private RepositoryInterface $countryRepository;
    private bool $enabledCityName;
    private bool $enabledPostalCode;

    public function __construct(
        GeoContextInterface $geoContext,
        RepositoryInterface $countryRepository,
        bool $enabledCityName,
        bool $enabledPostalCode
    ) {
        $this->geoContext = $geoContext;
        $this->countryRepository = $countryRepository;
        $this->enabledCityName = $enabledCityName;
        $this->enabledPostalCode = $enabledPostalCode;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addEventListener(
            FormEvents::POST_SET_DATA,
            [$this, 'onPostSetData']
        );
    }

    public function onPostSetData(FormEvent $event): void
    {
        $address = $event->getData();
        $form = $event->getForm();

        if (!$address instanceof AddressInterface) {
            $countryCode = $this->geoContext->getCountryCode();

            $country = $this->countryRepository->findOneBy([
                'code' => $countryCode
            ]);

            if ($country instanceof CountryInterface) {
                $form
                    ->remove('countryCode')
                    ->add('countryCode', CountryCodeChoiceType::class, [
                        'label' => 'sylius.form.address.country',
                        'data' => $countryCode
                    ])
                ;
            }

            if ($this->enabledCityName) {
                $cityName = $this->geoContext->getCityName();

                if (null !== $cityName) {
                    $form
                        ->remove('city')
                        ->add('city', TextType::class, [
                            'label' => 'sylius.form.address.city',
                            'data' => $cityName
                        ])
                    ;
                }
            }

            if ($this->enabledPostalCode) {
                $postalCode = $this->geoContext->getPostalCode();

                if (null !== $postalCode) {
                    $form
                        ->remove('postcode')
                        ->add('postcode', TextType::class, [
                            'label' => 'sylius.form.address.postcode',
                            'data' => $postalCode
                        ])
                    ;
                }
            }
        }
    }

    public static function getExtendedTypes(): iterable
    {
        return [AddressType::class];
    }
}
