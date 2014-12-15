<?php

namespace spec\Netzmacht\DomManipulator\Rule;

use Netzmacht\DomManipulator\Filter\NodeFilterInterface;
use Netzmacht\DomManipulator\QueryInterface;
use Netzmacht\DomManipulator\Rule\NodeRule;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class NodeRuleSpec
 * @package spec\Netzmacht\DomManipulator\Rule
 * @mixin NodeRule
 */
class NodeRuleSpec extends ObjectBehavior
{
    function let(QueryInterface $query)
    {
        $this->beConstructedWith($query);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Netzmacht\DomManipulator\Rule\NodeRule');
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

    function it_adds_filters(NodeFilterInterface $filter)
    {
        $this->addFilter($filter)->shouldReturn($this);
        $this->getFilters()->shouldReturn(array($filter));
    }

    function it_resets_filters(NodeFilterInterface $filter)
    {
        $this->addFilter($filter)->shouldReturn($this);
        $this->getFilters()->shouldReturn(array($filter));

        $this->clearFilters()->shouldReturn($this);
        $this->getFilters()->shouldReturn(array());
    }

    function it_applies(NodeFilterInterface $filter, \DOMElement $element)
    {
        $filter->filter($element)->shouldBeCalled();

        $this->addFilter($filter);
        $this->apply($element);
    }
}
