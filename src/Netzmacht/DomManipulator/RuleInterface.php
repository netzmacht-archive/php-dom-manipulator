<?php

/**
 * @package    contribute
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */
namespace Netzmacht\DomManipulator;

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
     * Query the dom to find the elements which the rule is applied to.
     *
     * @param \DOMDocument $document The dom document.
     *
     * @return \DOMNodeList
     */
    public function query(\DOMDocument $document);

    /**
     * Apply Rule filters.
     *
     * @param \DomElement|\DOMCharacterData $node Current dom node.
     *
     * @return void
     */
    public function apply($node);
}
