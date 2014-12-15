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
 * AbstractNodeRule provides filters for node based dom manipulations.
 *
 * @package Netzmacht\DomManipulator\Rule
 */
abstract class AbstractNodeRule extends AbstractFilterRule
{
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
}
