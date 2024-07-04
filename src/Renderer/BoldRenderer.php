<?php

declare(strict_types=1);

namespace Caneco\Uncommonmark\Renderer;

use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

class BoldRenderer implements NodeRendererInterface
{
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): HtmlElement
    {
        return new HtmlElement('b', $node->data->get('attributes'), $childRenderer->renderNodes($node->children()));
    }
}
