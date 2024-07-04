<?php

declare(strict_types=1);

namespace Caneco\Uncommonmark\Delimiter;

use Caneco\Uncommonmark\Element\Bold;
use League\CommonMark\Delimiter\DelimiterInterface;
use League\CommonMark\Delimiter\Processor\DelimiterProcessorInterface;
use League\CommonMark\Node\Inline\AbstractStringContainer;

class BoldDelimiter implements DelimiterProcessorInterface
{
    private string $char = '*';

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
        $bold = new Bold;

        $tmp = $opener->next();
        while ($tmp !== null && $tmp !== $closer) {
            $next = $tmp->next();
            $bold->appendChild($tmp);
            $tmp = $next;
        }

        $opener->insertAfter($bold);
    }
}
