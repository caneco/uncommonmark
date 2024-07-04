<?php

declare(strict_types=1);

namespace Caneco\Uncommonmark\Extensions;

use Caneco\Uncommonmark\Delimiter\BoldDelimiter;
use Caneco\Uncommonmark\Element\Bold;
use Caneco\Uncommonmark\Renderer\BoldRenderer;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\ConfigurableExtensionInterface;
use League\Config\ConfigurationBuilderInterface;
use Nette\Schema\Expect;

class BoldExtension implements ConfigurableExtensionInterface
{
    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment->addDelimiterProcessor(new BoldDelimiter);
        $environment->addRenderer(Bold::class, new BoldRenderer);
    }

    public function configureSchema(ConfigurationBuilderInterface $builder): void
    {
        $builder->addSchema('b', Expect::structure([
            'character' => Expect::string('*'),
        ]));
    }
}
