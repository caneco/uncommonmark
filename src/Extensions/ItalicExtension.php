<?php

declare(strict_types=1);

namespace Caneco\Uncommonmark\Extensions;

use Caneco\Uncommonmark\Delimiter\ItalicDelimiter;
use Caneco\Uncommonmark\Element\Italic;
use Caneco\Uncommonmark\Renderer\ItalicRenderer;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\ConfigurableExtensionInterface;
use League\Config\ConfigurationBuilderInterface;
use Nette\Schema\Expect;

class ItalicExtension implements ConfigurableExtensionInterface
{
    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment->addDelimiterProcessor(new ItalicDelimiter);
        $environment->addRenderer(Italic::class, new ItalicRenderer);
    }

    public function configureSchema(ConfigurationBuilderInterface $builder): void
    {
        $builder->addSchema('i', Expect::structure([
            'character' => Expect::string('_'),
        ]));
    }
}
