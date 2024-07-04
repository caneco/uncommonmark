<?php

declare(strict_types=1);

namespace Caneco\Uncommonmark\Element;

use League\CommonMark\Node\Inline\AbstractInline;
use League\CommonMark\Node\Inline\DelimitedInterface;

class Italic extends AbstractInline implements DelimitedInterface
{
    private string $delimiter = '_';

    public function getOpeningDelimiter(): string
    {
        return $this->delimiter;
    }

    public function getClosingDelimiter(): string
    {
        return $this->delimiter;
    }
}
