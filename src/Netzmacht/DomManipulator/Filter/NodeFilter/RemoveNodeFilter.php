<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\DomManipulator\Filter\NodeFilter;

use Netzmacht\DomManipulator\Filter\NodeFilterInterface;

/**
 * Class RemoveNodeFilter removes element from the document.
 *
 * @package Netzmacht\DomManipulator\Filter\NodeFilter
 */
class RemoveNodeFilter implements NodeFilterInterface
{
    /**
     * {@inheritdoc}
     */
    public function filter(\DOMElement $element)
    {
        $element->parentNode->removeChild($element);
    }
}
