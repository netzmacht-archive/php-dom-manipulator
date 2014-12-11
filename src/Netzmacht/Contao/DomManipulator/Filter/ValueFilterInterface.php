<?php

/**
 * @package    contribute
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\Contao\DomManipulator\Filter;

/**
 * Interface ValueFilterInterface
 *
 * @package Netzmacht\Contao\DomManipulator\Filter
 */
interface ValueFilterInterface
{
    /**
     * Filter a value and return the result.
     *
     * @param mixed $value Value being filtered.
     *
     * @return mixed
     */
    public function filter($value);
}
