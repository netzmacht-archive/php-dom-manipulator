<?php

namespace spec\Netzmacht\DomManipulator\Filter\NodeFilter;

use Netzmacht\DomManipulator\Filter\NodeFilter\RemoveNodeFilter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class RemoveNodeFilterSpec
 * @package spec\Netzmacht\DomManipulator\Filter\NodeFilter
 * @mixin RemoveNodeFilter
 */
class RemoveNodeFilterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Netzmacht\DomManipulator\Filter\NodeFilter\RemoveNodeFilter');
    }

    function it_is_a_node_filer()
    {
        $this->shouldImplement('Netzmacht\DomManipulator\Filter\NodeFilterInterface');
    }

    function it_removes_element()
    {
        $document = new \DOMDocument();

        $target = $document->createElement('div');
        $target->setAttribute('class', 'target');

        $document->appendChild($target);

        $this->filter($target);

        expect($document->childNodes->length)->toBe(0);
    }
}
