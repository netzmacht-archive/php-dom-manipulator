<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\DomManipulator\Rule;

/**
 * Class NodeRule applies filters directly to a node.
 *
 * @package Netzmacht\DomManipulator\Rule
 */
class NodeRule extends AbstractNodeRule
{
    /**
     * Apply Rule filters.
     *
     * @param \DomElement $node Current dom node.
     *
     * @return void
     */
    public function apply($node)
    {
        foreach ($this->getFilters() as $filter) {
            $filter->filter($node);
        }
    }
}
