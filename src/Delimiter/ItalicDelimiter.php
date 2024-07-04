<?php

declare(strict_types=1);

namespace Caneco\Uncommonmark\Delimiter;

use Caneco\Uncommonmark\Element\Italic;
use League\CommonMark\Delimiter\DelimiterInterface;
use League\CommonMark\Delimiter\Processor\DelimiterProcessorInterface;
use League\CommonMark\Node\Inline\AbstractStringContainer;

class ItalicDelimiter implements DelimiterProcessorInterface
{
    private string $char = '_';

    public function getOpeningCharacter(): string
    {
        return $this->char;
    }

    public function getClosingCharacter(): string
    {
        return $this->char;
    }

    public function getMinLength(): int
    {
        return 1;
    }

    public function getDelimiterUse(DelimiterInterface $opener, DelimiterInterface $closer): int
    {
        if ($opener->getLength() === 1 && $closer->getLength() === 1) {
            return 1;
        }

        return 0;
    }

    public function process(AbstractStringContainer $opener, AbstractStringContainer $closer, int $delimiterUse): void
    {
        $italic = new Italic;

        $temp = $opener->next();
        while ($temp !== null && $temp !== $closer) {
            $next = $temp->next();
            $italic->appendChild($temp);
            $temp = $next;
        }

        $opener->insertAfter($italic);
    }
}
