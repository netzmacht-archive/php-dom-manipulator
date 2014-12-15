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
 * ValueRule modifies the value of a node.
 *
 * @package Netzmacht\DomManipulator\Rule
 */
class ValueRule extends AbstractValueRule
{
    /**
     * {@inheritdoc}
     */
    public function apply(\DomElement $node)
    {
        $value = $node->nodeValue;

        foreach ($this->getFilters() as $filter) {
            $value = $filter->filter($value);
        }

        $node->nodeValue = $value;
    }
}
