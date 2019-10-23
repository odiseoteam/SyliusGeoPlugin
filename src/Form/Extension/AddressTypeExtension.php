<?php

declare(strict_types=1);

namespace Odiseo\SyliusGeoPlugin\Form\Extension;

use Odiseo\SyliusGeoPlugin\Context\GeoContextInterface;
use Sylius\Bundle\AddressingBundle\Form\Type\AddressType;
use Sylius\Bundle\AddressingBundle\Form\Type\CountryCodeChoiceType;
use Sylius\Component\Addressing\Model\CountryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

final class AddressTypeExtension extends AbstractTypeExtension
{
    /** @var GeoContextInterface */
    private $geoContext;

    /** @var RepositoryInterface */
    private $countryRepository;

    public function __construct(
        GeoContextInterface $geoContext,
        RepositoryInterface $countryRepository
    ) {
        $this->geoContext = $geoContext;
        $this->countryRepository = $countryRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $countryCode = $this->geoContext->getCountryCode();

        /** @var CountryInterface $country */
        $country = $this->countryRepository->findOneBy([
            'code' => $countryCode
        ]);

        if ($country instanceof CountryInterface) {
            $builder
                ->remove('countryCode')
                ->add('countryCode', CountryCodeChoiceType::class, [
                    'label' => 'sylius.form.address.country',
                    'data' => $countryCode
                ]);
        }
    }

    /**
     * @inheritdoc
     */
    public function getExtendedTypes(): array
    {
        return [AddressType::class];
    }
}
