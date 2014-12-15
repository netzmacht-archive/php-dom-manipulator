<?php

namespace spec\Netzmacht\DomManipulator\Rule;

use Netzmacht\DomManipulator\Filter\ValueFilterInterface;
use Netzmacht\DomManipulator\QueryInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ValueRuleSpec extends ObjectBehavior
{
    function let(QueryInterface $query)
    {
        $this->beConstructedWith($query);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Netzmacht\DomManipulator\Rule\ValueRule');
    }

    function it_is_a_rule()
    {
        $this->beAnInstanceOf('Netzmacht\DomManipulator\RuleInterface');
    }

    function it_gets_the_query(QueryInterface $query)
    {
        $this->getQuery()->shouldReturn($query);
    }

    function it_sets_new_query(QueryInterface $query, QueryInterface $query2)
    {
        $this->getQuery()->shouldReturn($query);

        $this->setQuery($query2)->shouldReturn($this);

        $this->getQuery()->shouldReturn($query2);
    }

    function it_delegates_query(QueryInterface $query, \DOMDocument $document, \DOMNodeList $nodeList)
    {
        $query->query($document)->shouldBeCalled()->willReturn($nodeList);

        $this->query($document)->shouldReturn($nodeList);
    }

    function it_adds_filters(ValueFilterInterface $filter)
    {
        $this->addFilter($filter)->shouldReturn($this);
        $this->getFilters()->shouldReturn(array($filter));
    }

    function it_resets_filters(ValueFilterInterface $filter)
    {
        $this->addFilter($filter)->shouldReturn($this);
        $this->getFilters()->shouldReturn(array($filter));

        $this->clearFilters()->shouldReturn($this);
        $this->getFilters()->shouldReturn(array());
    }

    function it_applies(ValueFilterInterface $filter)
    {
        $document = new \DOMDocument();
        $element  = $document->createElement('div');
        $element->nodeValue = 'test2';

        $document->appendChild($element);

        $filter->filter($element->nodeValue)
            ->shouldBeCalled()
            ->willReturn('test');

        $this->addFilter($filter);
        $this->apply($element);

        expect($element->nodeValue)->toBe('test');
    }
}
