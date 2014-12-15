<?php

namespace spec\Netzmacht\DomManipulator\Filter\NodeFilter;

use Netzmacht\DomManipulator\Filter\NodeFilter\MoveIntoNodeFilter;
use Netzmacht\DomManipulator\QueryInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class MoveIntoNodeFilterSpec
 * @package spec\Netzmacht\DomManipulator\Filter\NodeFilter
 * @mixin MoveIntoNodeFilter
 */
class MoveIntoNodeFilterSpec extends ObjectBehavior
{
    function let(QueryInterface $query)
    {
        $this->beConstructedWith($query);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Netzmacht\DomManipulator\Filter\NodeFilter\MoveIntoNodeFilter');
    }

    function it_is_a_node_filer()
    {
        $this->shouldImplement('Netzmacht\DomManipulator\Filter\NodeFilterInterface');
    }

    function it_has_a_query(QueryInterface $query)
    {
        $this->getQuery()->shouldReturn($query);
    }

    function it_sets_new_query(QueryInterface $query2)
    {
        $this->setQuery($query2)->shouldReturn($this);
        $this->getQuery()->shouldReturn($query2);
    }

    function it_moves_elements_into_node(QueryInterface $query)
    {
        $document = new \DOMDocument();

        $target = $document->createElement('div');
        $target->setAttribute('class', 'target');

        $element = $document->createElement('div');
        $element->setAttribute('id', 'test');

        $document->appendChild($target);
        $document->appendChild($element);

        $query->query($document)->shouldBeCalled()->willReturn(array($target));

        $this->filter($element);

        expect($document->childNodes->length)->toBe(1);
        expect($document->childNodes->item(0)->childNodes->length)->toBe(1);
        expect($document->childNodes->item(0)->childNodes->item(0))->toBe($target);
    }
}
