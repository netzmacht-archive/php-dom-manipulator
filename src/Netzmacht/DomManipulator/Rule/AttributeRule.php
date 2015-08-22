<?php

/**
 * @package    contribute
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\DomManipulator\Rule;

use Netzmacht\DomManipulator\QueryInterface;

/**
 * Class AttributeRule can be used to filter attribute values.
 *
 * @package Netzmacht\DomManipulator\Rule
 */
class AttributeRule extends AbstractValueRule
{
    /**
     * Name of the attribute being changed.
     *
     * @var string
     */
    private $attributeName;

    /**
     * Create attribute if it does not exists.
     *
     * @var bool
     */
    private $forceAttribute = true;

    /**
     * Construct.
     *
     * @param QueryInterface $query         The query.
     * @param string         $attributeName Name of the attribute being changed.
     */
    public function __construct(QueryInterface $query, $attributeName)
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
     * Check is attribute creation is forced.
     *
     * @return boolean
     */
    public function isForceAttribute()
    {
        return $this->forceAttribute;
    }

    /**
     * Create Attribute if it does not exists.
     *
     * @param boolean $forceAttribute Force the attribute.
     *
     * @return $this
     */
    public function setForceAttribute($forceAttribute)
    {
        $this->forceAttribute = (bool) $forceAttribute;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function apply($node)
    {
        $attributes = $node->attributes;
        $attribute  = $attributes->getNamedItem($this->getAttributeName());
        $value      = $this->applyFilter($attribute ? $attribute->nodeValue : '');

        // Replace if it already exists
        if ($attribute) {
            $attribute->nodeValue = $value;
        } elseif ($this->isForceAttribute()) {
            // Otherwise add
            $node->setAttribute($this->getAttributeName(), $value);
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
