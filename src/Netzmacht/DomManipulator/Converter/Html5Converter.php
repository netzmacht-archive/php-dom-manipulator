<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\DomManipulator\Converter;

use Masterminds\HTML5;
use Netzmacht\DomManipulator\ConverterInterface;

class Html5Converter implements ConverterInterface
{
    /**
     * @var HTML5
     */
    private $html5Parser;

    /**
     * Construct.
     *
     * @param HTML5 $html5Parser Html5 parser
     */
    function __construct(HTML5 $html5Parser)
    {
        $this->html5Parser = $html5Parser;
    }

    /**
     * {@inheritdoc}
     */
    public function parseHtml($html)
    {
        $this->html5Parser->loadHTML($html);
    }

    /**
     * {@inheritdoc}
     */
    public function toHtml(\DOMDocument $document)
    {
        $this->html5Parser->saveHTML($document);
    }
}
