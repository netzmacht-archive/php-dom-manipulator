<?php

namespace Netzmacht\Contao\DomManipulator\Rule;

use Netzmacht\Contao\DomManipulator\QueryInterface;
use Netzmacht\Contao\DomManipulator\RuleInterface;

/**
 * Class AbstractRule provides a basic query implementation by using a Query Interface.
 *
 * This way there is no limitation which kind of queries are used.
 *
 * @package Netzmacht\Contao\DomManipulator\Rule
 */
abstract class AbstractRule implements RuleInterface
{
    /**
     * The query is used to filter affected nodes.
     *
     * @var QueryInterface
     */
    private $query;

    /**
     * Construct.
     *
     * @param QueryInterface $query Query to filter affected nodes.
     */
    function __construct(QueryInterface $query)
    {
        $this->query = $query;
    }

    /**
     * Get the query.
     *
     * @return QueryInterface
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Change the used query.
     *
     * @param QueryInterface $query The new query.
     *
     * @return $this
     */
    public function setQuery(QueryInterface $query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Query the dom to find the elements which to
     *
     * @param \DOMDocument $document
     *
     * @return \DOMNodeList
     */
    public function query(\DOMDocument $document)
    {
        return $this->query->query($document);
    }
}
