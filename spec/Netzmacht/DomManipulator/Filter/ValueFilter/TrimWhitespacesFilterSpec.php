<?php

namespace spec\Netzmacht\DomManipulator\Filter\ValueFilter;

use Netzmacht\DomManipulator\Filter\ValueFilter\TrimWhitespacesFilter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class TrimWhitespacesFilterSpec
 * @package spec\Netzmacht\DomManipulator\Filter\ValueFilter
 * @mixin TrimWhitespacesFilter
 */
class TrimWhitespacesFilterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Netzmacht\DomManipulator\Filter\ValueFilter\TrimWhitespacesFilter');
    }

    function it_is_a_value_filter()
    {
        $this->shouldImplement('Netzmacht\DomManipulator\Filter\ValueFilterInterface');
    }

    function it_removes_white_spaces()
    {
        $this->filter('foo  bar')->shouldReturn('foo bar');
    }

    function it_reduces_line_breaks_to_spaces()
    {
        $this->filter('foo' . "\n" . 'bar')->shouldReturn('foo bar');
    }

    function it_trims_whitespaces()
    {
        $this->filter(' foo  ')->shouldReturn('foo');
    }
}
