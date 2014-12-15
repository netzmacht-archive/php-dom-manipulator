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
use Netzmacht\DomManipulator\QueryInterface;

/**
 * Class MoveIntoNodeFilter moves all nodes which get filtered by the query interface into the filter element node.
 *
 * @package Netzmacht\DomManipulator\Filter\NodeFilter
 */
class MoveIntoNodeFilter implements NodeFilterInterface
{
    /**
     * Selector for nodes which get moved into the element.
     *
     * @var QueryInterface
     */
    private $query;

    /**
     * Construct.
     *
     * @param QueryInterface $query Selector query.
     */
    public function __construct(QueryInterface $query)
    {
        $this->query = $query;
    }

    /**
     * Get the selector query.
     *
     * @return QueryInterface
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Set the elector query.
     *
     * @param QueryInterface $query Selector query.
     *
     * @return $this
     */
    public function setQuery(QueryInterface $query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function filter(\DOMElement $element)
    {
        $nodes = $this->query->query($element->ownerDocument);

        foreach ($nodes as $node) {
            $node->parentNode->removeChild($node);
            $element->appendChild($node);
        }
    }
}
