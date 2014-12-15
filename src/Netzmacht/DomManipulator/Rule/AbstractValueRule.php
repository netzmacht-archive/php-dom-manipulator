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

use Netzmacht\DomManipulator\Filter\ValueFilterInterface;

/**
 * AbstractValueRule provides filtering for value based dom manipulations.
 *
 * @package Netzmacht\DomManipulator\Rule
 */
abstract class AbstractValueRule extends AbstractRule
{
    /**
     * Value filters.
     *
     * @var ValueFilterInterface[]
     */
    private $filters = array();

    /**
     * Add a filter which will be applied.
     *
     * @param ValueFilterInterface $filter Filter being added.
     *
     * @return $this
     */
    public function addFilter(ValueFilterInterface $filter)
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
     * @return ValueFilterInterface[]
     */
    public function getFilters()
    {
        return $this->filters;
    }
}
