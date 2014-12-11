<?php

namespace spec\Netzmacht\DomManipulator\Rule;

use Netzmacht\DomManipulator\QueryInterface;
use Netzmacht\DomManipulator\Rule\AbstractRule;
use Netzmacht\DomManipulator\RuleInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class AbstractRuleSpec
 * @package spec\Netzmacht\DomManipulator\Rule
 * @mixin AbstractRule
 */
class AbstractRuleSpec extends ObjectBehavior
{
    function let(QueryInterface $query)
    {
        $this->beAnInstanceOf('spec\Netzmacht\DomManipulator\Rule\Rule');
        $this->beConstructedWith($query);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Netzmacht\DomManipulator\Rule\AbstractRule');
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
}

class Rule extends AbstractRule
{
    public function apply(\DomElement $node)
    {
    }
}
