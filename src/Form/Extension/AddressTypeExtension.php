<?php

declare(strict_types=1);

namespace Odiseo\SyliusGeoPlugin\Form\Extension;

use Odiseo\SyliusGeoPlugin\Context\GeoContextInterface;
use Sylius\Bundle\AddressingBundle\Form\Type\AddressType;
use Sylius\Bundle\AddressingBundle\Form\Type\CountryCodeChoiceType;
use Sylius\Component\Addressing\Model\CountryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bundle\SecurityBundle\Security\FirewallMap;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RequestStack;

final class AddressTypeExtension extends AbstractTypeExtension
{
    /** @var GeoContextInterface */
    private $geoContext;

    /** @var RepositoryInterface */
    private $countryRepository;

    /** @var bool */
    private $enabledCityName;

    /** @var bool */
    private $enabledPostalCode;

    /** @var FirewallMap */
    private $firewallMap;

    /** @var RequestStack */
    private $requestStack;

    public function __construct(
        GeoContextInterface $geoContext,
        RepositoryInterface $countryRepository,
        bool $enabledCityName,
        bool $enabledPostalCode,
        FirewallMap $firewallMap,
        RequestStack $requestStack
    ) {
        $this->geoContext = $geoContext;
        $this->countryRepository = $countryRepository;
        $this->enabledCityName = $enabledCityName;
        $this->enabledPostalCode = $enabledPostalCode;
        $this->firewallMap = $firewallMap;
        $this->requestStack = $requestStack;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($this->isShopContext()) {
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
                    ])
                ;
            }

            if ($this->enabledCityName) {
                $cityName = $this->geoContext->getCityName();

                if ($cityName) {
                    $builder
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

                if ($postalCode) {
                    $builder
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

    /**
     * @inheritdoc
     */
    public static function getExtendedTypes(): iterable
    {
        return [AddressType::class];
    }

    /**
     * @return bool
     */
    private function isShopContext()
    {
        $context = $this->firewallMap->getFirewallConfig($this->requestStack->getCurrentRequest())->getContext();

        return 'shop' === $context;
    }
}
