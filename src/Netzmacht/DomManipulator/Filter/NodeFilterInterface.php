<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\DomManipulator\Filter;

/**
 * Interface NodeFilterInterface describes an filter which accepts a dom element node as argument.
 *
 * @package Netzmacht\DomManipulator\Filter
 */
interface NodeFilterInterface
{
    /**
     * Filter a value and return the result.
     *
     * @param \DOMElement $element DOM element node.
     *
     * @return void
     */
    public function filter(\DOMElement $element);
}
