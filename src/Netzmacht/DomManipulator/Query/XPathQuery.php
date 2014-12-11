<?php

/**
 * @package    contribute
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\DomManipulator\Query;

use Netzmacht\DomManipulator\QueryInterface;

/**
 * Class XPathQuery queries the dom with a xpath expression.
 *
 * @package Netzmacht\Contao\DomManipulator\Query
 */
final class XPathQuery implements QueryInterface
{
    /**
     * XPath expression.
     *
     * @var string
     */
    private $xPathExpr;

    /**
     * Coonstruct.
     *
     * @param string $xPathExpr XPath expression.
     */
    public function __construct($xPathExpr)
    {
        $this->xPathExpr = $xPathExpr;
    }

    /**
     * Set XPath expression.
     *
     * @param string $expr XPath Expression.
     *
     * @return $this
     */
    public function setXPathExpr($expr)
    {
        $this->xPathExpr = $expr;

        return $this;
    }

    /**
     * Get XPath expression.
     *
     * @return string
     */
    public function getXPathExpr()
    {
        return $this->xPathExpr;
    }

    /**
     * Execute a query on a document and return a filtered node list.
     *
     * @param \DOMDocument $document Dom Document.
     *
     * @return \DomNodeList
     */
    public function query(\DOMDocument $document)
    {
        $xPath = new \DOMXPath($document);

        return $xPath->query($this->getXPathExpr());
    }
}
