<?php

namespace Caneco\Uncommonmark;

use Caneco\Uncommonmark\Extensions\BoldExtension;
use Caneco\Uncommonmark\Extensions\EmphasisExtension;
use Caneco\Uncommonmark\Extensions\ItalicExtension;
use Caneco\Uncommonmark\Extensions\MarkExtension;
use Caneco\Uncommonmark\Extensions\StrongExtension;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\Extension\TableOfContents\TableOfContentsExtension;
use League\CommonMark\MarkdownConverter;

class Uncommonmark
{
    public Environment $environment;

    public MarkdownConverter $converter;

    public function __construct()
    {
        $this->boot();
    }

    public static function convert(string $markdown): string
    {
        return (new self)->converter->convert($markdown);
    }

    public function boot(): void
    {
        $this->environment = new Environment($this->getConfig());

        $this->environment->addExtension(new CommonMarkCoreExtension());
        $this->environment->addExtension(new GithubFlavoredMarkdownExtension());
        $this->environment->addExtension(new HeadingPermalinkExtension());
        $this->environment->addExtension(new AttributesExtension());
        $this->environment->addExtension(new TableOfContentsExtension());

        $this->environment->addExtension(new MarkExtension);
        $this->environment->addExtension(new BoldExtension);
        $this->environment->addExtension(new ItalicExtension);
        $this->environment->addExtension(new StrongExtension);
        $this->environment->addExtension(new EmphasisExtension);

        $this->converter = new MarkdownConverter($this->environment);
    }

    public function getConfig(): array
    {
        return [
            'renderer' => [
                'block_separator' => "\n",
                'inner_separator' => "\n",
                'soft_break' => '<br>',
            ],
            'commonmark' => [
                'use_asterisk' => false,
                'use_underscore' => false,
                'unordered_list_markers' => ['-'],
            ],
            'heading_permalink' => [
                'min_heading_level' => 6,
            ],
            'table_of_contents' => [
                'html_class' => 'toc',
                'position' => 'placeholder',
                'style' => 'ordered',
                'min_heading_level' => 2,
                'max_heading_level' => 3,
                'normalize' => 'flat',
                'placeholder' => '[[_TOC_]]',
            ],
        ];
    }
}
