<?php

namespace Netzmacht\Contao\DomManipulator;

/**
 * RuleInterface describes a rule which manipulates an dom element.
 *
 * It also passes an XPath expression to filter the dom.
 *
 * @package Netzmacht\Contao\DomManipulator
 */
interface RuleInterface
{
    /**
     * Query the dom to find the elements which to
     * @param \DOMDocument $document
     *
     * @return \DOMNodeList
     */
    public function query(\DOMDocument $document);

    /**
     * Apply Rule filters.
     *
     * @param \DomElement $node
     *
     * @return mixed
     */
    public function apply(\DomElement $node);
}
