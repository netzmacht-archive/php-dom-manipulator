<?php

namespace spec\Netzmacht\DomManipulator;

use Netzmacht\DomManipulator\DomManipulator;
use Netzmacht\DomManipulator\QueryInterface;
use Netzmacht\DomManipulator\RuleInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class DomManipulatorSpec
 * @package spec\Netzmacht\DomManipulator
 * @mixin DomManipulator
 */
class DomManipulatorSpec extends ObjectBehavior
{
    function let(\DOMDocument $document)
    {
        $this->beConstructedWith($document);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Netzmacht\DomManipulator\DomManipulator');
    }

    function it_constructs_for_new_document()
    {
        $this->beConstructedThrough('forNewDocument', array());

        $this->getDocument()->shouldReturnAnInstanceOf('DomDocument');
    }

    function it_gets_the_document(\DOMDocument $document)
    {
        $this->getDocument()->shouldReturn($document);
    }

    function it_adds_rule(RuleInterface $rule)
    {
        $this->addRule($rule)->shouldReturn($this);
        $this->getRules()->shouldReturn(array($rule));
    }

    function it_adds_rules(RuleInterface $rule)
    {
        $this->addRules(array($rule))->shouldReturn($this);
        $this->getRules()->shouldReturn(array($rule));
    }

    function it_loads_html_into_dom()
    {
        $document = new \DOMDocument();
        $this->beConstructedWith($document);

        $this->loadHtml('<html></html>')->shouldReturn($this);

        // TODO: Really test it
    }

    function it_has_a_silent_mode()
    {
        $this->isSilentMode()->shouldReturn(false);

        $this->setSilentMode(true)->shouldReturn($this);
        $this->isSilentMode()->shouldReturn(true);
    }

    function it_manipulates_the_dom(RuleInterface $rule)
    {
        $document = new \DOMDocument();
        $this->beConstructedWith($document);

        $element = $document->createElement('div');

        $rule->query($document)->shouldBeCalled()->willReturn(array($element));
        $rule->apply($element)->shouldBeCalled();

        $this->addRule($rule);
        $this->loadHtml('<html></html>')->shouldReturn($this);
        $this->manipulate()->shouldBeString();
    }

    function it_ignores_exceptions_in_silent_mode(RuleInterface $rule)
    {
        $document = new \DOMDocument();
        $this->beConstructedWith($document);

        $this->setSilentMode(true);

        $rule->query($document)->shouldBeCalled()->willThrow('Exception');

        $this->addRule($rule);
        $this->loadHtml('<html></html>')->shouldReturn($this);
        $this->manipulate()->shouldBeString();
    }

    function it_throws_exceptions_if_silent_mode_is_disabled(RuleInterface $rule)
    {
        $document = new \DOMDocument();
        $this->beConstructedWith($document);

        $this->setSilentMode(false);

        $rule->query($document)->shouldBeCalled()->willThrow('Exception');

        $this->addRule($rule);
        $this->loadHtml('<html></html>')->shouldReturn($this);
        $this->shouldThrow('Exception')->duringManipulate();
    }
}
