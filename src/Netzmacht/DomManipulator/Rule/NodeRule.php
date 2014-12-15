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

use Netzmacht\DomManipulator\Filter\NodeFilterInterface;

/**
 * Class NodeRule applies filters directly to a node.
 *
 * @package Netzmacht\DomManipulator\Rule
 */
class NodeRule extends AbstractRule
{
    /**
     * Node filters.
     *
     * @var NodeFilterInterface[]
     */
    private $filters = array();

    /**
     * Add a filter which will be applied.
     *
     * @param NodeFilterInterface $filter Filter being added.
     *
     * @return $this
     */
    public function addFilter(NodeFilterInterface $filter)
    {
        $this->filters[] = $filter;

        return $this;
    }

    /**
     * Remove all filters.
     *
     * @return $this
     */
    public function clearFilters()
    {
        $this->filters = array();

        return $this;
    }

    /**
     * Get all filters.
     *
     * @return NodeFilterInterface[]
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * Apply Rule filters.
     *
     * @param \DomElement $node Current dom node.
     *
     * @return void
     */
    public function apply(\DomElement $node)
    {
        foreach ($this->filters as $filter) {
            $filter->filter($node);
        }
    }
}
