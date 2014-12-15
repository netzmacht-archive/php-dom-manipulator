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
 * Class WrapNodeFilter wraps the target element with an element.
 *
 * @package Netzmacht\DomManipulator\Filter\NodeFilter
 */
class WrapNodeFilter implements NodeFilterInterface
{
    /**
     * Wrapper element tag name.
     *
     * @var string
     */
    private $tag;

    /**
     * Wrapper element attributes.
     *
     * @var array
     */
    private $attributes = array();

    /**
     * Construct.
     *
     * @param string $tag        Wrapper element tag name.
     * @param array  $attributes Wrapper element attributes.
     */
    public function __construct($tag, array $attributes = array())
    {
        $this->tag        = $tag;
        $this->attributes = $attributes;
    }

    /**
     * Get wrapper attributes.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Set attributes.
     *
     * @param array $attributes Wrapper attributes.
     *
     * @return $this
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Get tag name.
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set tag name.
     *
     * @param string $tag Wrapper tag name.
     *
     * @return $this
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function filter(\DOMElement $element)
    {
        $wrapper = $element->ownerDocument->createElement($this->tag);

        foreach ($this->attributes as $name => $value) {
            $wrapper->setAttribute($name, $value);
        }

        $parent = $element->parentNode;
        $parent->replaceChild($wrapper, $element);
        $wrapper->appendChild($element);
    }
}
