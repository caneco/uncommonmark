<?php

declare(strict_types=1);

namespace Caneco\Uncommonmark\Delimiter;

use Caneco\Uncommonmark\Element\Mark;
use League\CommonMark\Delimiter\DelimiterInterface;
use League\CommonMark\Delimiter\Processor\DelimiterProcessorInterface;
use League\CommonMark\Node\Inline\AbstractStringContainer;

class MarkDelimiter implements DelimiterProcessorInterface
{
    private string $char = '=';

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
        return 2;
    }

    public function getDelimiterUse(DelimiterInterface $opener, DelimiterInterface $closer): int
    {
        if ($opener->getLength() === 2 && $closer->getLength() === 2) {
            return 2;
        }

        return 0;
    }

    public function process(AbstractStringContainer $opener, AbstractStringContainer $closer, int $delimiterUse): void
    {
        $mark = new Mark;

        $temp = $opener->next();
        while ($temp !== null && $temp !== $closer) {
            $next = $temp->next();
            $mark->appendChild($temp);
            $temp = $next;
        }

        $opener->insertAfter($mark);
    }
}
