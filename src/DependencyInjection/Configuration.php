<?php
declare(strict_types=1);

namespace PR\Bundle\RecaptchaBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        if (method_exists(TreeBuilder::class, 'getRootNode')) {
            $treeBuilder = new TreeBuilder('pr_recaptcha');
            $rootNode = $treeBuilder->getRootNode();
        } else {
            $treeBuilder = new TreeBuilder();
            $rootNode = $treeBuilder->root('pr_recaptcha');
        }

        $rootNode
            ->children()
                ->scalarNode('public_key')
                    ->isRequired()
                ->end()
                ->scalarNode('secret_key')
                    ->isRequired()
                ->end()
                ->booleanNode('enabled')
                    ->defaultValue(true)
                ->end()
                ->floatNode('score_threshhold')
                    ->defaultValue(0.5)
                ->end()
                ->booleanNode('hide_badge')
                    ->defaultValue(false)
                ->end()
                ->scalarNode('host')
                    ->defaultValue('www.google.com')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
