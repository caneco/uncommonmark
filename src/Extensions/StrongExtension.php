<?php

declare(strict_types=1);

namespace Caneco\Uncommonmark\Extensions;

use Caneco\Uncommonmark\Delimiter\StrongDelimiter;
use Caneco\Uncommonmark\Element\Strong;
use Caneco\Uncommonmark\Renderer\StrongRenderer;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\ConfigurableExtensionInterface;
use League\Config\ConfigurationBuilderInterface;
use Nette\Schema\Expect;

class StrongExtension implements ConfigurableExtensionInterface
{
    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment->addDelimiterProcessor(new StrongDelimiter);
        $environment->addRenderer(Strong::class, new StrongRenderer);
    }

    public function configureSchema(ConfigurationBuilderInterface $builder): void
    {
        $builder->addSchema('strong', Expect::structure([
            'character' => Expect::string('*'),
        ]));
    }
}
