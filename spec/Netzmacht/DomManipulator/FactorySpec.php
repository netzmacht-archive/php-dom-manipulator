<?php

namespace spec\Netzmacht\DomManipulator;

use Netzmacht\DomManipulator\ConverterInterface;
use Netzmacht\DomManipulator\Factory;
use Netzmacht\DomManipulator\RuleInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class FactorySpec
 * @package spec\Netzmacht\DomManipulator
 * @mixin Factory
 */
class FactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Netzmacht\DomManipulator\Factory');
    }

    function it_adds_a_rule(RuleInterface $rule)
    {
        $this->addRule($rule)->shouldReturn($this);
        $this->getRules()->shouldReturn(array($rule));
    }

    function it_adds_rule_by_priority(RuleInterface $rule, RuleInterface $ruleB, RuleInterface $ruleC)
    {
        $this->addRule($rule);
        $this->addRule($ruleB, -2);
        $this->addRule($ruleC, -1);

        $this->getRules()->shouldReturn(array($ruleB, $ruleC, $rule));
    }

    function it_adds_multiple_rules(RuleInterface $rule, RuleInterface $ruleB, RuleInterface $ruleC)
    {
        $this->addRules(array($rule, $ruleB, $ruleC))->shouldReturn($this);

        $this->getRules()->shouldReturn(array($rule, $ruleB, $ruleC));
    }

    function it_sets_the_converter(ConverterInterface $converter)
    {
        $this->setConverter($converter)->shouldReturn($this);
        $this->getConverter()->shouldReturn($converter);
    }

    function it_creates_default_converter()
    {
        $this->getConverter()->shouldHaveType('Netzmacht\DomManipulator\ConverterInterface');
    }

    function it_has_silent_mode()
    {
        $this->isSilentMode()->shouldReturn(false);
        $this->setSilentMode(true)->shouldReturn($this);
        $this->isSilentMode()->shouldReturn(true);
    }
}
