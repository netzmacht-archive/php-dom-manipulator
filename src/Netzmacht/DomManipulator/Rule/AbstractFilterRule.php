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
 * Class AbstractFilterRule provides basic filter rule management.
 *
 * @package Netzmacht\DomManipulator\Rule
 */
abstract class AbstractFilterRule extends AbstractRule
{
    /**
     * Value filters.
     *
     * @var array
     */
    protected $filters = array();

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
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }
}
