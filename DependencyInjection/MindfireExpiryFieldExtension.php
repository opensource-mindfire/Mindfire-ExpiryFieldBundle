<?php
/**
 * This file is a part of MindfireExpiryField Bundle
 */

namespace Mindfire\Bundle\ExpiryFieldBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Expiry Field extension
 */
class MindfireExpiryFieldExtension extends Extension implements PrependExtensionInterface
{

    /**
     * Load the configs
     * @param array $configs
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
    }

    /**
     * Prepend the configuration of other bundle
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     * @throws \Exception
     */
    public function prepend(ContainerBuilder $container)
    {
        $config = array('form' => array('resources' => array('MindfireExpiryFieldBundle:Form:expiry.html.twig')));
        try {
            $twigExtension = $container->getExtension('twig');
            $container->prependExtensionConfig($twigExtension->getAlias(), $config);
        } catch (\Symfony\Component\DependencyInjection\Exception\LogicException $ex) {
            throw new \Exception('Twig Extension is not enabled');
        }
    }

}
