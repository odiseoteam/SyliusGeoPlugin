<?php

declare(strict_types=1);

namespace Odiseo\SyliusGeoPlugin\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('odiseo_sylius_geo_plugin');

        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->booleanNode('enabled_address_city_name')->defaultValue(true)->end()
                ->booleanNode('enabled_address_postal_code')->defaultValue(true)->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
