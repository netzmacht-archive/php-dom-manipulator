<?php

/**
 * @package    contribute
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\Contao\DomManipulator\Rule;

use Netzmacht\Contao\DomManipulator\Filter\ValueFilterInterface;
use Netzmacht\Contao\DomManipulator\QueryInterface;

class AttributeRule extends AbstractRule
{
    /**
     * Value filters.
     *
     * @var ValueFilterInterface[]
     */
    private $filters = array();

    /**
     * Name of the attribute being changed.
     *
     * @var string
     */
    private $attributeName;

    /**
     * Construct.
     *
     * @param QueryInterface $query         The query.
     * @param string         $attributeName Name of the attribute being changed.
     */
    function __construct(QueryInterface $query, $attributeName)
    {
        parent::__construct($query);

        $this->attributeName = $attributeName;
    }

    /**
     * Get attribute name.
     *
     * @return string
     */
    public function getAttributeName()
    {
        return $this->attributeName;
    }

    /**
     * Set attribute name.
     *
     * @param string $attributeName Attribute name.
     *
     * @return $this;
     */
    public function setAttributeName($attributeName)
    {
        $this->attributeName = $attributeName;

        return $this;
    }

    /**
     * Add a filter which will be applied.
     *
     * @param ValueFilterInterface $filter ValueFilterInterface
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

    /**
     * Apply Rule filters.
     *
     * @param \DomElement $node
     *
     * @return mixed
     */
    public function apply(\DomElement $node)
    {
        $attributes = $node->attributes;
        $attribute  = $attributes->getNamedItem($this->getAttributeName());
        $value      = $this->applyFilter($attribute ? $attribute->nodeValue : '');

        // Replace if it already exists
        if ($attribute) {
            $attribute->nodeValue = $value;
        } else {
            // Otherwise add
            $node->setAttribute('class', $value);
        }
    }

    /**
     * Apply defined filters.
     *
     * @param string $value Css class value.
     *
     * @return string
     */
    private function applyFilter($value)
    {
        foreach ($this->getFilters() as $filter) {
            $value = $filter->filter($value);
        }

        return $value;
    }
}
