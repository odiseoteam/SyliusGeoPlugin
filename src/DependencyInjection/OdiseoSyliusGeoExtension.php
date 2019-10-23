<?php

declare(strict_types=1);

namespace Odiseo\SyliusGeoPlugin\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

final class OdiseoSyliusGeoExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $config, ContainerBuilder $container): void
    {
        $config = $this->processConfiguration($this->getConfiguration([], $container), $config);

        $container->setParameter('odiseo_sylius_geo_plugin.enabled_address_city_name', $config['enabled_address_city_name']);
        $container->setParameter('odiseo_sylius_geo_plugin.enabled_address_postal_code', $config['enabled_address_postal_code']);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $loader->load('services.yaml');
    }
}
