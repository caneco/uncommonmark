<?php

declare(strict_types=1);

namespace Caneco\Uncommonmark\Extensions;

use Caneco\Uncommonmark\Delimiter\MarkDelimiter;
use Caneco\Uncommonmark\Element\Mark;
use Caneco\Uncommonmark\Renderer\MarkRenderer;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\ConfigurableExtensionInterface;
use League\Config\ConfigurationBuilderInterface;
use Nette\Schema\Expect;

class MarkExtension implements ConfigurableExtensionInterface
{
    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment->addDelimiterProcessor(new MarkDelimiter);
        $environment->addRenderer(Mark::class, new MarkRenderer);
    }

    public function configureSchema(ConfigurationBuilderInterface $builder): void
    {
        $builder->addSchema('mark', Expect::structure([
            'character' => Expect::string('='),
        ]));
    }
}
