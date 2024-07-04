<?php

declare(strict_types=1);

namespace Caneco\Uncommonmark\Extensions;

use Caneco\Uncommonmark\Delimiter\EmphasisDelimiter;
use Caneco\Uncommonmark\Element\Emphasis;
use Caneco\Uncommonmark\Renderer\EmphasisRenderer;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\ConfigurableExtensionInterface;
use League\Config\ConfigurationBuilderInterface;
use Nette\Schema\Expect;

class EmphasisExtension implements ConfigurableExtensionInterface
{
    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment->addDelimiterProcessor(new EmphasisDelimiter);
        $environment->addRenderer(Emphasis::class, new EmphasisRenderer);
    }

    public function configureSchema(ConfigurationBuilderInterface $builder): void
    {
        $builder->addSchema('em', Expect::structure([
            'character' => Expect::string('*'),
        ]));
    }
}
