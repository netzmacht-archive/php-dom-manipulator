<?php

namespace spec\Netzmacht\DomManipulator\Filter\NodeFilter;

use Netzmacht\DomManipulator\Filter\NodeFilter\WrapNodeFilter;
use Netzmacht\DomManipulator\QueryInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class WrapNodeFilterSpec
 * @package spec\Netzmacht\DomManipulator\Filter\NodeFilter
 * @mixin WrapNodeFilter
 */
class WrapNodeFilterSpec extends ObjectBehavior
{
    const TAG = 'div';

    protected static $attributes = array('id' => 'test');

    function let()
    {
        $this->beConstructedWith(static::TAG, static::$attributes);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Netzmacht\DomManipulator\Filter\NodeFilter\WrapNodeFilter');
    }

    function it_is_a_node_filer()
    {
        $this->shouldImplement('Netzmacht\DomManipulator\Filter\NodeFilterInterface');
    }

    function it_has_a_tag_name()
    {
        $this->setTag('a')->shouldReturn($this);
        $this->getTag()->shouldReturn('a');
    }

    function it_has_attributes()
    {
        $attributes = array('class' => 'foo');

        $this->setAttributes($attributes)->shouldReturn($this);
        $this->getAttributes()->shouldReturn($attributes);
    }

    function it_wraps_element()
    {
        $document = new \DOMDocument();

        $target = $document->createElement('div');
        $target->setAttribute('class', 'target');

        $document->appendChild($target);

        $this->filter($target);

        expect($document->childNodes->length)->toBe(1);
        expect($document->childNodes->item(0))->toBeAnInstanceOf('DOMElement');
        expect($document->childNodes->item(0)->getAttribute('id'))->shouldReturn('test');
    }
}
