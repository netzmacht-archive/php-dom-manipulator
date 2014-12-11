<?php

namespace spec\Netzmacht\DomManipulator\Query;

use Netzmacht\DomManipulator\Query\XPathQuery;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class XPathQuerySpec
 * @package spec\Netzmacht\DomManipulator\Query
 * @mixin XPathQuery
 */
class XPathQuerySpec extends ObjectBehavior
{
    /**
     * Selector represents css selector for '.header'
     */
    const XPATH = 'descendant-or-self::*[contains(concat(\' \', normalize-space(@class), \' \'), \' header \')]';

    function let()
    {
        $this->beConstructedWith(static::XPATH);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Netzmacht\DomManipulator\Query\XPathQuery');
    }

    function it_is_a_query()
    {
        $this->shouldImplement('Netzmacht\DomManipulator\QueryInterface');
    }

    function it_queries_the_dom()
    {
        $dom  = new \DOMDocument();
        $node = $dom->createElement('div');
        $node->setAttribute('class', 'header');

        $dom->appendChild($node);
        $dom->appendChild(new \DOMElement('div'));

        $this->query($dom)->shouldReturnAnInstanceOf('DOMNodeList');
        $this->query($dom)->item(0)->getAttribute('class')->shouldBe('header');
    }
}
