<?php
/**
 * This file is a part of MindfireExpiryField Bundle
 */

namespace Mindfire\Bundle\ExpiryFieldBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from app/config files
 */
class Configuration implements ConfigurationInterface
{

    /**
     * Config Tree Builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('mindfire_expiry_field');
        return $treeBuilder;
    }

}
